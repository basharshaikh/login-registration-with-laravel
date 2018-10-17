<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel framework prac</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
	<div class="container">

		<div class="jumbotron">
			<h1 class="text-center">My Registration Page</h1>
			<h2>Register here</h2>

			<form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
				
				<!-- error msg all -->
				@if(count($errors) > 0)
				<div class="alert alert-warning">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@elseif(session('message'))
				<div class="alert alert-warning">
					{{ session('message') }}
				</div>
				@endif

				<div class="form-group">
					<label for="">Email address:</label>
					<input type="text" class="form-control" name="email" value="{{ old('email') }}">

					<!-- error msg of specific field -->
					{{-- @if(count($errors) > 0)
					<div class="alert alert-warning">
						{{ $errors->first() }}
					</div>
					@endif --}}
					<!-- error msg of specific field -->
					{{-- @if(count($errors) > 0)
					<div class="alert alert-warning">
						{{ $errors->first('email') }}
					</div>
					@endif --}}
				</div>

				<div class="form-group">
					<label for="">Username:</label>
					<input type="text" class="form-control" name="username" value="{{ old('username') }}">
				</div>
				
				<div class="form-group">
					<label for="">Password:</label>
					<input type="password" class="form-control" name="password" value="{{ old('password') }}">
				</div>
				
				<div class="form-group">
					<label for="">Photo:</label>
					<input type="file" class="form-control" name="photo">
				</div>
				
				<div class="form-group">
					{!! csrf_field() !!}
					<button type="submit" class="btn btn-success" name="registration">Registration</button>
				</div>

			</form>
		</div>



	</div>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>