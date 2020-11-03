<?php 
if (!empty($_SESSION['user_id'])) {
    session_start();
    require 'config.php';
    date_default_timezone_set('Etc/GMT-4');
    $created_at = date('Y/m/d H:i:s', time());
    $user_id = $_SESSION['user_id'];

    // Обработка нажатий на верхние кнопки
    if ($_POST["button"]) {
        switch ($_POST["button"]) {
            case 'add':
                if ($_POST["task"]) {
                    $add_task = $DB->prepare("INSERT INTO `tasks` (`user_id`, `description`, `created_at`, `done`) VALUES (?, ?, ?, ?)");
                    $add_task->execute(array($user_id, trim($_POST["task"]), $created_at, 0));
                }
                break;
            case 'clear':
                $DB->query("DELETE FROM `tasks` WHERE `user_id` = $user_id");
                break;
            case 'all_done':
                $DB->query("UPDATE `tasks` SET `done` = '1' WHERE `user_id` = $user_id");
                break;
        }
    }

    // Обработка нажатий кнопок около задач
    if (isset($_POST["delete"])) {
        $task_done = $DB->prepare("DELETE FROM `tasks` WHERE `user_id` = ? and `id` = ?");
        $task_done->execute(array($user_id, $_POST["delete"]));
    }
    if (isset($_POST["done"])) {
        $task_done = $DB->prepare("UPDATE `tasks` SET `done` = '1' WHERE `user_id` = ? and `id` = ?");
        $task_done->execute(array($user_id, $_POST["done"]));
    }
    if (isset($_POST["not_done"])) {
        $task_not_done = $DB->prepare("UPDATE `tasks` SET `done` = '0' WHERE `user_id` = ? and `id` = ?");
        $task_not_done->execute(array($user_id, $_POST["not_done"]));
    }
} else {
    header("Location: ../index.php");
}


