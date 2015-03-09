@extends('layouts.admin')

@section('content')

	<h2>Přihlášení</h2>

	{{ Form::open(array('route' => 'sessions.store')) }}
		{{ Form::label('username', 'Uživatelské jméno:') }}
		{{ Form::text('username') }}

		{{ Form::label('password', 'Heslo:') }}
		{{ Form::password('password') }}

		{{ Form::submit('Přihlásit') }}

	{{ Form::close() }}

@stop
