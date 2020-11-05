<?
class tasks_model extends model {
    public function tasks_array($user_id) {
        $tasks_query = $this->DB->query("SELECT * FROM `tasks` WHERE `user_id` = $user_id");
        return $tasks_query -> fetchAll();
    }

    public function add_task($user_id, $task, $created_at) {
        $add_task = $this->DB->prepare("INSERT INTO `tasks` (`user_id`, `description`, `created_at`, `status`) VALUES (?, ?, ?, ?)");
        $add_task->execute(array($user_id, trim($task), $created_at, 'not_done'));
    }

    public function delete_all_tasks($user_id) {
        $this->DB->query("DELETE FROM `tasks` WHERE `user_id` = $user_id");
    }

    public function all_task_done($user_id) {
        $this->DB->query("UPDATE `tasks` SET `status` = 'done' WHERE `user_id` = $user_id");
    }

    public function delete_task($user_id, $delete) {
        $task_done = $this->DB->prepare("DELETE FROM `tasks` WHERE `user_id` = ? and `id` = ?");
        $task_done->execute(array($user_id, $delete));
    }

    public function change_task_done($status, $user_id, $task_id) {
        $task_done = $this->DB->prepare("UPDATE `tasks` SET `status` = ? WHERE `user_id` = ? and `id` = ?");
        $task_done->execute(array($status, $user_id, $task_id));
    }
}
?>
