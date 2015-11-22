@inject('countries', 'App\Http\Utilities\Country')

@extends('layout')

@section('header-meta')
    <title> Browse properties | House me now | Buy and sell properties with beautiful property pages</title>
    <meta name="description" content="Home me now is an online portal to Buy and sell properties quickly with beautiful property pages. Buy, sell and rent properties, homes" />
    <meta name="keywords" content="buy sell property, rent, house, home, rental, bedrooms, bathrooms">
    <link rel="canonical" href="http://housemenow-staging.herokuapp.com/browse" />
@endsection

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10">
                
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
        </div>

        <div class="row">
            
        	<div class="col-md-10">
        		
        		@foreach($properties as $property)
                    
                    <div class="row hidden-sm hidden-xs">
                        <div class="col-md-2 thumbnail">
                            <a title="Click to view property" href="{{ $property->path() }}">
                                <img alt="Property image" title="click to view property" src="{{ $property->photos->first()['thumbnail_path'] }}">
                            </a>
                        </div> <!-- .col -->

                        <div class="col-md-8 details">
                            <h2>{{ $property->street }}</h2>
                            <p>{{ str_limit($property->description, 25) }}</p>
                            <span class="label label-default">Bedrooms: {{ $property->bedrooms == 0.0 ? "Bachelor / Studio" : $property->bedrooms }}</span>
                            <span class="label label-default">Bathrooms: {{ $property->bathrooms ?: "Not given" }}</span>
                            <span class="label label-default">Size (sqft): {{ $property->size_square_feet == 0.00 ? "Not given" : $property->size_square_feet }}</span>
                        </div> <!-- .col -->

                        <div class="col-md-2 price">
                            <h3 class="pull-right">{{ $property->price ? "$ " . number_format($property->price) : "Contact" }}</h3>
                        </div> <!-- .col -->
                    </div> <!-- .row -->

                    <div class="row visible-xs visible-sm">
                        
                        <div class="col-md-12">

                            <a title="Click to view property" href="{{ $property->path() }}">
                                <img src="{{ $property->photos->first()['path'] }}">
                            </a>

                            <h2>{{ $property->street }}</h2>
                            <p>{{ str_limit($property->description, 25) }}</p>
                            <span class="label label-default">Bedrooms: {{ $property->bedrooms == 0.0 ? "Bachelor / Studio" : $property->bedrooms }}</span>
                            <span class="label label-default">Bathrooms: {{ $property->bathrooms ?: "Not given" }}</span>
                            <span class="label label-default">Size (sqft): {{ $property->size_square_feet == 0.00 ? "Not given" : $property->size_square_feet }}</span>


                            
                        </div> <!-- .col -->
                        
                    </div> <!-- .row -->
                    <hr />
                @endforeach        
        		
        	</div> <!-- .col -->

            <div class="col-md-10 col-md-offset-1 text-center">
                    
                    {!! $properties->appends(['sort' => !empty($_GET['sort']) ? $_GET['sort'] : '', 'order' => !empty($_GET['order']) ? $_GET['order'] : ''])->render() !!}

            </div>
        
        </div> <!-- .row -->
    
    </div> <!-- .container -->

@stop