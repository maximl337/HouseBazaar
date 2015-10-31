@extends('layout')

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        
        <form method="POST" action="/auth/login" class="form">
            {!! csrf_field() !!}

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" id="password" required>
            </div>

            <div class="checkbox">
                <label>
                    <input class="checkbox" type="checkbox" name="remember"> Remember Me
                </label>
                
            </div>

            <div class="form-group">
                <button class="form-control btn btn-primary" type="submit">Login</button>
            </div>
        </form>    

        @include('errors.errors')
    </div> <!-- EO .col -->
</div> <!-- EO .row -->

    


@stop