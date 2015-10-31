<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'path',
        'property_id',
        'name',
        'thumbnail_path'
    ];

    protected $file;


    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/' . $name;

        $this->thumbnail_path = $this->baseDir() . '/tn-' . $name;
    }

    public function property()
    {
        return $this->belongsTo('App\Property');
    }


    public function baseDir()
    {
        return 'images/properties/photos';
    }


}
