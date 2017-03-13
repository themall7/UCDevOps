<?php namespace App\Http\Controllers;

use Input, Validator, Redirect, Auth, App\Models\User;

class UserController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show login page.
	 *
	 * @return Response
	 */
	public function getLogin()
	{
		return view('login');
	}

	/**
	 * Process login.
	 *
	 * @return Response
	 */
	public function postLogin()
	{
		// validate the info, create rules for the inputs
		$rules = array(
		    'email'    => 'required|email', // make sure the email is an actual email
		    'password' => 'required|alphaNum|min:6' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    return Redirect::to('login')
		        ->withErrors($validator) // send back all errors to the login form
		        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

		    // create our user data for the authentication
		    $userdata = array(
		        'email'     => Input::get('email'),
		        'password'  => Input::get('password')
		    );

		    // attempt to do the login
		    if (Auth::attempt($userdata)) {

		        // validation successful!
		        // redirect them to the secure section or whatever
		        // return Redirect::to('secure');
		        // for now we'll just echo success (even though echoing in a controller is bad)
		        //echo 'SUCCESS!';
		        return Redirect::to('dashboard');

		    } else {        

		        // validation not successful, send back to form 
			    return Redirect::to('login')
			        ->withErrors($validator)
			        ->withInput(Input::except('password'))
			        ->With('message', 'Incorrect email and/or password.');

		    }

		}
	}

	/**
	 * Process logout.
	 *
	 * @return Response
	 */
	public function getLogout() {
		Auth::logout();
		return Redirect::to('/');
	}

	/**
	 * Show User List.
	 *
	 * @return Response
	 */
	public function getUsers()
	{
		$users = User::paginate(10);
		return view('user/users', ['users' => $users]);
	}

	/**
	 * Show single User.
	 *
	 * @return Response
	 */
	public function getUser($id=0)
	{
		$user = User::firstOrNew(['id'=>$id]);
		return view('user/user', ['user' => $user]);
	}

	/**
	 * Save single User.
	 *
	 * @return Response
	 */
	public function postUser($id=0)
	{
		// validate the info, create rules for the inputs
		$rules = array(
		    'name'    => 'required', // make sure the email is an actual email
		    'email'    => 'required|email', // make sure the email is an actual email
		    'password' => 'required|alphaNum|min:6' // password can only be alphanumeric and has to be greater than 3 characters
		);

		if (empty(Input::get('password'))) {
			unset($rules['password']);
		}

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    return Redirect::to('user')
		        ->withErrors($validator) // send back all errors to the login form
		        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {
			if ($id==0) {
				$user = User::create(Input::all());
			} else {
				$user = User::find($id);
				$user->name = Input::get('name');
				$user->email = Input::get('email');
				if (!empty(Input::get('password'))) $user->password = \Hash::make(Input::get('password'));
				$user->save();
			}
			return view('user/user', ['user' => $user])
				->With('message', 'Saved.');
		}
	}

	/**
	 * Delete single User.
	 *
	 * @return Response
	 */
	public function deleteUser($id)
	{
		User::find($id)->delete();
		$users = User::paginate(10);
		return view('user/users', ['users' => $users]);
	}

}
