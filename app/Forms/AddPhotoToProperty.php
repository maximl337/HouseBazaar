<?php 

namespace App\Forms;

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

        // Move the folder to images folder
        $this->file->move($photo->baseDir(), $photo->name);

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
}