@inject('countries', 'App\Http\Utilities\Country')

@inject('property_types', 'App\Http\Utilities\PropertyType')

@inject('bedroom', 'App\Http\Utilities\Bedroom')

@inject('bathroom', 'App\Http\Utilities\Bathroom')

@inject('transaction_types', 'App\Http\Utilities\TransactionType')

@inject('seller_types', 'App\Http\Utilities\SellerType')

@extends('layout')

@section('content')

<h1>Edit Property</h1>

<div class="row">
	
	<div class="col-md-10 col-md-offset-1">

		<form role="form" method="POST" action="/properties/{{ $property->id }}">

        {{ csrf_field() }}

        <input type="hidden" name="_method" value="POST">

        <fieldset>

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
        
        </fieldset>

        <div class="form-group">
            <label for="price">Sale Price</label>
            <input name="price" id="price" type="text" class="form-control" required value="{{ $property->price }}">
        </div>

        <div class="form-group">
            <label for="description">Property Description</label>
            <textarea name="description" id="description" class="form-control" rows="10" required>{{ $property->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="bedrooms">Bedrooms</label>
            <select id="bedrooms" name="bedrooms" class="form-control">

                 @foreach($bedroom::all() as $key => $val)

                    <option value="{{ $key }}" {{ $key == $property->bedrooms ? 'selected="selected"' : '' }}>{{ $val }}</option>

                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="bathrooms">Bathroom</label>
            <select id="bathrooms" name="bathrooms" class="form-control">

                @foreach($bathroom::all() as $key => $val)

                    <option value="{{ $key }}" {{ $key == $property->bathrooms ? 'selected="selected"' : '' }}>{{ $val }}</option>

                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="transaction_type">Rent or Sale?</label>
            <select id="transaction_type" name="transaction_type" class="form-control">
                @foreach($transaction_types::all() as $key => $val)

                    <option value="{{ $val }}" {{ $val == $property->transaction_type ? 'selected="selected"' : '' }}>{{ 'For ' . $val }}</option>

                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="property_type">Property type</label>
            <select id="property_type" name="property_type" class="form-control">
                @foreach($property_types::all() as $type)

                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>

                @endforeach
            </select>
        </div>
    
        <div class="form-group">
            <label for="size_square_feet">Size (sqft)</label>
            <input id="size_square_feet" class="form-control" type="text" name="size_square_feet" value="{{ $property->size_square_feet }}" placeholder="eg: 2500" />
        </div>

         <div class="checkbox">
          <label><input type="checkbox" name="furnished" value="{{ $property->furnished }}" {{ $property->furnished == 1 ? ' checked="checked"' : '' }}><strong>Furnished</strong></label>
        </div>  

        <div class="checkbox">
          <label><input type="checkbox" name="pets" value="{{ $property->pets }}" {{ $property->pets == 1 ? ' checked="checked"' : '' }}><strong>Pets</strong></label>
        </div>

        <div class="form-group">
            <label for="youtube_url">Youtube Video Link</label>
            <input id="youtube_url" class="form-control" type="text" name="youtube_url" value="{{ $property->youtube_url }}" placeholder="Enter a link to a youtube video" />
        </div>

        <hr />

        <div class="form-group">
            <label for="contact_phone_1">Contact: Phone 1</label>
            <input id="contact_phone_1" class="form-control" type="text" name="contact_phone_1" value="{{ $property->contact_phone_1 }}" placeholder="Enter a contact phone number" />
        </div>
        
        <div class="form-group">
            <label for="contact_phone_2">Contact: Phone 2</label>
            <input id="contact_phone_2" class="form-control" type="text" name="contact_phone_2" value="{{ $property->contact_phone_2 }}" placeholder="Enter another contact phone number" />
        </div>

        <div class="form-group">
            <label for="contact_email">Contact: Email</label>
            <input id="contact_email" class="form-control" type="text" name="contact_email" value="{{ $property->contact_email }}" placeholder="Enter a contact email address" />
        </div>

        <div class="form-group">
            <label for="seller_type">You are:</label>
            <select id="seller_type" name="seller_type" class="form-control">
                @foreach($seller_types::all() as $key => $val)

                    <option value="{{ $key }}" {{ $key == $property->seller_type ? 'selected="selected"' : '' }}>{{ $val }}</option>

                @endforeach
            </select>
        </div>

        <div class="checkbox">
          <label><input type="checkbox" name="allow_comments" value="1" {{ $property->allow_comments == 1 ? ' checked="checked"' : '' }}><strong>Allow comments on property page</strong></label>
        </div>

        <div class="form-group">
            @include('errors.errors')
        </div>

        <div class="form-group">
            <input value="Update Property" type="submit" class="form-control btn btn-primary">
        </div>
			
		</form>
	</div> <!-- .col -->

    <div class="col-md-10 col-md-offset-1">
        <div class="popup-gallery" itemscope itemtype="http://schema.org/ImageGallery">
            <label for="photos">Photos</label>
            @foreach ($property->photos->chunk(4) as $set)
                
                <div class="row">
                    @foreach ($set as $photo )
                        <div class="col-md-3 col-sm-4 col-xs-6 gallery-image">
                            
                            @if(Auth::user() && Auth::user()->owns($property))
                                {!! link_to('<i class="fa fa-times"></i>', $photo, 'DELETE', 'btn btn-danger', 'Remove property photo') !!}
                            @endif

                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                <a href="{{ $photo->path }}" itemprop="contentUrl" data-size="{{ $photo->size['width'] . 'x' . $photo->size['height'] }}">
                                    <img src="{{ $photo->thumbnail_path }}" itemprop="thumbnail" alt="{{ $property->street }}" style="max-width: 200px;" />
                                </a>
                            </figure>

                            
                        </div> <!-- .col-md-3 -->
                    @endforeach        
                </div> <!-- .row -->
            @endforeach

            <hr />
            @if(Auth::user() && Auth::user()->owns($property))
                <form id="addPhotosForm" action="/{{ $property->id }}/photos" method="POST" class="dropzone">
                    {{ csrf_field() }}
                </form>
            @endif
        </div>
    </div> <!-- .col -->

</div>



@stop

@section('scripts.footer')

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>

    <script type="text/javascript">
        Dropzone.options.addPhotosForm = {

            paramName: 'photo',
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp'
        }

        $(document).ready(function() {
            $('.popup-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc: function(item) {
                        return item.el.attr('title') + '<small></small>';
                    }
                }
            });
        });

        
    </script>
@stop