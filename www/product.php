<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

$slug = $_GET['slug'] ?? '';

$product = $pdo->query("SELECT products.*, categories.name AS category
FROM `products` JOIN `categories`
ON `products`.`category_id` = `categories`.`id`
WHERE slug = '$slug'")->fetch(PDO::FETCH_ASSOC);

$views = $product['views'] + 1;

$pdo->query("UPDATE `products` SET views = '$views' WHERE slug = '$slug'");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $product['name'] ?></title>
</head>
<body>

<h1><?= $product['name'] ?></h1>

<h2>Описание</h2>
<p><?= $product['description'] ?></p>

<div>Категория: <?= $product['category'] ?></div>

<a href="/products.php?categories[]=<?= $product['category_id'] ?>">Все товары этой категории</a>

<div>Количество просмотров: <?= $product['views'] ?></div>

</body>
</html>