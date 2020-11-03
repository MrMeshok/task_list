<?php 
function auth($POST_login, $POST_password) {
    session_start();
    require_once 'config.php';
    $login = trim($POST_login); 
    $password = trim($POST_password); 
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    date_default_timezone_set('Etc/GMT-4');
    $created_at = date('Y/m/d H:i:s', time());

    $check_user = $DB->prepare("SELECT * FROM `users` WHERE `login` = ?"); 
    $check_user->execute(array($login));
    $user = $check_user -> fetch();

    if (password_verify($password, $user['password'])) {
        $check_user_exec = True;
    } else {
        $check_user_exec = False;
    }

    if ($check_user->rowCount() > 0 and $check_user_exec == False) {
        $_SESSION['error'] = 'Имя пользователя занято';
    }elseif($check_user->rowCount() == 0) {
        $add_user = $DB->prepare("INSERT INTO `users`(`login`, `password`, `created_at`) VALUES (?, ?, ?)");
        $add_user_exec = $add_user->execute(array($login, $password_hash, $created_at));
    }

    if ($add_user_exec or $check_user_exec) {
        $_SESSION['user_id'] = $user['id'];
    } else {
        unset($_SESSION['user_id']);
    }
}
?>