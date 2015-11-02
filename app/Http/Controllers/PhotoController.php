<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Property;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Forms\AddPhotoToProperty;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPhotoRequest;

class PhotoController extends Controller
{

    public function __construct()
    {
        $this->middleware('photo.owner', ['only' => 'destroy']);
    }
    /**
     * Add photos to property
     * 
     * @param string $value [description]
     * @return working on it
     */
    public function store($id, AddPhotoRequest $request)
    {
        $property = Property::find($id);

        $photo = $request->file('photo');

        (new AddPhotoToProperty($property, $photo))->save();

    }

    public function destroy($id)
    {
        Photo::findOrFail($id)->delete();

        return back();
    }
}
