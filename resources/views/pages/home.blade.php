@extends('layout')

@section('content')

    

    <div class="jumbotron">
        <h1> House Bazaar </h1>

        <p>This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point to create something more unique by building on or modifying it.</p>

        @if(Auth::check())
            <a href="/properties/create" class="btn btn-primary">Create a flyer</a>
        @else
            <a href="/auth/register" class="btn btn-primary">Sign up</a>   
        @endif

    </div>

@stop