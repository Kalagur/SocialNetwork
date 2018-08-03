<?php
    include ('classes/DB.php');

    if(isset($_POST['createaccount'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if(!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

            if(strlen($username) >= 5 && strlen($username) <= 32) {

                if(preg_match('/[a-zA-Z0-9]+/', $username)) {

                    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

                        if(strlen($password) >= 6 && strlen($password) <= 60) {

                            if(!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {

                                DB::query('INSERT INTO users VALUES (\'\', :username, :password, :email)',
                                    array(
                                        ':username' => $username,
                                        ':password' => password_hash($password, PASSWORD_BCRYPT),
                                        ':email' => $email
                                    ));
                                echo 'Успешно';
                            } else {
                                echo 'Данный email уже занят';
                            }
                        } else {
                            echo 'Пароль должен содержать от 6 до 30 символов';
                        }
                    } else {
                        echo 'Email введен не корректно';
                    }
                    } else {
                    echo 'Имя пользователя должно содержать только буквы латинского алфавита и цифры от 0 до 9';
                }
        } else {
            echo 'Имя пользователя должно содержать от 5 до 60 символов';
            }
        } else {
            echo 'Пользователь с таким именем уже сущесвует';
        }
    }
?>




<h1>Регистрация:</h1>

<form action="create-account.php" method="post">
    <input type="text" name="username" placeholder="Имя пользователя"> <p />
    <input type="password" name="password" placeholder="Пароль"><p />
    <input type="email" name="email" placeholder="E-mail"><p/>
    <input type="submit" name="createaccount" value="Зарегистрироваться">
</form>

