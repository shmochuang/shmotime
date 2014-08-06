<?php

	date_default_timezone_set('America/New_York');

// app/controllers/AppointmentsController.php

class AppointmentsController extends BaseController
{
	
    public function getIndex()
    {
        // Show a listing of appointments.
		$appointments = Appointment::all();
		$appointments->sort(function($a, $b) {
	        $a = $a->day;
		    $b = $b->day;
	        if ($a === $b) {
	            return 0;
	        }
	        return ($a > $b) ? 1 : -1;
		});
		return View::make('schedule', compact('appointments'));
	}

    
/*
|--------------------------------------------------------------------------
| Create Appointment Methods
|--------------------------------------------------------------------------
|
| Get -- display form
| Post -- validate and create appointment
|
*/

    public function getCreate()
    {
        // Show the create apt form.
        return View::make('newaptform');
    }

    public function postCreate()
    {
        
        $user = Auth::user();
        $day_unique = Input::get('day_unique');
        
        
        $validator = Validator::make(
        	array( 'day_unique' => $day_unique ),
	        array( 'day_unique' => 'required|unique:appointments,day_unique')
        );

		if ($validator->fails()) {
			return Redirect::to('/')
				->with('flash_message', 'Sorry! I can only handle one job per day.');
		}
		else if ( $day_unique <= date("Y-m-d") ){
			return Redirect::to('/')
				->with('flash_message', 'Sorry, it is too late to make an appointment for that day!');
		}
		else {
			// create new appointment
			$appointment = new Appointment;
	        $appointment->day_unique = Input::get('day_unique');
	        $appointment->start_time = Input::get('start_time');
	        $appointment->end_time = Input::get('end_time');
	        $appointment->instructions = Input::get('instructions');
	        $appointment->user_id = $user->id;
	        $appointment->save();
			return Redirect::to('/')->with('flash_message', 'Appointment added!');
		}
        
    }

/*
|--------------------------------------------------------------------------
| Edit Appointment Methods
|--------------------------------------------------------------------------
|
| Get -- display form with input
| Post -- validate and update appointment
|
*/

    public function getEdit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $day_unique = $appointment->day_unique;
        $start_time = $appointment->start_time;
        $end_time = $appointment->end_time;
        $instructions = $appointment->instructions;

		return View::make('editform')
			->with('day', $day_unique)
			->with('start_time', $start_time)
			->with('end_time', $end_time)
			->with('instructions', $instructions);
    }

    public function postEdit($id)
    {
        $appointment = Appointment::findOrFail($id);
		$appointment->fill(Input::all());
		$appointment->save();

		return Redirect::to('/')->with('flash_message','Your changes have been saved.');
    }
    
/*
|--------------------------------------------------------------------------
| Delete Appointment Methods
|--------------------------------------------------------------------------
|
| Get -- display confirmation
| Post -- delete appointment
|
*/

       public function getDelete($id)
    {
    	$appointment = Appointment::findOrFail($id);
        // Show delete confirmation page.
        return View::make('deleteform');
    }

    public function postDelete($id)
    {
        // Handle the delete confirmation.
        $appointment = Appointment::findOrFail($id);
        $appointment->user_id = null;
        $appointment->delete();

        return Redirect::to('/')->with('flash_message','Your appointment has been cancelled.');
    }
}