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

    public function get_time() {
        date_default_timezone_set('Etc/GMT-4');
        return date('Y/m/d H:i:s', time());
    }

    public function destroy_session() {
        session_destroy();
        header("Location: index.php");
    }
}
// $a = new model;
// $a->auth("MrMeshok", "dad");
// $a->task_config();
