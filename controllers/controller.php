<?
if ($_POST['login'] and $_POST['password']) {
    include_once '../models/auth.php';
    auth($_POST['login'], $_POST['password']);
}

if ($_POST["button"] or $_POST["delete"] or $_POST["done"] or $_POST["not_done"]) {
    include_once '../models/task_config.php';
    task_config();
}

header("Location: ../index.php");
?>