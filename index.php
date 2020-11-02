<?php session_start();
if ($_SESSION["auth"] == True) {
    header("Location: ../tasks.php");
}
$title = "Авторизация";
include_once 'header.php';
?>
<body>
    <form action="database/auth.php" method="POST">
        <input placeholder="Логин" type="text" name="login">
        <input placeholder="Пароль" type="password" name="password">
        <input type="submit" id="submit_enter" value="Отправить">
    </form>
    <?if (!empty($_SESSION["error"])) {
    echo "<script>alert('".$_SESSION["error"]."')</script>";
    unset($_SESSION["error"]);
    };?>
    
</body>