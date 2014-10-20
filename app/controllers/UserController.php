<?php

class UserController extends BaseController {

	public function authenticate() {
		$user = User::validateLogin(Input::all());

		return $user;

	}

}	