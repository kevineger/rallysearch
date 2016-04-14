<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\AnnotateTopPosts;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Annotation;
use App\Label;

use View;

class AnnotationController extends Controller {

    /**
     * Display a collection of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active_labels = $request->get('active_labels');
        $annotations = $this->getFilteredAnnotations($active_labels);
        error_log("(Index) Active labels:");
        if ($active_labels)
            foreach ($active_labels as $key => $alab)
            {
                error_log("Label " . $key . ": " . $alab);
            }

        $labels = Label::lists('description', 'id');

        return response()->view('content-search.index', [
            'tagline'       => 'Browse Reddit by it\'s content',
            'annotations'   => $annotations,
            'labels'        => $labels,
            'active_labels' => $active_labels
        ]);
    }

    /**
     * Returns the annotation partial with the specified filter applied.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function filter(Request $request)
    {
        $active_labels = $request->get('active_labels');
        $annotations = $this->getFilteredAnnotations($active_labels);

        error_log("(Filter) Active labels:");
        if ($active_labels)
            foreach ($active_labels as $alab)
            {
                error_log($alab);
            }

        return View::make('content-search.annotation-cards', [
            'annotations'   => $annotations,
            'active_labels' => $active_labels
        ]);
    }

    /**
     * Helper function to index and filter to get the annotations.
     *
     * @param $labels
     * @return mixed
     */
    public function getFilteredAnnotations($labels)
    {
        if (!$labels)
            $annotations = Annotation::paginate(20);
        else
        {
            $annotations = Annotation::whereHas('labels', function ($query) use ($labels)
            {
                $query->whereIn('description', $labels);
            })->paginate(20);
        }

        return $annotations;
    }

    /**
     * NOTE: For testing purposes only.
     *
     * Manually trigger annotation job.
     */
    public function cloudVision()
    {
        $this->dispatch(new AnnotateTopPosts);
    }

    /**
     * NOTE: For testing purposes only.
     *
     * Analyze a single hardcoded image.
     *
     * @param Request $request
     */
    public function single(Request $request)
    {
        $client = new \Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope(\Google_Service_Appengine::CLOUD_PLATFORM);
        $im = file_get_contents('https://i.redditmedia.com/GYofTRVZe5Ay0d8iW7UnCoMt0K_gor71oedLNWnOB3Y.jpg?s=d87a29eb089e183e75a906e2719c0ff8');
        $imdata = base64_encode($im);
        // Create the cloud service vision object
        $visionService = new \Google_Service_Vision($client);
        // Create the image request
        $request = new \Google_Service_Vision_AnnotateImageRequest();
        // Set the image for the request
        $image = new \Google_Service_Vision_Image();
        $image->setContent($imdata);
        $request->setImage($image);
        // Set the feature(s) for the request
        $feature = new \Google_Service_Vision_Feature();
        $feature->setType('LABEL_DETECTION');
        $feature->setMaxResults(7);
        $request->setFeatures([$feature]);
        // Set the request as one of the requests
        $requests = new \Google_Service_Vision_BatchAnnotateImagesRequest();
        $requests->setRequests([$request]);
        // Execute the request
        $response = $visionService->images->annotate($requests);

        dd($response);
    }
}
