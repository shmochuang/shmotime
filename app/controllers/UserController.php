<?php

class UserController extends BaseController {

/*
|--------------------------------------------------------------------------
| User Methods
|--------------------------------------------------------------------------
*/
	
	#make sure user is not signed in already
	public function __construct() {
        $this->beforeFilter('guest', array('only' => array('getLogin','getSignup')));	
    }

/*
|--------------------------------------------------------------------------
| Sign Up Methods
|--------------------------------------------------------------------------
|
| Get -- display form
| Post -- validate and create user
|
*/

	public function getSignup() {

		return View::make('signupform');

	}

	public function postSignup() {

		# define rules for validation			
		$rules = array(
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6',
			'phone' => 'numeric|digits:10'
		);			

		# validate information		
		$validator = Validator::make(Input::all(), $rules);

		# redirect if fail with error message
		if($validator->fails()) {

			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}
		
		
		# get form information, set new user
		$user = new User;
		$user->email    = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->firstname    = Input::get('firstname');
        $user->lastname    = Input::get('lastname');
        $user->phone    = Input::get('phone');

		try {
			$user->save();
		}
		catch (Exception $e) {
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please try again.')
				->withInput();
		}

		# Log user in
		Auth::login($user);

		return Redirect::to('/')->with('flash_message', 'Welcome to Shmotime!');

	}
	
/*
|--------------------------------------------------------------------------
| Login Methods
|--------------------------------------------------------------------------
|
| Get -- display form
| Post -- validate and log user in
|
*/

	public function getLogin() {


		return View::make('loginform');

	}

	public function postLogin() {

		$credentials = Input::only('email', 'password');

		if (Auth::attempt($credentials, $remember = true)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
		}
		else {
			return Redirect::to('/login')
				->with('flash_message', 'Log in failed; please try again.')
				->withInput();
		}

		return Redirect::to('login');

	}

/*
|--------------------------------------------------------------------------
| Logout Method
|--------------------------------------------------------------------------
|
| Get -- log user out and redirect to login page
|
*/

	public function getLogout() {

		# Log out
		Auth::logout();

		# Send to schedule page
		return Redirect::to('/login');

	}




/*
|--------------------------------------------------------------------------
| Edit Methods
|--------------------------------------------------------------------------
|
| Get -- display form
| Post -- validate and update user information
|
*/

    public function getEdit()
    {
        $user = Auth::user();

		return View::make('edituser')
			->with('email', $user->email)
			->with('password', $user->password)
			->with('firstname', $user->firstname)
			->with('lastname', $user->lastname)
			->with('phone', $user->phone);
    }

    public function postEdit($id)
    {
        $user = Auth::user();
		$user->fill(Input::all());
		$user->save();

		return Redirect::to('/settings')->with('flash_message','Your changes have been saved.');
    }
    

    
/*
|--------------------------------------------------------------------------
| Delete User Methods
|--------------------------------------------------------------------------
|
| Get -- display confirmation
| Post -- delete account and redirect to login
|
*/

       public function getDelete()
    {
    	$user = Auth::user();
        // Show delete confirmation page.
        return View::make('deleteuser');
    }

    public function postDelete($id)
    {
        // Handle the delete confirmation.
        $user = Auth::user();
        $user->delete();

        return Redirect::to('/login')->with('flash_message','Your account has been deleted.');
    }
}