<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['before' => 'auth', 'uses' => 'AppointmentsController@getIndex'] );


Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    print_r($results);

});


/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
|
| GET SIGN UP -- DISPLAY FORM
| POST SIGN UP -- ADD DATA TO USER TABLE
|
| GET LOGIN -- DISPLAY FORM
| POST LOGIN -- VALIDATE, LOG USER IN 
|
| GET LOGOUT -- LOG USER OUT
|
*/

Route::get('/signup', 'UserController@getSignup'); 
Route::post('/signup', ['before' => 'csrf', 'uses' => 'UserController@postSignup'] );

Route::get('/login', 'UserController@getLogin' );
Route::post('/login', ['before' => 'csrf', 'uses' => 'UserController@postLogin'] );

Route::get('/logout', ['before' => 'auth', 'uses' => 'UserController@getLogout'] );

Route::get('/settings', array(
        'before' => 'auth',
        function() {
			 return View::make('settings');
		}
	)
);

Route::get('/edit-account', 'UserController@getEdit' );
Route::post('/edit-account', ['before' => 'csrf', 'uses' => 'UserController@postEdit'] );

Route::get('/delete-account', 'UserController@getDelete' );
Route::post('/delete-account', ['before' => 'csrf', 'uses' => 'UserController@postDelete'] );


/*
|--------------------------------------------------------------------------
| APPOINTMENT ROUTES
|--------------------------------------------------------------------------
|
| GET NEW APPOINTMENT -- DISPLAY FORM
| POST NEW APPOINTMENT -- ADD DATA TO APPOINTMENTS TABLE
|
| GET EDIT APPOINTMENT -- DISPLAY FORM
| POST EDIT APPOINTMENT -- EDIT DATA IN APPOINTMENTS TABLE
|
| GET DELETE APPOINTMENT -- DISPLAY FORM
| POST DELETE APPOINTMENT -- DELETE APPOINTMENT FROM TABLE
|
*/

Route::get('/new', 'AppointmentsController@getCreate');
Route::post('/new', ['before' => 'csrf', 'uses' => 'AppointmentsController@postCreate']);

Route::get('/edit/{id}', 'AppointmentsController@getEdit');
Route::post('/edit/{id}', ['before' => 'csrf', 'uses' => 'AppointmentsController@postEdit']);

Route::get('/delete/{id}', 'AppointmentsController@getDelete');
Route::post('/delete/{id}', ['before' => 'csrf', 'uses' => 'AppointmentsController@postDelete']);

