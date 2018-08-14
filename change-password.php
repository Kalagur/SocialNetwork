<?php

include ('./classes/DB.php');
include ('./classes/login.php');



if (Login::isLoggedIn()) {
	if(isset($_POST['changepassword'])) {
	    $oldpassword = $_POST['oldpassword'];
		$newpassword = $_POST['newpassword'];
		$newpasswordrepeat = $_POST['newpasswordrepeat'];
	    $userid = Login::isLoggedIn();

	    if(password_verify($oldpassword, DB::query('SELECT password FROM users WHERE id=:userid', array(':userid' => $userid))[0]['password'])) {

	        if($newpassword == $newpasswordrepeat) {

				if(strlen($newpassword) >= 6 && strlen($newpassword) <= 60) {
                    DB::query('UPDATE users SET password=:newpassword WHERE id=:userid', array(':newpassword'=>password_hash($newpassword, PASSWORD_BCRYPT), ':userid'=>$userid));
                    echo "Пароль был успешно изменен. \n";
				}

            } else {
	           echo "Пароли не совпадают. \n";
            }

	    } else {
	        echo "Старый пароль введен неверно. \n";
        }
	}


} else {
	die("Вы не авторизованы");
}

?>

<h1>Смена пароля</h1>

<form action="change-password.php" method="post">
	<input type="password" name="oldpassword" value="" placeholder="Старый пароль"><br /><br />
	<input type="password" name="newpassword" value="" placeholder="Новый пароль"><br/><br />
	<input type="password" name="newpasswordrepeat" value="" placeholder="Повторите пароль"><br/><br />
	<input type="submit" name="changepassword" value="Изменить пароль">
</form>
