<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/products/queries/category.php';

$sqlProduct = "SELECT * FROM `products` WHERE id = :id";
$stmtProduct = $pdo->prepare($sqlProduct);
$stmtProduct->execute(['id' => $_GET['id']]);
$product = $stmtProduct->fetch();

$sqlCategory = "SELECT * FROM `categories` WHERE id = :categoryID";
$stmtCategory = $pdo->prepare($sqlCategory);
$stmtCategory->execute(['categoryID' => $product['category_id']]);
$currentCategory = $stmtCategory->fetch();

$categories = getCategories();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/edit.css">
    <title>Изменить</title>
</head>
<body>

<div class="container">
    <a href="/products/">Назад</a>

    <form class="edit-form" action="/products/actions/update.php" method="post">
        <fieldset>
            <legend>Название</legend>
            <input type="text" name="name" value="<?= $product['name'] ?>">
        </fieldset>

        <fieldset>
            <legend>Описание</legend>
            <textarea name="description"><?= $product['description'] ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Категория</legend>
            <select name="category">
                <option value="<?= $currentCategory['id'] ?>" selected hidden><?= $currentCategory['name'] ?></option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>

        <fieldset>
            <legend>Slug</legend>
            <input type="text" name="slug" placeholder="Slug" value="<?= $product['slug'] ?>">
        </fieldset>

        <div>
            <?php if ($product['popular']): ?>
                <input type="checkbox" name="popular" id="popular" checked>
                <label for="popular">Популярный</label>
            <?php else: ?>
                <input type="checkbox" name="popular" id="popular">
                <label for="popular">Популярный</label>
            <?php endif; ?>
        </div>

        <div>
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
        </div>

        <input type="submit" value="Изменить">
    </form>
</div>

</body>
</html>