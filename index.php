<?// Главный контроллер

if (!empty($_SESSION['user_id'])) {
    require 'database/config.php';
    $user_id = $_SESSION['user_id'];
    $tasks_query = $DB->query("SELECT * FROM `tasks` WHERE `user_id` = $user_id");
    $tasks = $tasks_query -> fetchAll();
    include_once '/views/tasks.php';
} else {
    include_once '/views/main.php';
}
