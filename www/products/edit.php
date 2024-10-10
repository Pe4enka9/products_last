<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/products/queries/category.php';

$sqlProduct = "SELECT * FROM `products` WHERE id = :id";
$stmtProduct = $pdo->prepare($sqlProduct);
$stmtProduct->execute(['id' => $_GET['id']]);
$product = $stmtProduct->fetch(PDO::FETCH_ASSOC);

$sqlCategory = "SELECT * FROM `categories` WHERE id = :categoryID";
$stmtCategory = $pdo->prepare($sqlCategory);
$stmtCategory->execute(['categoryID' => $product['category_id']]);
$currentCategory = $stmtCategory->fetch(PDO::FETCH_ASSOC);

$categories = getCategories();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Изменить</title>
</head>
<body>

<h1>Изменить</h1>

<form action="/products/actions/update.php" method="post">
    <div>
        <input type="text" name="name" value="<?= $product['name'] ?>">
    </div>

    <div>
        <textarea name="description"><?= $product['description'] ?></textarea>
    </div>

    <div>
        <select name="category">
            <option value="<?= $currentCategory['id'] ?>" selected hidden><?= $currentCategory['name'] ?></option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <input type="text" name="slug" placeholder="Slug" value="<?= $product['slug'] ?>">
    </div>

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

</body>
</html>