@extends('_master')


@section('head')
@stop

@section('title')
	Cancel Appointment
@stop

@section('content')


        <h2>Cancel Appointment</h2>
        <p>Are you sure you want to cancel this appointment?</p>
	
	{{ Form::open(); }}
	{{ Form::submit("Cancel Appointment"); }}
	{{ Form::close(); }}
	{{ HTML::link('/', 'No. Go back.'); }}

@stop
	