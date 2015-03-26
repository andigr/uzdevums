@extends('user::user_main')

@section('content')
<h1>Info bloks</h1>
<hr/>
@if (Auth::check())
	Labdien, {{Auth::user()->name}}!
@else
	Jūs nav autorizejušies
@endif
@endsection