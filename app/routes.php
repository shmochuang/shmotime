<?php
/*
|--------------------------------------------------------------------------
| Debugging Routes
|--------------------------------------------------------------------------
|
| debugging with environments, errors, database
|
*/


Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});


Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});


Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    print_r($results);

});

# /app/routes.php
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});


/*
|--------------------------------------------------------------------------
| Footer Routes
|--------------------------------------------------------------------------
|
| GET ABOUT -- DISPLAY ABOUT PAGE
| GET CONTACT -- DISPLAY CONTACT PAGE
|
*/

Route::get('/about', function()
{
	return View::make('about');
});
Route::get('/contact', function()
{
	return View::make('contact');
});


/*
|--------------------------------------------------------------------------
| Display Routes
|--------------------------------------------------------------------------
|
| GET INDEX -- DISPLAY FULL SCHEDULE
| GET LIST -- DISPLAY USER'S APPOINTMENTS
|
*/

Route::get('/', ['before' => 'auth', 'uses' => 'AppointmentsController@getIndex'] );
Route::get('/list', ['before' => 'auth', 'uses' => 'AppointmentsController@getList'] );



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

