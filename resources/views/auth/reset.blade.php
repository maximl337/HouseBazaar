@extends('layout')

@section('content')
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<h3 class="text-center">Password reset</h3>
        <hr />

		<form role="form" method="POST" action="/password/reset">
		    {!! csrf_field() !!}
		    <input type="hidden" name="token" value="{{ $token }}">

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
		        Email
		        <input class="form-control" required type="email" name="email" value="{{ old('email') }}" placeholder="your_email@example.com">
		    </div>

		    <div class="form-group">
		        Password
		        <input class="form-control" required type="password" name="password" placeholder="Enter a password">
		    </div>

		    <div class="form-group">
		        Confirm Password
		        <input class="form-control" required type="password" name="password_confirmation" placeholder="Retype password">
		    </div>

		    <div class="form-group">
		        <button class="btn btn-primary form-control" type="submit">
		            Reset Password
		        </button>
		    </div>
		</form>
	</div> <!-- .col -->
</div> <!-- .row -->
@endsection