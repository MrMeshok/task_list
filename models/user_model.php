<?
class user_model extends model {

    public function select_login($login) {
        $check_user = $this->DB->prepare("SELECT * FROM `users` WHERE `login` = ?"); 
        $check_user->execute(array($login));
        return $check_user -> fetchAll();
    }

    public function add_user($login, $password_hash, $created_at) {
        $add_user = $this->DB->prepare("INSERT INTO `users`(`login`, `password`, `created_at`) VALUES (?, ?, ?)");
        $add_user_exec = $add_user->execute(array($login, $password_hash, $created_at));
    }

    public function auth($login, $password, $password_hash, $created_at) {
        $user = $this->select_login($login);

        if (password_verify($password, $user[0]['password'])) {
            $check_user_exec = True;
        } else {
            $check_user_exec = False;
        }

        if (count($user) > 1 and $check_user_exec == False) {
            $_SESSION['error'] = 'Имя пользователя занято';
        } elseif (count($user) == 0) {
            $this->add_user($login, $password_hash, $created_at);
            $user = $this->select_login($login);
        }

        if ($add_user_exec or $check_user_exec) {
            return $user[0]['id'];
        } else {
            return NULL;
        }
    }
}
?>
