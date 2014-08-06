@extends('_master')


@section('head')
@stop

@section('title')
	Sign Up
@stop

@section('content')

<!-- links -->
<a href='/login'>Log in</a></div>

	<h2>Sign Up</h2>

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
	<br>
	{{ Form::label("firstname", "First"); }}
	{{ Form::text("firstname"); }}
	<br>
	{{ Form::label("lastname", "Last"); }}
	{{ Form::text("lastname"); }}
	<br>
	{{ Form::label("phone", "Phone"); }}
	{{ Form::text("phone"); }}
	<br>
	<br>	
	
	
	
	{{ Form::submit("Sign Up"); }}
	
	{{ Form::close(); }}


@stop
	