<?php
    include ('classes/DB.php');

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(DB::query('SELECT username FROM users WHERE username=:username', array(':username' => $username))) {

          if(password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username' => $username))[0]['password'])) {
              echo 'Вы авторизованы';
              $cstrong = True;
              $token = bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
              $user_id = DB::query('SELECT id FROM users WHERE username = :username', array(':username' => $username))[0]['id'];
              DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token' => sha1($token), ':user_id' => $user_id));

              setcookie('SNID', $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, True);

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