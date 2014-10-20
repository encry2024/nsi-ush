<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';


	/**
     * Overrides the method to ignore the remember token.
     */
	public function setAttribute($key, $value)
	{
		$isRememberTokenAttribute = $key == $this->getRememberTokenName();
		if (!$isRememberTokenAttribute)
		{
			parent::setAttribute($key, $value);
		}
	}

	/**
	 * Validates and authenticate login details
	 *
	 * @var string
	 */
	public static function validateLogin($data) {
		$rules = array(
			'username' => 'required',
			'password' => 'required'
		);

		$validation =  Validator::make($data,$rules);

		if($validation->fails()) {
			$failed = $validation->failed();
			return  Redirect::to('login')->with('error_index', $failed)->withErrors($validation)->withInput();
		} else {
			$credentials = array(
			  'username' => Input::get('username'),
			  'password' => Input::get('password')
			);

			if (Auth::attempt($credentials)) {
				if (Session::get('redir_url')) {
					$baseURL = URL::to('/');
					$route = explode($baseURL, Session::get('redir_url'));
					return Redirect::to($route[1]);
				} else {
					return Redirect::to('/');
				}
			} else {
				return Redirect::to('login')
		            ->with('flash_error', 'Your username/password was incorrect.')
		            ->withInput();
			}

		}
	}

}
