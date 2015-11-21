@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            
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

                @include('errors.errors')

                <div class="form-group">
                    <button class="form-control btn btn-primary" type="submit">Login</button>
                </div>
            </form>    

            
            <p class="text-center"><a href="/auth/register">Dont have an account? Click here to make one.</a></p>
            <p class="text-center"><a href="/password/email">Forget your password?</a></p>

        </div> <!-- EO .col -->
    </div> <!-- EO .row -->
</div> <!-- .container -->

    


@stop