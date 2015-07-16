@extends('layouts.default')
@section('content')
@foreach($users as $user)
<?php var_dump($user); ?>
@endforeach
@stop