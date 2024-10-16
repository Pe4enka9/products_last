<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/products/queries/category.php';

$currentCategories = $_GET['categories'] ?? ['all'];

if (in_array('all', $currentCategories)) {
    $stmt = $pdo->query("SELECT products.*, categories.name AS category
            FROM `products`
            JOIN `categories` ON products.category_id = categories.id
            ORDER BY `products`.`date` DESC");
} else {
    $placeholders = implode(',', array_fill(0, count($currentCategories), '?'));

    $sql = "SELECT products.*, categories.name AS category
            FROM `products`
            JOIN `categories` ON products.category_id = categories.id
            WHERE products.category_id IN ($placeholders)
            ORDER BY `products`.`date` DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($currentCategories);
}

$products = $stmt->fetchAll();

$categories = getCategories();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/products.css">
    <title>Каталог</title>
</head>
<body>

<div class="container">
    <h1>Каталог</h1>

    <form class="filter" method="get">
        <select name="categories[]">
            <option value="all" selected>Все</option>
            <?php foreach ($categories as $category): ?>
                <?php if ($currentCategories[0] == $category['id'] && count($currentCategories) === 1): ?>
                    <option value="<?= $currentCategories[0] ?>" selected><?= $category['name'] ?></option>
                <?php else: ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Искать">
    </form>

    <form class="checkbox-filter" method="get">
        <?php foreach ($categories as $category): ?>
            <div class="checkbox-container">
                <input type="checkbox" name="categories[]" id="<?= $category['name'] ?>>"
                       value="<?= $category['id'] ?>" <?= in_array($category['id'], $currentCategories) ? 'checked' : '' ?>>
                <label for="<?= $category['name'] ?>>"><?= $category['name'] ?></label>
            </div>
        <?php endforeach; ?>

        <input type="submit" value="Искать">
    </form>

    <div class="grid-container">
        <?php if ($stmt->rowCount() < 1): ?>
            <div>К сожалению, таких товаров нет :(</div>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="card">
                    <div class="image-container">
                        <?php if (is_null($product['image'])): ?>
                            <img src="/assets/images/no_photo.png" alt="Нет фото">
                        <?php else: ?>
                            <img src="<?= $product['image'] ?>" alt="<?= $product['image'] ?>">
                        <?php endif; ?>
                    </div>

                    <div class="card-info">
                        <h2><?= $product['name'] ?></h2>
                        <p><?= $product['description'] ?></p>
                        <div>Категория: <?= $product['category'] ?></div>
                        <div>Просмотры: <?= $product['views'] ?></div>
                    </div>

                    <div class="price">
                        <div><?= $product['price'] ?> рублей</div>
                        <a href="/product.php?slug=<?= $product['slug'] ?>">Перейти</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

</body>
</html>