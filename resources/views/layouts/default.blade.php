<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Free Ads</title>
	<link rel="stylesheet" href="{{ URL::asset('lib/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('style/css/style.css') }}">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					@if(Auth::user())
						<a class="navbar-brand" href="{{ url('home') }}">Laravel Free Ads</a>
					@else
						<a class="navbar-brand" href="{{ url('/') }}">Laravel Free Ads</a>
					@endif
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					@if (Auth::user())
						<ul class="nav navbar-nav">
							<li><a href="{{ url('account') }}"><span class="glyphicon glyphicon-wrench"></span> Bienvenu {{ Auth::user()->username }}</a></li>
							<li><a href="{{ url('logout') }}">Se déconnecter <span class="glyphicon glyphicon-off"></span></a></li>
							<li><a href="{{ url('ads') }}"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter une annonce</a></li>
							<li><a href="{{ url('message') }}"><span class="glyphicon glyphicon-inbox"></span> Mes messages</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="{{ url('allads') }}">Voir les annonces</a></li>
						</ul>
					@endif
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<div class="content">
			@if (Session::has('flash_message'))
				<div class="alert alert-success">
					<p><span class="glyphicon glyphicon-ok"></span> {{ Session::get('flash_message') }}</p>
				</div>
			@endif	
			@if (Session::has('flash_danger'))
				<div class="alert alert-danger">
					<p><span class="glyphicon glyphicon-warning-sign"></span> {{ Session::get('flash_danger') }}</p>
				</div>
			@endif
			@yield('content')
		</div>
	</div>
	<script type="text/javascript" src="{{ URL::asset('lib/jquery/jquery-2.1.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>