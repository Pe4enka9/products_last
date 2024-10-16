<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

$slug = $_GET['slug'] ?? '';

$sql = "SELECT products.*, categories.name AS category
FROM `products` JOIN `categories`
ON `products`.`category_id` = `categories`.`id`
WHERE slug = :slug";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'slug' => $slug
]);
$product = $stmt->fetch();

$views = $product['views'] + 1;

$sql = "UPDATE `products` SET views = :views WHERE slug = :slug";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'views' => $views,
    'slug' => $slug
]);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/product.css">
    <title><?= $product['name'] ?></title>
</head>
<body>

<div class="container">
    <a href="/products.php">Назад</a>

    <h1><?= $product['name'] ?></h1>

    <?php if (is_null($product['image'])): ?>
        <img src="/assets/images/no_photo.png" alt="Нет фото">
    <?php else: ?>
        <img src="<?= $product['image'] ?>" alt="<?= $product['image'] ?>">
    <?php endif; ?>

    <p><?= $product['description'] ?></p>

    <div>
        Категория: <?= $product['category'] ?>
        <a href="/products.php?categories[]=<?= $product['category_id'] ?>">Все товары этой категории</a>
    </div>

    <div>Количество просмотров: <?= $product['views'] ?></div>
</div>

</body>
</html>