@extends('user::user_main')

@section('content')
<h1>Reģistrācija</h1>
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
{!! Form::open(['url'=>'user']) !!}
	<div class="form-group">
		<div class="form-left">{!! Form::label('name', 'Vārds:') !!}</div>
		<div class="form-right">{!! Form::text('name', null, ['class'=>$errors->has('name') ? 'error' : '']) !!}</div>
	</div>
	<div class="form-group">
		<div class="form-left">{!! Form::label('surname', 'Uzvārds:') !!}</div>
		<div class="form-right">{!! Form::text('surname', null, ['class'=>$errors->has('surname') ? 'error' : '']) !!}</div>
	</div>
	<div class="form-group">
		<div class="form-left">{!! Form::label('email', 'E-pasts:') !!}</div>
		<div class="form-right">{!! Form::text('email', null, ['class'=>$errors->has('email') ? 'error' : '']) !!}</div>
	</div>
	<div class="form-group">
		<div class="form-left">{!! Form::label('password', 'Parole:') !!}</div>
		<div class="form-right">{!! Form::password('password', ['class'=>$errors->has('password') ? 'error' : '']) !!}</div>
	</div>
	<div class="form-group">
		<div class="form-left">{!! Form::label('password_confirmation', 'Parole atkartoti:') !!}</div>
		<div class="form-right">{!! Form::password('password_confirmation', ['class'=>$errors->has('password_confirmation') ? 'error' : '']) !!}</div>
	</div>
	<div class="form-group">
		{!! Form::submit('Reģistrēties') !!}
		<a href="#" class="reset-form">Atcelt</a>
	</div>
{!! Form::close() !!}
@endsection