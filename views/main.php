<?php session_start();
if (empty($_SESSION['user_id'])) {
    // header("Location: index.php");
}
$title = "Авторизация";
include_once 'header.php';
?>  
<body>
    <form action="controllers/controller.php" method="POST">
        <input placeholder="Логин" type="text" name="login">
        <input placeholder="Пароль" type="password" name="password">
        <input type="submit" id="submit_enter" value="Отправить">
    </form>

    <? // Обработка ошибок
    if (!empty($_SESSION["error"])) {
    echo "<script>alert('".$_SESSION["error"]."')</script>";
    unset($_SESSION["error"]);
    };?>
</body>