<?php

namespace App\Http\Controllers;

use Auth;
use App\Photo;
use App\Property;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PropertyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);

        $this->middleware('property.owner', ['only' => 'addPhoto']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $property = Auth::user()->publish(
            new Property($request->all())
        );

        flash()->overlay("Success", "Property Added!");

        return redirect($property->path()); // redirect
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {

        try {

            $property =  Property::locatedAt($zip, $street);

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

            return redirect($property->path());

        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            flash()->overlay("Error", "Could not find property with the given ID", 'error');

            return back();

        } catch(\Exception $e) {

            flash()->overlay("Error", $e->getMessage(), 'error');

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
