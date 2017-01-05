<?php
require 'core/init.php';

if ( !$user->is_login('username') ) {
	Redirect::to('login.php');
}

if(!$user->is_admin(Session::get('username'))){
	Session::flash('profile', "Halaman Ini khusus Admin");
	Redirect::to('profile.php');
}

$users = $user->get_all_data('user');
require 'template/header.php';
?>	

<h1> Anda Admin </h1>
<h2> Data Data User </h2>
<hr>
<ol>
	<?php 
		foreach($users as $_user){
	?>
	<a href = "profile.php?nama=<?= $_user['username'] ?>">
		<li>
			<?= strtoupper($_user['username']) ?> 
			||  
			<a href="delete.php?id=<?= $_user['id'] ?>&token=<?= Token::generate() ?>">Hapus Data</a>
		</li>
	</a>
	<?php } ?>
</ol>
	

<?php
require 'template/footer.php';
?>