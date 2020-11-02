<?php 
if ($_POST['login'] and $_POST['password']) {
    session_start();
    require 'config.php';

    $login = trim($_POST['login']); 
    $password = trim($_POST['password']); 
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    date_default_timezone_set('Etc/GMT-4');
    $created_at = date('Y/m/d H:i:s', time());

    $check_user = $DB->prepare("SELECT * FROM `users` WHERE `login` = ?"); 
    $check_user->execute(array($login));
    $user = $check_user -> fetch();

    if (password_verify($password, $user['password'])) {
        $check_user_exec = True;
    } else{
        $check_user_exec = False;
    }

    if ($check_user->rowCount() > 0 and $check_user_exec == False) {
        $_SESSION['error'] = 'Имя пользователя занято';
    }elseif($check_user->rowCount() == 0) {
        $add_user = $DB->prepare("INSERT INTO `users`(`login`, `password`, `created_at`) VALUES (?, ?, ?)");
        $add_user_exec = $add_user->execute(array($login, $password_hash, $created_at));
    }

    if ($add_user_exec or $check_user_exec) {
        $_SESSION["auth"] = True;
        header("Location: ../tasks.php");
    } else{
        $_SESSION["auth"] = False;
        header("Location: ../index.php");
    }
} else {
    header("Location: ../index.php");
}

?>