@extends('layout')

@section('header-meta')
    <title> Home me now | Buy and sell properties with beautiful property pages</title>
    <meta name="description" content="Home me now is an online portal to Buy and sell properties quickly with beautiful property pages. Buy, sell and rent." />
    <meta name="keywords" content="buy sell property, rent, house, home, rental, bedrooms, bathrooms">
@endsection

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
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
                    {!! Recaptcha::render() !!}
                </div>
                
                @include('errors.errors')

                <div class="form-group">
                    <button class="form-control btn btn-primary" type="submit">Register</button>
                </div>
            </form>

            

            <p class="text-center"><a href="/auth/register">Already have an account? click here to sign in.</a></p>
            
            <p class="text-center"><a href="/password/email">Forget your password?</a></p>
        </div>
    </div>
</div> <!-- .container -->



@stop