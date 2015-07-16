@extends('layouts.default')
@section('content')
<div class="jumbotron index">
	<h2>Bienvenu sur votre site d'annonces gratuites</h2>
	<p>Laravel Free ads vous permet de vendre vos bien entre particuliers.</p>
	<p>Solution simple et efficace pour vos transactions sécurisés.</p>
	<p><a class="btn btn-primary btn-lg" href="{{ url('allads') }}" role="button">Accéder aux annonces</a></p>
</div>
@stop