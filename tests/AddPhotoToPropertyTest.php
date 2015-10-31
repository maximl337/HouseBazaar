<?php

namespace App\Forms;

use Mockery as m;
use App\Forms\AddPhotoToProperty;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddPhotoToPropertyTest extends \TestCase
{

    use DatabaseTransactions;

    /** @test */
    function it_processes_file()
    {

        $property = factory(\App\Property::class)->create();

        $file = m::mock(UploadedFile::class, [
                'getClientOriginalName' => 'foo',
                'getClientOriginalExtension' => 'jpg'
            ]);

        $file->shouldReceive('move')
            ->once()
            ->with('images/properties/photos', 'nowfoo.jpg');

        $thumbnail = m::mock(\App\Services\Thumbnail::class);

        $thumbnail->shouldReceive('make')
            ->once()
            ->with('images/properties/photos/nowfoo.jpg', 'images/properties/photos/tn-nowfoo.jpg');

        $form = new AddPhotoToProperty($property, $file, $thumbnail);

        $form->save();

        $this->assertEquals(1, count($property->photos));

    }

}

function time()
{
    return 'now';
}

function sha1($path)
{
    return $path;
}