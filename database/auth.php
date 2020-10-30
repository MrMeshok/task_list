<?php 
if ($_POST['login'] and $_POST['password']) {
    require 'config.php';
    $login = $_POST['login'];
    $password = $_POST['password'];
    date_default_timezone_set('Etc/GMT-4');
    $created_at = date('Y/m/d H:i:s', time());
    $checkUser = $DB->query("SELECT * FROM `users` WHERE `login` = '$login' and `password` = '$password'");
    $user = $checkUser -> fetch();
    if (empty($user)) {
        $DB->query("INSERT INTO `users`(`login`, `password`, `created_at`) VALUES ('$login', '$password', '$created_at')");
    }
    header("Location: ../tasks.php", false);
} else {
    header("Location: ../index.php");
}

?>