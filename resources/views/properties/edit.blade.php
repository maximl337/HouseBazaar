@inject('countries', 'App\Http\Utilities\Country')

@extends('layout')

@section('content')

<h1>Edit Property</h1>

<div class="row">
	
	<div class="col-md-10 col-md-1">

		<form method="POST" action="/properties/{{ $property->id }}">

        {{ csrf_field() }}

        <input type="hidden" name="_method" value="PATCH">

        <div class="form-group">
            <label for="street">Street</label>
            <input name="street" id="street" type="text" class="form-control" required value="{{ $property->street }}">
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input name="city" id="city" type="text" class="form-control" required value="{{ $property->city }}">
        </div>
    
        <div class="form-group">
            <label for="zip">Zip/Postal Code</label>
            <input name="zip" id="zip" type="text" class="form-control" required value="{{ $property->zip }}">
        </div>

        <div class="form-group">
            <label for="country">Country</label>

            <select class="form-control" name="country" id="country" required>

                @foreach($countries::all() as $country => $code)

                    <option value="{{ $code }}" {{ $property->country == $code ? 'selected="selected"' : '' }} >{{ $country }}</option>

                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input name="state" id="state" type="text" class="form-control" required value="{{ $property->state }}">
        </div>
        
        <hr />

        <div class="form-group">
            <label for="price">Sale Price</label>
            <input name="price" id="price" type="text" class="form-control" required value="{{ $property->price }}">
        </div>

        <div class="form-group">
            <label for="description">Property Description</label>
            <textarea name="description" id="description" class="form-control" rows="10" required>{{ $property->description }}</textarea>
        </div>

        <div class="form-group">
            @include('errors.errors')
        </div>

        <div class="form-group">
            <input value="Update Property" type="submit" class="form-control btn btn-primary">
        </div>
			
		</form>
	</div>

</div>

@stop

