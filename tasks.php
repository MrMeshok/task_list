<?php session_start();
$title = "Список задач";
include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php';
?>

<body>
    <div class="blocks">
        <form id="form" action="database/task_config.php" method="POST">
            <input type="text" name="task"><br>
            <button class="button" name="button" value="add">Добавить</button>
            <button class="button" name="button" value="clear">Удалить все задачи</button>
            <button class="button" name="button" value="all_done">Все задачи выполнены</button>
        </form>
    </div>
    <div class="blocks" style="color: #fff; margin-top: 3px;">
        <div class="block" style="border-bottom: 1px solid #000">Лист заданий</div>
        <?php 
        if ($_SESSION["tasks"]) {
            foreach ($_SESSION["tasks"] as $key => $value) {
                if ($_SESSION["done_tasks"]) {
                        if (in_array($key, $_SESSION["done_tasks"])) {
                            echo '<div id="'.$key.'" class="block done">'.$value.'<button name="delete" value="'.$key.'" form="form">Удалить</button><button name="not_done" value="'.$key2.'" form="form">В работу</button></div>';
                        }else{
                        echo '<div id="'.$key.'" class="block">'.$value.'<button name="delete" value="'.$key.'" form="form">Удалить</button><button name="done" value="'.$key.'" form="form">Выполнено</button></div>';
                        }
                    
                }else{
                    echo '<div id="'.$key.'" class="block">'.$value.'<button name="delete" value="'.$key.'" form="form">Удалить</button><button name="done" value="'.$key.'" form="form">Выполнено</button></div>';
                }
            }
        }
        ?>
    </div>
</body>
</html>