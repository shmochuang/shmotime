@extends('_master')

@section('title')
	Schedule
@stop

@section('content')
	
	<div class="newlink"><a href="/new" alt="new apt form">Create New Appointment</a></div><br><br>
	
	
	<table>
	<caption>Appointments</caption>
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Instructions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
				@foreach($appointments as $appointment)
					@if (($appointment->day_unique >= date("Y-m-d")))
						<tr>
						    <td class="nowrap">{{ date("D M j, Y", strtotime($appointment->day_unique)) }}</td>
						    <td class="nowrap">{{ date("g:i A", strtotime($appointment->start_time)) }}</td>
						    <td class="nowrap">{{ date("g:i A", strtotime($appointment->end_time)) }}</td>
						    <td class="wrap">{{ $appointment->instructions }}</td>
						    <td class="wrap">
						    	<a href="{{ action('AppointmentsController@getEdit', $appointment->id) }}" alt="edit appointment form.">Edit</a>
						    	<a href="{{ action('AppointmentsController@getDelete', $appointment->id) }}" alt="cancel confirmation form.">Cancel</a>
						    </td>
						</tr>
					@endif
						
				@endforeach
            </tbody>
	</table>
	<br>
	



@stop
	