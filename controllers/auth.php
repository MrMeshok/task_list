<?
class auth extends core {
    public function get_body($view) {
        if (empty($_SESSION['user_id'])) {
            include "views/index.php";
        } else {
            header("Location: index.php?page=tasks");
        }
    }
}
?>