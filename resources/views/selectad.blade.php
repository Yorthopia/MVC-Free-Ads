@extends('layouts.default')
@section('content')
@if ($ad)
<div class="row">
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail">
			@if ($ad->image)
			@foreach ($ad->image as $image)
			<div class="img">
				<img class="pix" src="{{ URL::asset('files/storage/'.$image->key_pix)}}" alt="{{ $image->name }}">
			</div>
			@endforeach
			@endif
			<div class="caption">
				<h3>{{ $ad->title }}</h3>
				<p>Annonce de {{ $ad->utilisateur->username }}</p>
				<p>{{ $ad->describe }}</p>
				<p>{{ $ad->price }}€</p>
				<p>Créé le {{ $ad->created_at }}</p>
				<p>Modifié le {{ $ad->updated_at }}</p>
				@if ($ad->utilisateur->id != Auth::user()->id)
				<p><a href="{{ action('MessagesController@create', $ad->utilisateur->id) }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-comment"></span> Contacter le vendeur</a>
				@endif
			</div>
		</div>
	</div>
</div>
@endif
@stop