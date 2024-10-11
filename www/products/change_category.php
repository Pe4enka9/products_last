<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

$sql = "SELECT * FROM `categories` WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $_GET['id']]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/edit.css">
    <title>Изменить категорию</title>
</head>
<body>

<div class="container">
    <a href="/products/categories.php">Назад</a>

    <form class="edit-form" action="/products/actions/update_category.php" method="post">
        <fieldset>
            <legend>Название</legend>
            <input type="text" name="name" placeholder="Название" value="<?= $category['name'] ?>">
        </fieldset>
        <input type="hidden" name="id" value="<?= $category['id'] ?>">
        <input type="submit" value="Изменить">
    </form>
</div>

</body>
</html>