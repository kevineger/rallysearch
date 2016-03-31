<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model {

    public $timestamps = false;

    /*
     * Fillable fields for a Label.
     * */
    protected $fillable = [
        'description',
        'mid'
    ];

    /**
     * A Label belongs to many Annotations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function annotation()
    {
        return $this->belongsToMany('App\Annotation');
    }
}
