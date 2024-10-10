<?php
/** @var PDO $pdo */
$pdo = require_once $_SERVER['DOCUMENT_ROOT'] . '/connect.php';

$sql = "DELETE FROM `categories` WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $_GET['id'] ?? '']);

header('Location: /products/categories.php');