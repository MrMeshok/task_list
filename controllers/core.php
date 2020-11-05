<?
abstract class core {
    protected $m;

    // public function __construct() {
    //     $this->m = new model();
    // }

    public function destroy_session() {
        $this->m->destroy_session();
    }

    public function get_body($view, $data=NULL) {
        include "views/index.php";
    }
}
?>
