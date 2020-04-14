<?php require 'shared.php'; 

$idx = $_GET['p'] ?? null;

header("Content-Type: application/json");

echo json_encode([
    'policy' => ($policies[$idx] ?? [])['value'] ?? null,
    'refer'  => $_SERVER['HTTP_REFERER'] ?? null,
], JSON_PRETTY_PRINT);