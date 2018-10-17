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
        <h1>RRF Laravel 101</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <form action='{{ route('forgot-password') }}' method='post'>
            <div class="form-group">
                <label for='email'>Email Address: </label>
                <input type='text' class='form-control' name='email'>
            </div>

            <div class="form-group">
                {!! csrf_field() !!}
                <button type='submit' class='btn btn-success'>Send Password Reset</button>
            </div>
        </form>

        <a href="{{ route('login') }}" class="btn btn-info">Login</a>

    </div>



	</div>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>