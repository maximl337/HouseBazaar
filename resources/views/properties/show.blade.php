@extends('layout')

@section('header')
    <meta property="og:url"                content="{{ url() . $property->path() }}" />
    <meta property="og:type"               content="place" />
    <meta property="og:title"              content="House me now" />
    <meta property="og:description"        content="House me now" />
    <meta property="og:image"              content="{{ $property->photos()->first()['path'] }}" />
@endsection

@section('content')

    <div class="row property">

        <div class="col-md-12">
            @include('errors.errors')
        </div>

        <div class="col-md-4">

            <h1>{{ $property->street }}</h1>
            <h2>{!! $property->price ? "$" . number_format($property->price) : "Contact for price" !!}</h2>

            <hr />

            <div class="social">
                   <a href="http://www.facebook.com/sharer.php?u={{ urlencode(url() . $property->path()) }}&t=house-me-now" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Share on facebook</a><br />

                   <a href="http://twitter.com/home?status=house-me-now+{{ urlencode(url() . $property->path()) }}" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Share on Twitter</a><br />

                   <a href="https://plus.google.com/share" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Share on Google+</a><br />

            </div>

            <div class="contact">
                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-envelope"></i> Email poster
                </button>

                <div class="collapse" id="collapseExample">
                    <div class="well">

                        <form id="contact" method="post" action="/message" role="form">

                            {!! csrf_field() !!}

                            <input type="hidden" name="_method" value="POST" />

                            <input type="hidden" name="user_id" value="{{ $property->user_id }}">

                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Enter your name" required />
                            </div>

                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required />
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input id="phone" class="form-control" type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number" required />
                            </div>

                            <div class="form-group">
                                <label for="body">Message *</label>
                                <textarea style="resize: none;" id="body" class="form-control" name="body" rows="4" placeholder="Enter a message" required>{{ old('body') }}</textarea>
                            </div>

                            <div class="form-group">
                                {!! Recaptcha::render() !!}
                            </div>

                            <div class="form-group">
                                <input class="form-control btn btn-primary" type="submit" value="Send" />
                            </div>
                        </form>
                    
                    </div>
                </div>
                
            </div>

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

    $('form#contact').on("submit", function(e) {

        $btn = $(this).find('input[type=submit]');

        $btn.val("Sending...");

        $btn.attr("disabled", "disabled");

    })

}); // EO DOM ready

    
</script>
@stop