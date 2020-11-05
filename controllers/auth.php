<?
class auth extends core {
    public function __construct() {
        $this->m = new user_model();
    }

    public function login($login, $password) {
        $login = trim($login); 
        $password = trim($password); 
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $created_at = $this->m->get_time();
        return $this->m->auth($login, $password, $password_hash, $created_at);
    }

    public function initial($view) {
        if ($_POST['login'] and $_POST['password']) {
            $_SESSION['user_id'] = $this->login($_POST['login'], $_POST['password']);
            header("Location: index.php");
        }

        if (empty($_SESSION['user_id'])) {
            $this->get_body($view);

        } else {
            header("Location: index.php?page=tasks");
        }
    }
}
?>