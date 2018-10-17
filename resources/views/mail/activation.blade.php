<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Atcivation mail</title>
</head>
<body>
	<h2>Welcome, {{ $username }}</h2>
	<p>Please click on link to activate your account</p>
	<a href="http://laravel/activate/{{ $activation_token }}">Activate your acccount.</a>
</body>
</html>