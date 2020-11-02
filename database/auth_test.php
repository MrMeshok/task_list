<?php 

    require 'config.php';

    $login = 'MrMeshok';
    $password = '123456';
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    date_default_timezone_set('Etc/GMT-4');
    $created_at = date('Y/m/d H:i:s', time());

    $check_user = $DB->prepare("SELECT * FROM `users` WHERE `login` = ?");
    $check_user_exec = $check_user->execute(array($login));
    $user = $check_user -> fetch();
    // var_dump($user);

    if (password_verify($password, $user['password'])) {
        echo("1");
    } else{
        echo("0");
    }


    // print_r($user[0]['password']);

    if (empty($user)) {

        $add_user = $DB->prepare("INSERT INTO `users`(`login`, `password`, `created_at`) VALUES (?, ?, ?)");
        $add_user_exec = $add_user->execute(array($login, $password_hash, $created_at));
    }
