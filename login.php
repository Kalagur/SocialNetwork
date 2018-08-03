<?php
    include ('classes/DB.php');

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(DB::query('SELECT username FROM users WHERE username=:username', array(':username' => $username))) {

          if(password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username' => $username))[0]['password'])) {
              echo 'Вы авторизованы';
          } else {
             echo 'Неправильный логин или пароль';
          }
        } else {
            echo 'Пользователь с таким логином не зарегистрирован';
        }
    }
?>

<h1>Авторизация</h1>
<form action="login.php" method="post">
    <input type="text" name="username" value="" placeholder="Логин"><p />
    <input type="password" name="password" value="" placeholder="Пароль"><p />
    <input type="submit" name="login" value="Войти">
</form>