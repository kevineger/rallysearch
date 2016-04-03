<?php

namespace App\Jobs;

use Google_Service_Vision_BatchAnnotateImagesRequest;
use Google_Service_Vision_AnnotateImageRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Google_Service_Vision_Feature;
use Google_Service_Vision_Image;
use Google_Service_Appengine;
use Google_Service_Vision;
use App\Annotation;
use Google_Client;
use phpRAW\phpRAW;
use App\Jobs\Job;
use App\Label;

/*
|--------------------------------------------------------------------------
| Annotate Top Reddit Posts
| This class queries Reddit for the top 50 posts, downloads all images from
| link posts, converts them to base64, analyzes them with Google Cloud
| Vision, and caches the results.
|--------------------------------------------------------------------------
*/

class AnnotateTopPosts extends Job implements ShouldQueue {

    protected $google_client;
    protected $vision_service_client;
    protected $phpRaw;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {
        // Create the cloud service vision client
        $this->google_client = new Google_Client();
        $this->google_client->useApplicationDefaultCredentials();
        $this->google_client->addScope(Google_Service_Appengine::CLOUD_PLATFORM);

        $this->vision_service_client = new Google_Service_Vision($this->google_client);
        $this->phpRaw = new phpRAW();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get the most recent X posts, for now using the default 25
        $annotations = $this->getUnseenListings($this->phpRaw->getHot());
        $this->labelCollection($annotations);
    }

    /**
     * Gets a collection of newly created unseen listings.
     *
     * @param $submissions
     * @return Collection
     */
    private function getUnseenListings($submissions)
    {
        $annotations = new Collection();

        foreach ( $submissions->children as $submission ) {
            // Check if submission has already been annotated.
            $annotation = Annotation::findByRedditId($submission->data->id);
            // If submission is a text submission or the post has already been annotated, skip.
            if ( $submission->data->is_self || $annotation ) continue;

            // Create a new annotation after verifying it has a preview
            if ( isset($submission->data->preview) ) {
                $annotation = Annotation::create([
                    'reddit_id'    => $submission->data->id,
                    'post_url'     => 'http://reddit.com' . $submission->data->permalink,
                    'image_url'    => $submission->data->preview->images[0]->source->url,
                    'reddit_title' => $submission->data->title,
                    'reddit_sub'   => $submission->data->subreddit
                ]);
                $annotations->add($annotation);
            }
        }

        return $annotations;
    }

    /**
     * Label a collection of images.
     *
     * @param Collection $annotations
     */
    private function labelCollection(Collection $annotations)
    {
        // Set the feature(s) for the request
        $feature = new Google_Service_Vision_Feature();
        $feature->setType('LABEL_DETECTION');
        $feature->setMaxResults(10);
        // Each request to Cloud Vision can have at most 12 images
        foreach ( $annotations->chunk(12) as $k => $annotations_chunk ) {
            $batch_request = new Google_Service_Vision_BatchAnnotateImagesRequest();
            $requests = [];
            foreach ( $annotations_chunk as $annotation ) {
                $request = new Google_Service_Vision_AnnotateImageRequest();
                $image_data = base64_encode(file_get_contents($annotation->image_url));
                // Set the image for the request
                $image = new Google_Service_Vision_Image();
                $image->setContent($image_data);
                $request->setImage($image);
                $request->setFeatures([$feature]);
                $requests[] = $request;
            }
            $batch_request->setRequests($requests);
            $response = $this->vision_service_client->images->annotate($batch_request);

            // Handle the response by labeling each image
            $batch_responses = $response->getResponses();
            foreach ( $batch_responses as $key => $res ) {
                // Set a label for easy entity annotation
                // The annotation index is the chunk number * chunk size + current index in response.
                $current_annotation = $annotations[$k * 12 + $key];
                $this->labelImage($current_annotation, $res->getLabelAnnotations());
                // If CloudVision was unable to label this image, delete the annotation.
                if ( $current_annotation->labels->count() < 1 ) {
                    error_log("Deleteing annotation $current_annotation->post_url");
                    $current_annotation->delete();
                }
            }
        }
    }

    /**
     * Label an image.
     *
     * @param Annotation $annotation
     * @param $labels
     */
    private function labelImage(Annotation $annotation, $labels)
    {
        foreach ( $labels as $label ) {
            // TODO: Store score in pivot table. Is it necessary? Come back.
            // Only include labels that have a 70% or creater confidence score
            if ( $label->score >= 0.70 )
                $annotation->labels()->attach(Label::firstOrCreate([
                    'description' => $label->description,
                    'mid'         => $label->mid
                ]));
        }
    }
}
