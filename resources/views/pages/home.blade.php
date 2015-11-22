@inject('countries', 'App\Http\Utilities\Country')

@extends('layout')

@section('header-meta')
    <title> Home me now | Buy and sell properties with beautiful property pages</title>
    <meta name="description" content="Home me now is an online portal to Buy and sell properties quickly with beautiful property pages. Buy, sell and rent." />
    <meta name="keywords" content="buy sell property, rent, house, home, rental, bedrooms, bathrooms">
@endsection

@section('header')

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
@endsection

@section('content')
    
    <section>
        
        <div class="container-fluid" id="home-banner">
            
            <div class="row">
                
                <div class="col-md-12 text-center">
                    <h1 class="page-title">
                        <span>Home me now</span> is a place to buy, sell, rent properties.
                    </h1>
                    
                    <a title="Add property" href="/properties/create" class="btn btn-primary btn-lg">Add property</a>
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
                                    <li><a title="{{ $country }}" href="?country={{ $code }}">{{ $country }}</a></li>
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

                                    <div itemscope itemtype="http://schema.org/Product" class="property-wrap" style="">

                                        <div class="image-wrap" style="">
                                            <a title="Go to property" href="{{ $property->path() }}">
                                                <img itemprop="image" alt="House picture" src="{{ $property->photos->first()['path'] }}">
                                            </a>
                                        </div>

                                        <div class="info-wrap">
                                            <span itemprop="offers" itemscope itemtype="http://schema.org/Offer"><p itemprop="price" class="price">{{ "$" . number_format($property->price) }}</p></span>
                                            <p itemprop="name" class="address">{{ $property->street . ", " . $property->city }}</p>
                                            <p class="photos"><a itemprop="url" title="Go to property" href="{{ $property->path() }}">{{ $property->photos->count() }} photos</a></p>
                                        </div>
                                        
                                    </div>

                                </div> <!-- .col -->
                            @endforeach
                        </div> <!-- .row -->

            		@endforeach		

            		
            	</div> <!-- .col -->

                <div class="col-md-10 col-md-offset-1 text-center">
                        
                        <a title="Show more properties" class="btn btn-primary btn-lg" href="/browse">Show more</a>

                </div>
            
            </div> <!-- .row -->
        </div> <!-- .container -->

    </main>

@stop