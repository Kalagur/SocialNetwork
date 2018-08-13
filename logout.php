<?php

include ('./classes/DB.php');
include ('./classes/login.php');

if(!Login::isLoggedIn()) {
	die('Вы не авторизованы');
}

	if(isset($_POST['confirm'])) {
		if(isset($_POST['alldevices']) == 'alldevices') {
			DB::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid' => Login::isLoggedIn()));
			header('location: index.php');
		} else {
			if(isset($_COOKIE['SNID'])) {
				DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token' => sha1($_COOKIE['SNID'])));
				header('location: index.php');
			}
			setcookie('SNID', 1, time()-3600);
			setcookie('SNID_', 1, time()-3600);

		}
	}

?>

<h1>Вы действителньо хотите выйти?</h1>

<form action="logout.php" method="post">
	<input type="checkbox" name="alldevices" value="alldevices">Выйти со всех устройств?
	<input type="submit" name="confirm" value="Выйти">

</form>
