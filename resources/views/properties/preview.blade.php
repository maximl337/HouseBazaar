@extends('layout')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-6">
            <h3>Preview</h3>
        </div>
        <div class="col-md-6">
            
                
                <a href="{{ action('PropertyController@edit', ['id' => $property->id]) }}" class="btn btn-primary pull-right">Make changes</a>
                <form class="pull-right" method="POST" action="{{ action('PropertyController@publish', ['id' => $property->id]) }}" role="form">

                    <input type="hidden" name="_method" value="post">

                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
                
                
           
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-4">

            <h1>{{ $property->street }}</h1>
            <h2>{!! "$" . number_format($property->price) !!}</h2>

            <hr />

            <div class="details">

                <div class="description">{!! nl2br($property->description) !!}</div>
                
                <table class="table table-bordered">
                    <tr>
                        <td>Bedrooms</td>
                        <td>{{ $property->bedrooms == 0 ? "Bachelor/Studio" : $property->bedrooms }}</td>
                    </tr>
                    <tr>
                        <td>Bathrooms</td>
                        <td>{{ $property->bathrooms }}</td>
                    </tr>
                    <tr>
                        <td>Size (sqft)</td>
                        <td>{{ $property->size_square_feet ?: "-" }}</td>
                    </tr>
                    <tr>
                        <td>Furnished</td>
                        <td>{{ $property->furnished ? "Yes" : "No" }}</td>
                    </tr>
                    <tr>
                        <td>Pets allowed</td>
                        <td>{{ $property->pets ? "Yes" : "No" }}</td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>{{ ucfirst($property->property_type) }}</td>
                    </tr>
                    <tr>
                        <td>For</td>
                        <td>{{ $property->transaction_type }}</td>
                    </tr>
                    <tr>
                        <td>Seller type</td>
                        <td>{{ ucfirst($property->seller_type) }}</td>
                    </tr>
                </table>
            </div>  
            
            <hr />
        </div> <!-- .col -->

        <div class="col-md-8 popup-gallery" itemscope itemtype="http://schema.org/ImageGallery">


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
        </div> <!-- .col -->

    </div> <!-- .row -->

</div> <!-- .container -->

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