@extends('_master')


@section('head')
@stop

@section('title')
	Login
@stop

@section('content')

<!-- links -->
<div class = 'signup'><a href='/signup'>Sign up</a>

	<h2>Login</h2>

	<!-- display error messages if any -->
	@foreach($errors->all() as $message) 
    	<div class='error'>{{ $message }}</div>
	@endforeach

	<!-- form -->	
	{{ Form::open(); }}
	{{ Form::label("email", "Email"); }}
	{{ Form::text("email"); }}
	<br>
	{{ Form::label("password", "Password"); }}
	{{ Form::password("password"); }}
	<br><br>	
	
	{{ Form::submit("Login"); }}
	
	{{ Form::close(); }}


@stop
	