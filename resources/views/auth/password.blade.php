@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">

        <h3 class="text-center">Forget your password?</h3>
        <p class="small">Enter your email and we will send a link to reset your password to your inbox</p>
        <hr />
        <form method="POST" action="/password/email">
            {!! csrf_field() !!}
                
            
            @if (count($errors) > 0)
                <div class="form-group">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="form-group">
                    <p class="alert alert-success">{{ session('status') }}</p>
                </div>
            @endif 

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" required type="email" name="email" value="{{ old('email') }}" placeholder="your_email@example.com">
            </div>

            <div class="form-group">
                <button class="btn btn-primary form-control" type="submit">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection