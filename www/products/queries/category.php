<?php

function getCategories(): array
{
    global $pdo;

    return $pdo->query("SELECT * FROM `categories`")->fetchAll(PDO::FETCH_ASSOC);
}