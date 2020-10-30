<?php session_start();
$title = "Авторизация";
include_once 'header.php';
?>
<body>
    <form action="database/auth.php" method="POST">
        <input placeholder="Логин" type="text" name="login">
        <input placeholder="Пароль" type="password" name="password">
        <input type="submit" id="submit_enter" value="Отправить">
    </form>
</body>