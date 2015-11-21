<?php 

namespace App\Forms;

use Log;
use Image;
use App\Photo;
use App\Property;
use App\Services\Thumbnail;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToProperty
{
    
    protected $file;

    protected $property;

    public function __construct(Property $property, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        $this->property = $property;

        $this->file = $file;

        $this->thumbnail = $thumbnail ?: new Thumbnail;

    }

    public function save()
    {
        // Attach the photo to flyer
        $photo = $this->property->addPhoto($this->makePhoto());

        Log::info("Photo Made:", [(array) $photo]);

        // Move the folder to images folder
        $target = $this->file->move($photo->baseDir(), $photo->name);

        Log::info("Photo moved:", [$target]);

        // generate a thumbnail
        $this->thumbnail->make($photo->path, $photo->thumbnail_path);
    }

    public function makePhoto()
    {
        return new Photo(['name' => $this->makeFileName()]);
    }

    public function makeFileName()
    {
        $name = sha1(
                    time() . $this->file->getClientOriginalName()
                );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

    public function saveToImgur()
    {
        //$original = $this->file->getRealPath();

        $fileName = $this->makeFileName();

        //move file
        $this->file->move('./images/properties', $fileName);

        $original_path = './images/properties/' . $fileName;

        $original_thumbnail_path = './images/properties/tn-' . $fileName;

        $this->thumbnail->make($original_path, $original_thumbnail_path);

        try {

            $path = Photo::uploadToImgur($original_path);

            $thumbnail_path = Photo::uploadToImgur($original_thumbnail_path);
            
            $new_photo = new Photo(['name' => $fileName, 'path' => $path, 'thumbnail_path' => $thumbnail_path]);

            $this->property->addPhoto($new_photo);

            // \File::delete([
            //     $original_path,
            //     $original_thumbnail_path
            // ]);

        } catch(\Exception $e) {

            throw $e;
        }

        
    }

}