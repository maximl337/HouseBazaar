@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <h1>{!! $property->street !!}</h1>
            <h2>{!! $property->price !!}</h2>

            <hr />

            <div class="description">{!! nl2br($property->description) !!}</div>        
        </div> <!-- .col -->

        <div class="col-md-8">

            @foreach ($property->photos->chunk(4) as $set)
                <div class="row">
                    @foreach ($set as $photo )
                        <div class="col-md-3 gallery-image">
                            <img src="/{{ $photo->thumbnail_path }}">    
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
    
    

    
        

    
@stop

@section('scripts.footer')

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>

    <script type="text/javascript">
        Dropzone.options.addPhotosForm = {

            paramName: 'photo',
            maxFilesize: 3,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp'
        }
    </script>
@stop