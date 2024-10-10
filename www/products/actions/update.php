<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/products/queries/slug.php';

$name = $_POST['name'];

$sql = "UPDATE `products` SET `name` = :name, `description` = :description,`category_id` = :categoryID, `popular` = :popular, `slug` = :slug WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    "name" => $name,
    "description" => $_POST['description'],
    "categoryID" => $_POST['category'],
    "popular" => isset($_POST['popular']) ? 1 : 0,
    "slug" => empty($_POST['slug']) ? createSlug($name) : $_POST['slug'],
    "id" => $_POST['id'],
]);

header('Location: /products/');