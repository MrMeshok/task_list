<?
class tasks extends core {
    public function get_body($view) {
        if ($_POST['login'] and $_POST['password']) {
            $this->m->auth($_POST['login'], $_POST['password']);
        }
        if (!empty($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            if ($_POST["task"] or $_POST["button"] or $_POST["delete"] or $_POST["done"] or $_POST["not_done"]) {
                $this->m->task_config($user_id);
                header("Location: index.php?page=tasks");
            }

            $tasks = $this->m->tasks_array($user_id);
            include "views/index.php";
        } else {
            header("Location: index.php");
        }
    }
}
?>