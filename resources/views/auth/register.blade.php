@extends('layout')

@section('content')
    
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form method="POST" action="/auth/register">
            {!! csrf_field() !!}
            
            <div class="form-group">
                Name
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
            </div>
            
            <div class="form-group">
                Email
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            
            <div class="form-group">
                Password
                <input class="form-control" type="password" name="password" required>
            </div>
            
            <div class="form-group">
                Confirm Password
                <input class="form-control" type="password" name="password_confirmation" required>
            </div>
            
            <div class="form-group">
                <button class="form-control btn btn-primary" type="submit">Register</button>
            </div>
        </form>

        @include('errors.errors')
    </div>
</div>



@stop