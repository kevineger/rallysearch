<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annotation extends Model {

    /*
     * Array of fillable fields for resource.
     * */
    protected $fillable = [
        'reddit_id',
        'post_url',
        'image_url',
        'reddit_title',
        'reddit_sub'
    ];

    /**
     * Find an Annotation by reddit_id.
     *
     * @param $reddit_id
     */
    public static function findByRedditId($reddit_id)
    {
        return Annotation::where('reddit_id', $reddit_id)->first();
    }

    /**
     * An Annotation has many Labels.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function labels()
    {
        return $this->belongsToMany('App\Label');
    }
}
