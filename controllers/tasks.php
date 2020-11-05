<?
class tasks extends core {
    public function __construct() {
        $this->m = new tasks_model();
    }

    public function task_config($user_id, $task, $button, $delete, $status, $task_id, $created_at) {
        // Обработка нажатий на верхние кнопки
        if ($button) {
            switch ($button) {
                case 'add':
                    if ($task) {
                        $this->m->add_task($user_id, $task, $created_at);
                    }
                    break;
                case 'clear':
                    $this->m->delete_all_tasks($user_id);
                    break;
                case 'all_done':
                    $this->m->all_task_done($user_id);
                    break;
            }
        }

        // Обработка нажатий кнопок около задач
        if ($delete) {
            $this->m->delete_task($user_id, $delete);
        }
        if ($status) {
            $this->m->change_task_done($status, $user_id, $task_id);
        }
    }

    public function initial($view) {
        if (!empty($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            if ($_POST["task"] or $_POST["button"] or $_POST["delete"] or $_POST["done"] or $_POST["not_done"]) {
                $task = $_POST["task"];
                $button = $_POST["button"];
                $delete = $_POST["delete"];
                if ($_POST["done"]) {
                    $status = 'done';
                    $task_id = $_POST["done"];
                } elseif ($_POST["not_done"]) {
                    $status = 'not_done';
                    $task_id = $_POST["not_done"];
                }
                $created_at = $this->m->get_time();

                $this->task_config($user_id, $task, $button, $delete, $status, $task_id, $created_at);
                header("Location: index.php?page=tasks");
            }
            $tasks = $this->m->tasks_array($user_id);
            $this->get_body($view, $tasks);
        } else {
            header("Location: index.php");
        }
    }
}
?>