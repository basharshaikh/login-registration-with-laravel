<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reset password mail</title>
</head>
<body>
	<h2>Welcome, {{ $username }}</h2>
	<p>Please click on link to reset your password</p>
	<a href="http://laravel/reset/{{ $reset }}">Reset Your Password</a>
</body>
</html>