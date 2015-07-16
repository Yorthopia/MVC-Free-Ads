@extends('layouts.default')
@section('content')
<?php
	$tab = array();
	foreach ($infos->image as $image) {
		$tab[$image->id] = $image->name;
	}
?>
	@if (Auth::user())
		<h2>Editer votre annonce</h2>
		<div class="form-wrapper">
			{!! Form::open(array('url' => 'update/'.$infos->id, 'files' => true)) !!}
			<div class="form-group">
				{!! Form::label('title', 'Titre : ') !!}
				{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => $infos->title]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('describe', 'Description : ') !!}
				{!! Form::textarea('describe', null, ['class' => 'form-control', 'placeholder' => $infos->describe]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('price', 'Indiquez un prix : ') !!}
				{!! Form::number('price', null, ['class' => 'form-control', 'placeholder' => $infos->price]) !!}
			</div>
			<div class="form-group">
				{!! Form::label('select', "Choisissez l'image a modifier : ") !!}
				{!! Form::select('select[]', $tab, null, array('multiple' => true)) !!}
			</div>
			<div class="form-group">
				{!! Form::file('file[]', array('multiple' => true)) !!}
			</div>
			{!! Form::submit("Envoyer", ['class' => 'btn btn-primary form-control']) !!}
		{!! Form::close() !!}
		</div>
	@endif
@stop