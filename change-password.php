<?php
require 'core/init.php';

if ( !$user->is_login('username') ) {
	Redirect::to('login.php');
}
	
$data_user = $user->get_data( Session::get('username'));	
$errors = array();

if (Input::get('submit')) {
    if ( Token::check(Input::get('token'))) {

        // memanggil objek validasi
        $validation = new Validation();
        // metode chek validasi
        $validation = $validation->check(array(
            'password_lama' => array(
								'required' => true,
            ),
			'password_baru' => array(
								'required' => true,
								'min'	   => 3,
            ),
            'password_verify' => array(
								'required' => true,
								'match'    => 'password_baru',
            )
        ));        // cek username sudah ada atau belum
        // jika lolos
            if ($validation->passed()) {
				if (password_verify(Input::get('password_lama'), $data_user['password']) ) 
					{
						$user->update_user(array(
							'password' => password_hash(Input::get('password_baru'), PASSWORD_DEFAULT),
						), $data_user['id']);
						Session::flash('profile','Anda Telah Mengganti PASSWORD');
						Redirect::to('profile.php');
					} else {
						$errors[] = "Password Lama Salah";
					}
				
            } else {
                $errors = $validation->errors();
            }
    } else $errors[] = "Jangan Coba2 ";
}
require 'template/header.php';

?>	

<h3> Ganti Password <?= $data_user['username'] ?> </h3>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<input type="password" name="password_lama" placeholder="Password Lama"><br />
	<input type="password" name="password_baru" placeholder="Password Baru"><br />
    <input type="password" name="password_verify" placeholder="Ulangi Password"><br />
    <input type="hidden" name="token" value="<?= Token::generate() ?>">
	<input type="submit" name="submit" class="submit" value="Ganti PASSWORD">
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