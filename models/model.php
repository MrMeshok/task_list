<?
session_start();

class model {
    protected $DB;

    public function __construct() {
        $host = 'localhost';
        $db   = 'tasklist';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->DB = new PDO($dsn, $user, $pass, $opt);
        if(!$this->DB) {
            exit("Ошибка соединения с базой данных".mysql_error());
        }
    }

    public function auth($POST_login, $POST_password) {
        $login = trim($POST_login); 
        $password = trim($POST_password); 
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        date_default_timezone_set('Etc/GMT-4');
        $created_at = date('Y/m/d H:i:s', time());

        $check_user = $this->DB->prepare("SELECT * FROM `users` WHERE `login` = ?"); 
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
            $add_user = $this->DB->prepare("INSERT INTO `users`(`login`, `password`, `created_at`) VALUES (?, ?, ?)");
            $add_user_exec = $add_user->execute(array($login, $password_hash, $created_at));
            $check_user = $this->DB->prepare("SELECT * FROM `users` WHERE `login` = ?"); 
            $check_user->execute(array($login));
            $user = $check_user -> fetch();

        }

        if ($add_user_exec or $check_user_exec) {
            $_SESSION['user_id'] = $user['id'];
        } else {
            unset($_SESSION['user_id']);
        }
    }

    public function tasks_array($user_id) {
        $tasks_query = $this->DB->query("SELECT * FROM `tasks` WHERE `user_id` = $user_id");
        return $tasks_query -> fetchAll();
    }

    public function task_config($user_id) {
        date_default_timezone_set('Etc/GMT-4');
        $created_at = date('Y/m/d H:i:s', time());

        // Обработка нажатий на верхние кнопки
        if ($_POST["button"]) {
            switch ($_POST["button"]) {
                case 'add':
                    if ($_POST["task"]) {
                        $add_task = $this->DB->prepare("INSERT INTO `tasks` (`user_id`, `description`, `created_at`, `done`) VALUES (?, ?, ?, ?)");
                        $add_task->execute(array($user_id, trim($_POST["task"]), $created_at, 0));
                    }
                    break;
                case 'clear':
                    $this->DB->query("DELETE FROM `tasks` WHERE `user_id` = $user_id");
                    break;
                case 'all_done':
                    $this->DB->query("UPDATE `tasks` SET `done` = '1' WHERE `user_id` = $user_id");
                    break;
            }
        }

        // Обработка нажатий кнопок около задач
        if (isset($_POST["delete"])) {
            $task_done = $this->DB->prepare("DELETE FROM `tasks` WHERE `user_id` = ? and `id` = ?");
            $task_done->execute(array($user_id, $_POST["delete"]));
        }
        if (isset($_POST["done"])) {
            $task_done = $this->DB->prepare("UPDATE `tasks` SET `done` = '1' WHERE `user_id` = ? and `id` = ?");
            $task_done->execute(array($user_id, $_POST["done"]));
        }
        if (isset($_POST["not_done"])) {
            $task_not_done = $this->DB->prepare("UPDATE `tasks` SET `done` = '0' WHERE `user_id` = ? and `id` = ?");
            $task_not_done->execute(array($user_id, $_POST["not_done"]));
        }
    }

    public function destroy_session() {
        session_destroy();
        header("Location: index.php");
    }
}
// $a = new model;
// $a->auth("MrMeshok", "dad");
// $a->task_config();
