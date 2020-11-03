<?// Главный контроллер
session_start();

if (!empty($_SESSION['user_id'])) {
    // Обращение к БД
    require_once '/models/config.php';
    $user_id = $_SESSION['user_id'];
    $tasks_query = $DB->query("SELECT * FROM `tasks` WHERE `user_id` = $user_id");
    $tasks = $tasks_query -> fetchAll();
    // Вывод вида tasks
    include_once '/views/tasks.php';
} else {
    // Вывод вида main
    include_once '/views/main.php';
}
