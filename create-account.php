<?php
    include ('classes/DB.php');

    if(isset($_POST['createaccount'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        DB::query('INSERT INTO users VALUES (\'\', :username, :password, :email)',
            array(':username' => $username, ':password' => $password, ':email' => $email));
        echo 'Успешно';

    }
?>




<h1>Регистрация:</h1>

<form action="create-account.php" method="post">
    <input type="text" name="username" placeholder="Имя пользователя"> <p />
    <input type="password" name="password" placeholder="Пароль"><p />
    <input type="email" name="email" placeholder="E-mail"><p/>
    <input type="submit" name="createaccount" value="Зарегистрироваться">
</form>

