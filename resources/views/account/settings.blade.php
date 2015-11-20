@extends('layout')

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		
		<h3>Update account</h3>
		<hr />
		<form id="account-settings" method="POST" action="/account/settings" role="form">

			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="POST">
			<div class="form-group">
				<label for="email">Email</label>
				<input id="email" class="form-control" type="email" name="email" value="{{ $user->email }}" required />
			</div>
			
			<div class="form-group">
				<label for="name">Name</label>
				<input id="name" class="form-control" type="text" name="name" value="{{ $user->name }}" required />
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary form-control">Update</button>
			</div>
		</form>
		
	</div>
</div>

@endsection