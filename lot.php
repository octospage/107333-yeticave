<?php

require_once 'functions.php';
require_once 'lots.php';
// ставки пользователей, которыми надо заполнить таблицу
$bets = [
    ['name' => 'Иван', 'price' => 11500, 'ts' => strtotime('-' . rand(1, 50) .' minute')],
    ['name' => 'Константин', 'price' => 11000, 'ts' => strtotime('-' . rand(1, 18) .' hour')],
    ['name' => 'Евгений', 'price' => 10500, 'ts' => strtotime('-' . rand(25, 50) .' hour')],
    ['name' => 'Семён', 'price' => 10000, 'ts' => strtotime('last week')]
];


$main_cookie = "lot-" . $_GET["id"];
if (!isset($_COOKIE[$main_cookie]))
{

    if (isset($_POST['add-cost'])) { //если форма была отправлена

// ДОБАВИТЬ КУКИ
        setcookie("cost-" . $_GET["id"],  $_POST["cost"]);
        setcookie("time-" . $_GET["id"],  time());
        setcookie( $main_cookie,  $_GET["id"]);
//    сумму;
//    дату и время; time()
//идентификатор лота (индекс из массива лотов).

// ПЕРЕНАПРАВИТЬ НА MYLOTS
 header("Location: /mylots.php");
    }
}





?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>DC Ply Mens 2016/2017 Snowboard</title>
    <link href="css/normalize.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<?= include_templates("templates/header.php", []) ?>



<?php
if (!array_key_exists($_GET['id'], $lots)) {
    header("HTTP/1.1 404 Not Found");
    ?>
    <main>
        <?= include_templates("templates/nav.php", []) ?>
        <section class="lot-item container">
            <h2>Такого лота не существует</h2>
            <p>Перейдите на <a href="/">главную страницу</a> для просмотра всех товаров</p>
        </section>

    </main>

    <?php
    exit();
} else include_templates("templates/lot.php", ['bets' => $bets, 'lot' => $lots[$_GET['id']]]);
?>

<?= include_templates("templates/footer.php", []) ?>

</body>
</html>
