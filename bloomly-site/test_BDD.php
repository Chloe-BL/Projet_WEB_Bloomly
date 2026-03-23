<?php

$host = 'localhost';
$port = '3306';
$dbname = 'Bloomly';
$user = 'Bloomly_user';
$password = 'Bloomly2026!';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Erreur : " . $e -> getMessage();
}