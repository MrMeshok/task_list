<?php 
session_start();
if (!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = array();
};
if (!isset($_SESSION["done_tasks"])) {
    $_SESSION["done_tasks"] = array();
};

if ($_POST["button"]) {
    switch ($_POST["button"]) {
        case 'add':
            if ($_POST["task"]) {
                array_push($_SESSION["tasks"], $_POST["task"]);
            }
            break;
        case 'clear':
            unset($_SESSION["tasks"]);
            unset($_SESSION["done_tasks"]);
            break;
        case 'all_done':
            $_SESSION["done_tasks"] = array();
            foreach ($_SESSION["tasks"] as $key => $value) {
                array_push($_SESSION["done_tasks"], $key);
            }
            break;
        
    }
    
}
if (isset($_POST["delete"])) {
    unset($_SESSION["tasks"][$_POST["delete"]]);
}
if (isset($_POST["done"])) {
    array_push($_SESSION["done_tasks"], $_POST["done"]);
}
if (isset($_POST["not_done"])) {
    unset($_SESSION["done_tasks"][$_POST["not_done"]]);
}
header("Location: index.php");
?>