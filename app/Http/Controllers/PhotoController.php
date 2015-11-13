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

        if($property->photos()->count() === 10) {

            return response()->json([
                    "Property cannot have more than 10 photos"
                ], 403);
            
        }

        $photo = $request->file('photo');

        try {

            (new AddPhotoToProperty($property, $photo))->saveToImgur();

        } catch(\Exception $e) {

            return $e->getMessage();
        }

        

    }

    public function destroy($id)
    {
        Photo::findOrFail($id)->delete();

        return back();
    }
}
