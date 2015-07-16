@extends('layouts.default')
@section('content')
<h2>Liste des annonces</h2>
<div class="form-wrapper">
	{!! Form::open(array('url' => 'search')) !!}
		<div class="form-group">
			{!! Form::label('searchtool', 'Recherche : ') !!}
			{!! Form::text('searchtool', null, ['class' => 'form-control', 'placeholder' => 'Votre recherche']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('pricefirst', 'Prix entre : ') !!}
			{!! Form::number('pricefirst', null, ['class' => 'form-control', 'placeholder' => 'Entrez un chiffre']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('priceend', 'Et : ') !!}
			{!! Form::number('priceend', null, ['class' => 'form-control', 'placeholder' => 'Entrez un chiffre']) !!}
		</div>
		{!! Form::submit("Chercher", ['class' => 'btn btn-primary form-control']) !!}
	{!! Form::close() !!}
	</div>
@if (isset($ads) && !empty($ads))
<div class="row">
@foreach ($ads as $ad)
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail">
			<div class="img">
			@if ($ad->image)
			@foreach ($ad->image as $image)
			<div class="img">
				<img class="pix" src="{{ URL::asset('files/storage/'.$image->key_pix)}}" alt="{{ $image->name }}">
			</div>
			@endforeach
			@endif
			</div>
			<div class="caption">
			<h3>{{ $ad->title }}</h3>
				<p><span class="glyphicon glyphicon-user"></span> {{ $ad->utilisateur->username }}</p>
				<p>{{ substr($ad->describe, 0, 25) }}</p>
				<p>{{ $ad->price }}€</p>
				<p>Créé le {{ $ad->created_at }}</p>
				<p>Modifié le {{ $ad->updated_at }}</p>
				@if ($ad->utilisateur->id != Auth::user()->id)
				<p><a href="{{ action('MessagesController@create', $ad->utilisateur->id) }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-comment"></span> Contacter le vendeur</a></p>
				@endif
				<p><a href="{{ action('AnnoncesController@show', $ad->id) }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-zoom-in"></span> Voir cette annonce</a></p>
			</div>
		</div>
	</div>
@endforeach
</div>
<?php echo $ads->render(); ?>
@endif
@if (isset($seek) && !empty($seek))
<div class="row">
@foreach ($seek as $result)
	<div class="col-sm-6 col-md-4">
		<div class="thumbnail">
			@if ($result->image)
			@foreach ($result->image as $pix)
			<div class="img">
					<img class="pix" src="{{ URL::asset('files/storage/'.$pix->key_pix)}}" alt="{{ $pix->name }}">
			</div>
			@endforeach
			@endif
			<div class="caption">
			<h3>{{ $result->title }}</h3>
				<p><span class="glyphicon glyphicon-user"></span> {{ $result->utilisateur->username }}</p>
				<p>{{ substr($result->describe, 0, 25) }}</p>
				<p>{{ $result->price }}€</p>
				<p>Créé le {{ $result->created_at }}</p>
				<p>Modifié le {{ $result->updated_at }}</p>
				@if ($resut->utilisateur->id != Auth::user()->id)
				<p><a href="{{ action('MessagesController@create', $result->utilisateur->id) }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-comment"></span> Contacter le vendeur</a></p>
				@endif
				<p><a href="{{ action('AnnoncesController@show', $result->id) }}" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-zoom-in"></span> Voir cette annonce</a></p>
			</div>
		</div>
	</div>
@endforeach 
</div>
@endif
@stop