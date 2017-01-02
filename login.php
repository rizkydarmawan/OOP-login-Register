<?php
require 'core/init.php';

if($user->is_login('username')) {
    Redirect::to('profile.php');
}
    $errors = array();
    if (Input::get('submit')) {
        if (Token::check( Input::get('token') )) {

            // memanggil objek validasi
            $validation = new Validation();
            // metode chek validasi
            $validation = $validation->check(array(
                'username' => array('required' => true),
                'password' => array('required' => true),
            ));
            // jika lolos
            if ($validation->passed()) {
                if ($user->cek_username(Input::get('username'))) {
                    if ( $user->login_user( Input::get('username'), Input::get('password') ) )
                    {
                    	Session::set('username', Input::get('username'));
                    	redirect::to('profile.php');
                    } else {
                    	$errors[] = "Password Salah!";
                    }
                } else {
                    $errors[] = "Username Belum Terdaftar! Silahkan Register!";
                } 

            } else {
                $errors = $validation->errors();
            }
        }
    }
require 'template/header.php';
?>


<h3> Halaman Login </h3>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<input type="text" name="username"><br />
	<input type="password" name="password"><br />
    <input type="hidden" name="token" value="<?= Token::generate() ?>">
	<input type="submit" name="submit" class="submit" value="Login">
	<div>
		<?php
		if (!empty($errors)) {
    	foreach ($errors as $error) {
     ?>

		<li class="error"> <?=$error?> </li>

		<?php
			}
		}
		?>
	</div>
</form>
<?php
require 'template/footer.php';
?>