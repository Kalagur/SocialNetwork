<?php

include ('./classes/DB.php');
include ('./classes/login.php');



if (Login::isLoggedIn()) {

    echo 'Привет, user № ';
    echo Login::isLoggedIn();
} else {
    echo "Вы не авторизованы";
}

