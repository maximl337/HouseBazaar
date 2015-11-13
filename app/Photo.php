<?php

namespace App;

use Log;
use Image;
use Imgur;
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

    public function owner()
    {
        return $this->property()->first()->owner()->first();
    }

    public function baseDir()
    {
        return '/images/properties';
    }

    public function delete()
    {
        \File::delete([
                $this->path,
                $this->thumbnail_path
            ]);

        parent::delete();
    }

    public static function uploadToImgur($image_path)
    {

        $imageData = array(
            'image' => $image_path,
            'type'  => 'file'
        );

        try {

            $basic = Imgur::api('image')->upload($imageData);

            Log::info("imgur", [serialize($basic)]);

            //parse response
            $resp = $basic->getData();

            return $resp['link'];

        } catch(\Exception $e) {

            throw $e;
        }
        
    }


}
