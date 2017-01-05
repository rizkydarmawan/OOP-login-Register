<?php
require "core/init.php";
if (Input::get('token')){

		if (!$user->is_admin(Session::get('username'))) {
			Redirect::to('404.php');
		} else {
			$user->delete_user(Input::get('id'));
			Redirect::to('admin.php');
		}
} else {
	Redirect::to('404.php');
}
?>