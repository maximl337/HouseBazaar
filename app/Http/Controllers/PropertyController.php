<?php

namespace App\Http\Controllers;

use Auth;
use Log;
use App\Photo;
use App\Property;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Forms\AddPhotoToProperty;

class PropertyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'index']]);

        $this->middleware('property.owner', ['only' => ['addPhoto', 'preview']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit') ?: 9;

        $page = $request->get('page') ?: 0;

        $properties = Property::paginate($limit);

        return view('pages.home', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {

        $input = $request->input();

        $exists = Property::where([
                'street'    => $input['street'],
                'zip'       =>  $input['zip'],
                'state'     =>  $input['state']
            ])->exists();

        if($exists) {

            flash()->overlay("Error", "A property with the street, zip, state already exists!", 'error');

            return back();
        }

        $photos = $request->file('photos');

        if(count($photos) > 10) {

            flash()->overlay("Error", "Maximum number of photos allowed is 10");

            return back();
        }

        $input['street'] = trim($input['street']);

        $input['zip'] = trim($input['zip']);
        
        $input['state'] = trim($input['state']);

        $property = Auth::user()->publish(
            new Property($input)
        );

        foreach($photos as $photo) {

            (new AddPhotoToProperty($property, $photo))->saveToImgur();

            Log::info("Photo instance:" . get_class($photo));

        }

        flash()->overlay("Success", "Property Added!");

        return redirect('/preview/'.$property->id); // redirect($property->path()) 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($country, $zip, $street)
    {

        try {

            $property =  Property::locatedAt($country, $zip, $street);

            foreach($property->photos as $photo) {

                $photo->size = getjpegsize($photo->path);
            }

            return view('properties.show', compact('property'));


        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            flash()->overlay("Error", "Could not find property with the given ID", 'error');

            return back();

        } catch(\Exception $e) {

            flash()->overlay("Error", $e->getMessage(), 'error');

            return back();
        }

        
    }

    public function preview($id)
    {
        try {

            $property = Property::findOrFail($id);

            return view('properties.preview', compact('property'));
        
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            flash()->overlay("Error", "Property not found", 'error');

            return back();

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $property = Property::findOrFail($id);    

            foreach($property->photos as $photo) {

                $photo->size = getjpegsize($photo->path);
            }

            return view('properties.edit', compact('property'));

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            flash()->overlay("Error", "Could not find property with the given ID", 'error');

            return back();

        } catch(\Exception $e) {

            flash()->overlay("Error", $e->getMessage(), 'error');

            return back();
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePropertyRequest $request, $id)
    {
        try {

            $property = Property::findOrFail($id);

            $property->update($request->input());

            flash()->overlay("Success", "Property updated successfully", "success");

            return $property->published ? redirect($property->path()) : redirect('/preview/' . $property->id);

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            flash()->overlay("Error", "Could not find property with the given ID", 'error');

            return back();

        } catch(\Exception $e) {

            flash()->overlay("Error", $e->getMessage(), 'error');

            return back();
        }
    }

    public function publish($id)
    {
        try {

            $property = Property::findOrFail($id);

            $property->published = true;

            $property->save();

            flash()->overlay("Success", "Property published!");

            return redirect($property->path());

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            flash()->overlay("Error", "Property not found", "error");

            return back();

        } catch(\Exception $e) {

            flash()->overlay("Error", $e->getMessage(), "error");

            return back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $property = Property::findOrFail($id);

            $property->delete();

            flash()->overlay("Success", "Property was deleted", "success");

            return redirect("/");

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            flash()->overlay("Error", "Could not find property with the given ID", 'error');

            return back();

        } catch(\Exception $e) {

            flash()->overlay("Error", $e->getMessage(), 'error');

            return back();
        }
    }
}
