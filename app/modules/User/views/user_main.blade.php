<!DOCTYPE html>
<html lang="lv">
<head>
	<meta charset="utf-8">
	<title>Efumo testa uzdevums</title>
	<link href="{{ asset('/css/user.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div id="json-container" data-json="{{ $json or '{}' }}"></div>
		Izvēlne
		<ul>
		@if (Auth::check())
			<li><a href="{{ url('/auth/logout') }}">Iziet</a></li>
		@else
			<li><a href="{{ url('/user/create') }}">Reģistrācija</a></li>
			<li><a href="{{ url('/auth/login') }}">Autorizācija</a></li>
		@endif
		</ul>
		@yield('content')
	</div>
	<script src="{{ asset('/js/jquery-1.11.2.min.js') }}"></script>
	<script src="{{ asset('/js/user.js') }}"></script>
</body>
</html>