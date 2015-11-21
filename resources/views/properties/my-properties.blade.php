@inject('countries', 'App\Http\Utilities\Country')

@extends('layout')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-10">
                
                @foreach($properties as $property)
                    
                    <div class="row {{ $property->published ? ' published' : '' }}">
                        <div class="col-md-2 thumbnail">
                            <a href="{{ $property->published ? $property->path() : '/preview/' . $property->id }}">
                                <img src="{{ $property->photos->first()['thumbnail_path'] }}">
                            </a>
                        </div> <!-- .col -->

                        <div class="col-md-8 details">
                            <h3>{{ $property->street }}</h3>
                            <p>{{ str_limit($property->description, 25) }}</p>
                            <span class="label label-default">Bedrooms: {{ $property->bedrooms == 0.0 ? "Bachelor / Studio" : $property->bedrooms }}</span>
                            <span class="label label-default">Bathrooms: {{ $property->bathrooms ?: "Not given" }}</span>
                            <span class="label label-default">Size (sqft): {{ $property->size_square_feet == 0.00 ? "Not given" : $property->size_square_feet }}</span>
                        </div> <!-- .col -->

                        <div class="col-md-2">
                            <h3><a class="btn btn-primary" href="/properties/{{ $property->id }}/edit"><i class="fa fa-pencil"></i> Edit</a></h3>
                        </div> <!-- .col -->
                    </div> <!-- .row -->

                @endforeach        
                
            </div> <!-- .col -->

            <div class="col-md-10 col-md-offset-1 text-center">
                    
                    {!! $properties->appends(['sort' => !empty($_GET['sort']) ? $_GET['sort'] : '', 'order' => !empty($_GET['order']) ? $_GET['order'] : ''])->render() !!}

            </div>
        
        </div> <!-- .row -->

    </div> <!-- .container -->

@stop