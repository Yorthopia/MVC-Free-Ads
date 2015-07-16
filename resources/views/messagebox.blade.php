@extends('layouts.default')
@section('content')
<h2>Vos Messages</h2>
<a href="{{ url('conv') }}">Ecrire un nouveau message</a>
@if ($received)
<div class="message-list">
<h3>Auteurs</h3>
	<ul>
@foreach ($received as $friends)
		<li><a href="{{ url('message/'.$friends->auteur->id) }}" class="btn btn-primary" role="button">{{ $friends->auteur->username }}</a></li>
@endforeach
<?php echo $received->render(); ?>
</ul>
</div>
@endif
@if (isset($result))
<div class="conv">
	<div class="msg">
	@foreach ($result as $msg)
		@if ($msg->auteur->id == Auth::user()->id)
		<div class="msg-right">
			<p>{{ $msg->subject }}</p>
			<p>{{ $msg->content }}</p>
			<p>{{ $msg->created_at }}</p>
		</div>	
		@else
		<div class="msg-left">
			<p>{{ $msg->subject }}</p>
			<p>{{ $msg->content }}</p>
			<p>{{ $msg->created_at }}</p>
		</div>
		@endif
	@endforeach
	</div>
	<div class="form-wrapper">
	{!! Form::open(array('url' => 'message/new/'.$param)) !!}
			<div class="form-group">
				{!! Form::textarea('content', null, ['required', 'class' => 'form-control', 'placeholder' => 'Votre message']) !!}
			</div>
			{!! Form::submit("Envoyer", ['class' => 'btn btn-primary form-control']) !!}
	{!! Form::close() !!}
	</div>
</div>
@endif
@stop