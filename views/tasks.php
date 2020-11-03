<?
$title = "Список задач";
include_once 'header.php';
?>
<body>
    <div class="blocks">
        <form id="form" action="controllers/controller.php" method="POST">
            <input type="text" name="task"><br>
            <button class="button" name="button" value="add">Добавить</button>
            <button class="button" name="button" value="clear">Удалить все задачи</button>
            <button class="button" name="button" value="all_done">Все задачи выполнены</button>
        </form>
    </div>
    <div class="blocks" style="color: #fff; margin-top: 3px;">
        <div class="block" style="border-bottom: 1px solid #000">Лист заданий</div>
        <?// Вывод tasks
        foreach ($tasks as $value) {
            if ($value['done']) {
                echo '<div class="block done">'.htmlspecialchars($value['description'], ENT_QUOTES, 'UTF-8').'<button name="delete" value="'.$value['id'].'" form="form">Удалить</button><button name="not_done" value="'.$value['id'].'" form="form">В работу</button></div>';
            }else {
                echo '<div class="block">'.htmlspecialchars($value['description'], ENT_QUOTES, 'UTF-8').'<button name="delete" value="'.$value['id'].'" form="form">Удалить</button><button name="done" value="'.$value['id'].'" form="form">Выполнено</button></div>';
            }
        }?>
    </div>
    <br>
    <a href="../models/exit.php">Выйти из аккаунта</a>

    <? // Обработка ошибок
    if (!empty($_SESSION["error"])) {
    echo "<script>alert('".$_SESSION["error"]."')</script>";
    unset($_SESSION["error"]);
    };?>
</body>
</html>