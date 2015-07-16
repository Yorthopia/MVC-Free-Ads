@extends('layouts.default')
@section('content')
<div class="form-wrapper">
	{!! Form::open(array('url' => 'store/msg')) !!}
		<div class="form-group">
			{!! Form::label('selec', 'Choisissez un destinataire : ') !!}
			{!! Form::select('selec', $select) !!}
		</div>
		<div class="form-group">
			{!! Form::textarea('content', null, ['required', 'class' => 'form-control', 'placeholder' => 'Votre message']) !!}
		</div>
		{!! Form::submit("Envoyer", ['class' => 'btn btn-primary form-control']) !!}
	{!! Form::close() !!}
</div>
@stop