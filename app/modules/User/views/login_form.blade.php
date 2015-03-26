@extends('user::user_main')

@section('content')
<h1>Autorizācija</h1>
<hr/>
@if ($errors->any())
	<div class="errors">
		Kļūdas:
		<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
@endif
{!! Form::open(['url'=>'auth/authenticate']) !!}
	<div class="form-group">
		<div class="form-left">{!! Form::label('email', 'E-pasts:') !!}</div>
		<div class="form-right">{!! Form::text('email') !!}</div>
	</div>
	<div class="form-group">
		<div class="form-left">{!! Form::label('password', 'Parole:') !!}</div>
		<div class="form-right">{!! Form::password('password') !!}</div>
	</div>
	<div class="form-group">
		{!! Form::submit('Ieiet') !!}
		<a href="#" class="reset-form">Atcelt</a>
	</div>
{!! Form::close() !!}
@endsection