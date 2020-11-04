<?
switch ($view) {
    case 'auth':
        $title = "Авторизация";
        break;
    case 'tasks':
        $title = "Список задач";
        break;
}
include 'header.php';
include $view.'.php';
include 'footer.php';
?>