<?
session_start();
header("Content-Type:text/html;charset=UTF-8");


spl_autoload_register(function ($c) {
    if (file_exists("controllers/".$c.".php")) {
        require_once "controllers/".$c.".php";
    } elseif (file_exists("models/".$c.".php")) {
        require_once "models/".$c.".php";
    }
});


if ($_GET['page']) {
    $class = trim(strip_tags($_GET['page']));
} else {
    $class = 'auth'; 
}

if ($_GET['option']) {
    $option = $_GET['option'];
}

if (class_exists($class)) {
    $obj = new $class;
    if ($option == 'exit') {
        $obj->destroy_session();
    }
    $obj->initial($class);
} else {
    exit("<p>Нет данных для входа</p>");
}