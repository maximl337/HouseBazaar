@extends('layout')

@section('content')

    <div class="row property">

        <div class="col-md-4">

            <h1>{{ $property->street }}</h1>
            <h2>{!! $property->price ? "$" . number_format($property->price) : "Contact for price" !!}</h2>

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

            @if(Auth::user() && Auth::user()->owns($property))
                
                <a href="/properties/{{ $property->id }}/edit" class="btn btn-primary pull-left">Edit property</a>

                {!! link_to('Delete', $property, 'DELETE', 'btn btn-danger', 'Delete property?') !!}

            @endif
        </div> <!-- .col -->

        <div class="col-md-8 popup-gallery" itemscope itemtype="http://schema.org/ImageGallery">


            @foreach ($property->photos->chunk(4) as $set)
                
                <div class="row">
                    @foreach ($set as $photo )
                        <div class="col-md-3 col-sm-4 col-xs-6 gallery-image">
                        

                            <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                                <a href="{{ $photo->path }}" itemprop="contentUrl" data-size="{{ $photo->size['width'] . 'x' . $photo->size['height'] }}">
                                    <img src="{{ $photo->thumbnail_path }}" itemprop="thumbnail" alt="{{ $property->street }}" style="max-width: 200px;" />
                                </a>
                            </figure>

                            
                        </div> <!-- .col-md-3 -->
                    @endforeach        
                </div> <!-- .row -->
            @endforeach

        </div> <!-- .col -->

    </div> <!-- .row -->

  

@stop

@section('scripts.footer')

    <script type="text/javascript">

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