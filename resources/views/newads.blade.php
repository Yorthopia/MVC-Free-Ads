@extends('layouts.default')
@section('content')
	@if (Auth::user())
		<h2>Ajouter une annonce</h2>
		<div class="form-wrapper">
			{!! Form::open(array('url' => 'addAds', 'files' => true)) !!}
			<div class="form-group">
				{!! Form::label('title', 'Titre : ') !!}
				{!! Form::text('title', null, ['required', 'class' => 'form-control', 'placeholder' => "Votre titre"]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('describe', 'Description : ') !!}
				{!! Form::textarea('describe', null, ['class' => 'form-control', 'placeholder' => 'Ajoutez une description']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('price', 'Indiquez un prix : ') !!}
				{!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => 'Ajoutez un prix']) !!}
			</div>
			<div class="form-group">
				{!! Form::file('file[]', array('multiple' => true)) !!}
			</div>
			{!! Form::submit("Envoyer", ['class' => 'btn btn-primary form-control']) !!}
		{!! Form::close() !!}
		</div>
	@endif
@stop