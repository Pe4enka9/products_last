<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

$sql = "INSERT INTO `categories`(`name`) VALUES (:name)";
$stmt = $pdo->prepare($sql);
$stmt->execute(["name" => $_POST["name"]]);

header('Location: /products/categories.php');