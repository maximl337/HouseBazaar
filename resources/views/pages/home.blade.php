@inject('countries', 'App\Http\Utilities\Country')

@extends('layout')

@section('content')

    <style type="text/css">
        .properties .property-wrap {

            overflow: hidden; 
            
            padding-bottom: 25px;
        }

        .properties .property-wrap .image-wrap {

            height: 90%; 
            overflow:hidden;
        }

        .properties .property-wrap .image-wrap img {

            max-width: 100%;

        }

        .properties .property-wrap .info-wrap {

            background: #34495e;
            padding: 15px;
            color: white;
            
        }

        .properties .property-wrap a {

            color: #1abc9c;
        }
    </style>

    
    <section>
        
        <div class="container-fluid">
            
            <div class="row">
                
                <div class="col-md-12">
                    <h1 class="page-title text-center">
                        <span>House me now</span>    is a place to buy, sell, rent properties.
                    </h1>
                    

                </div>
            </div>

        </div>

    </section>

    <main>
            
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Country <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">

                                @foreach($countries::all() as $country => $code)
                                    <li><a href="?country={{ $code }}">{{ $country }}</a></li>
                                @endforeach
                                
                            </ul>
                        </div>

                        @include('properties.sort')
                    

                </div> <!-- .col -->
            </div> <!-- .row -->

            <div class="row">
            	<div class="col-md-12">
            		
            		@foreach($properties->chunk(3) as $propertyRow)

                        <div class="row properties">
                            
                            @foreach($propertyRow as $property)
                                <div class="col-md-4">

                                    <div class="property-wrap" style="">

                                        <div class="image-wrap" style="">
                                            <img style="" src="{{ $property->photos->first()['path'] }}">
                                        </div>

                                        <div class="info-wrap">
                                            <p class="price">{{ "$" . number_format($property->price) }}</p>
                                            <p class="address">{{ $property->street . ", " . $property->city }}</p>
                                            <p class="photos"><a href="{{ $property->path() }}">{{ $property->photos->count() }} photos</a></p>
                                        </div>
                                        
                                    </div>

                                </div> <!-- .col -->
                            @endforeach
                        </div> <!-- .row -->

            		@endforeach		

            		
            	</div> <!-- .col -->

                <div class="col-md-10 col-md-offset-1 text-center">
                        
                        <a class="btn btn-primary" href="/browse">Show more</a>

                </div>
            
            </div> <!-- .row -->
        </div> <!-- .container -->

    </main>

@stop