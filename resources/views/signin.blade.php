@extends('layouts.default')
@section('content')
@if ($errors)
<div class="alert alert-danger">
	<ul>
	@foreach ($errors as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
</div>
@endif
<div class="form-wrapper">
	<h2>Inscription</h2>
	{!! Form::open(array('url' => 'addUser')) !!}
	<div class="form-group">
		{!! Form::label('username', 'Login : ') !!}
		{!! Form::text('username', null, ['required', 'class' => 'form-control', 'placeholder' => 'Votre login']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('password', 'Mot de passe : ') !!}
		{!! Form::password('password', null, ['required', 'class' => 'form-control', 'placeholder' => 'Votre mot de psse']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('name', 'Nom : ') !!}
		{!! Form::text('name', null, ['required', 'class' => 'form-control', 'placeholder' => 'Votre nom']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('lastname', 'Prénom : ') !!}
		{!! Form::text('lastname', null, ['required', 'class' => 'form-control', 'placeholder' => 'Votre prénom']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('birthdate', 'Date de naissance : ') !!}
		{!! Form::date('birthdate', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('mail', 'Adresse mail : ') !!}
		{!! Form::text('mail', null, ['required', 'class' => 'form-control', 'placeholder' => 'Votre adresse mail']) !!}
	</div>
	{!! Form::submit("S'inscrire", ['class' => 'btn btn-primary form-control']) !!}
	{!! Form::close() !!}
</div>
<div class="form-wrapper">
	<h2>Connexion</h2>
	{!! Form::open(array('url' => 'login')) !!}
		<div class="form-group">
			{!! Form::label('username', 'Login : ') !!}
			{!! Form::text('username', null, ['required', 'class' => 'form-control', 'placeholder' => 'Votre login']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('password', 'Mot de passe : ') !!}
			{!! Form::password('password', null, ['required', 'class' => 'form-control', 'placeholder' => 'Votre mot de passe']) !!}
		</div>
			{!! Form::submit("Se connecter", ['class' => 'btn btn-primary form-control']) !!}
	{!! Form::close() !!}
</div>
@stop