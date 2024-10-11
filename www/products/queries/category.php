<?php

function getCategories(): array
{
    global $pdo;

    return $pdo->query("SELECT * FROM `categories`")->fetchAll();
}