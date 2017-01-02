<?php
require 'core/init.php';
if ( !$user->is_login('username') ) {
		echo "<h3> Silahkan <a href='login.php'>Login</a> Terlebih dahulu!!</h3> ";
	} else {
		if (Session::exists('profile')) {
			echo "<div class='error'>". Session::flash('profile') ."</div>";
		}
	$data_user = $user->get_data(Session::get('username'));
	
require 'template/header.php';
?>	

<h1>Hai <?= $data_user['username']  ?></h1>
<h2> Anda Telah Login</h2>

<?php
	}
require 'template/footer.php';
?>