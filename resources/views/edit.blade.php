@extends('layouts.default')
@section('content')
<h2>Editer vos informations de compte</h2>
@if (Auth::user())
	<div class="form-wrapper">
		{!! Form::open(array('url' => 'update')) !!}
			<div class="form-group">
				{!! Form::label('username', 'Login : ') !!}
				{!! Form::text('username', null, ['required', 'class' => 'form-control', 'placeholder' => Auth::user()->username]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('password', 'Mot de passe : ') !!}
				{!! Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'Votre nouveau mot de passe']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('mail', 'Adresse mail : ') !!}
				{!! Form::text('mail', null, ['class' => 'form-control', 'placeholder' => Auth::user()->mail]) !!}
			</div>
			{!! Form::submit("S'inscrire", ['class' => 'btn btn-primary form-control']) !!}
		{!! Form::close() !!}
	</div>
@endif
@stop