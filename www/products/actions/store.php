<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';
require $_SERVER['DOCUMENT_ROOT'] . '/products/queries/slug.php';

$name = $_POST['name'];
$popular = isset($_POST['popular']) ? 1 : 0;

$sql = "INSERT INTO `products`(`name`, `description`, `category_id`, `popular`, `slug`, `date`) VALUES (:name, :description, :category, :popular, :slug, :date)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'name' => $name,
    'description' => $_POST['description'],
    'category' => $_POST['category'],
    'popular' => $popular,
    'slug' => empty($_POST['slug']) ? createSlug($name) : $_POST['slug'],
    'date' => date('Y-m-d H:i:s'),
]);

header('Location: /products/');