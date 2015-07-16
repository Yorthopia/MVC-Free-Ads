@extends('layouts.default')
@section('content')
@if (Auth::user())
<h2>Vos informations</h2>
<div class="info">
	<p>Login : {{ Auth::user()->username }}</p>
	<p>Nom : {{ Auth::user()->name }}</p>
	<p>Prénom : {{ Auth::user()->lastname }}</p>
	<p>Date de naissance : {{ Auth::user()->birthdate }}</p>
	<p>Mail : {{ Auth::user()->mail }}</p>
	<a class="btn btn-default edit" href="{{ url('edit') }}"><span class="glyphicon glyphicon-folder-open"></span> Editer</a>
	<a class="btn btn-default delete" href="{{ url('delete') }}"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
</div>
@if ($infos)
<h2>Vos Annonces</h2>
<div class="row">
@foreach ($infos->getResults()->all() as $info)
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail">
			@if ($info->image)
			@foreach ($info->image as $image)
			<div class="img">
				<img class="pix" src="{{ URL::asset('files/storage/'.$image->key_pix)}}" alt="{{ $image->name }}">
			</div>
			@endforeach
			@endif
			<div class="caption">
				<h3>{{ $info->title }}</h3>
				<p><span class="glyphicon glyphicon-user"></span> {{ $infos->getParent()->username }}</p>
				<p>{{ $info->describe }}</p>
				<p>{{ $info->price }}€</p>
				<p>Créé le {{ $info->created_at }}</p>
				<p>Modifié le {{ $info->updated_at }}</p>
				<p><a href="{{ action('AnnoncesController@edit', $info->id) }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-folder-open"></span> Editer</a> <a href="{{ action('AnnoncesController@destroy', $info->id) }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-trash"></span> Supprimer</a></p>
			</div>
		</div>
	</div>
@endforeach
</div>
@endif
@endif
@stop