@extends('_master')


@section('head')
@stop

@section('title')
	New Appointment
@stop

@section('content')

<!-- links -->

	{{ HTML::link('/', 'Go back to schedule'); }}
	<h2>New Appointment</h2>

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
	<br>
	<br>	
	
	
	
	{{ Form::submit("Create New Appointment"); }}
	
	{{ Form::close(); }}


@stop
	