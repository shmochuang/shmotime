@extends('_master')


@section('head')
@stop

@section('title')
	Edit Appointment
@stop

@section('content')


	{{ HTML::link('/', 'Go back to schedule'); }}
	<h2>Edit Appointment</h2>

	<!-- display error messages if any -->
	@foreach($errors->all() as $message) 
    	<div class='error'>{{ $message }}</div>
	@endforeach

	<!-- form -->	
	{{ Form::open(); }}
	{{ Form::label("day_unique", "Day"); }}
	{{ Form::date("day_unique"); }}
	<br>
	{{ Form::label("start_time", "Start"); }}
	{{ Form::time("start_time"); }}
	<br>
	{{ Form::label("end_time", "End"); }}
	{{ Form::time("end_time"); }}
	<br>
	{{ Form::textarea("instructions", null, array('placeholder'=>'Instructions' )); }}
	<br>
	<br>
	
	
	{{ Form::submit("Update Appointment"); }}
	{{ Form::close(); }}

@stop