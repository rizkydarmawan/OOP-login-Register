<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login dan Register</title>
	<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
	<h1> Login Dan Register</h1>
	<nav>
		<?php 
			if ($user->is_login('username')) {
				
				if ( Input::get('nama') ) {
					$data_user = $user->get_data(Input::get('nama'));
				} else {
					$data_user = $user->get_data(Session::get('username'));
				}
				
				if ($data_user['username'] == Session::get('username') ){
					if ( $user->is_admin( Session::get('username') ) ) {
						echo "<a href='admin.php'>Hak Admin </a> || ";
					}
						echo "<a href='profile.php'>Profile</a> || ";
						echo "<a href='change-password.php'>Ganti Password</a> ||";
						echo "<a href='logout.php'>Logout</a>";
				} else {
					echo "<a href='profile.php'>Profile</a> || ";
					echo "<a href='logout.php'>Logout</a>";
				}
			} else {
				echo "<a href='login.php'> Login </a> ||";
				echo "<a href='register.php'> Register </a>";
			}
		?>
	</nav>
</header>
<section>