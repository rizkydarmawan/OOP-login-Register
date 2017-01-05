<?php
require 'core/init.php';

if ($user->is_login('username')) {
    Redirect::to('profile.php');
}

$errors = array();
if (Input::get('submit')) {
    if ( Token::check( Input::get('token') ) ) {

        // memanggil objek validasi
        $validation = new Validation();
        // metode chek validasi
        $validation = $validation->check(array(
            'username' => array(
                'required' => true,
                'min'      => 3,
                'max'      => 50,
            ),
            'password' => array(
                'required' => true,
                'min'      => 3,
            ),
            'password_verify' => array(
                'required' => true,
                'match'    => 'password',
            ),
        ));

        // cek username sudah ada atau belum
        if ($user->cek_username(Input::get('username'))) {
            $errors[] = "Username Sudah Terdaftar";
        } else {
        // jika lolos
            if ($validation->passed()) {
                $user->register_user(array(
                    'username' => Input::get('username'),
                    'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
                ));
                Session::flash('profile','Selamat Anda Telah Mendaftar');
                Session::set('username', Input::get('username'));
                Redirect::to('profile.php');

            } else {
                $errors = $validation->errors();
            }
        }
    } 
      else  $errors[] = "Jangan Coba2 ";
}
require 'template/header.php';
?>


<h3> Halaman Registrasi </h3>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<input type="text" name="username" placeholder="Username"><br />
	<input type="password" name="password" placeholder="Password"><br />
    <input type="password" name="password_verify" placeholder="Ulangi Password"><br />
    <input type="hidden" name="token" value="<?= Token::generate() ?>">
	<input type="submit" name="submit" class="submit" value="Daftar">
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