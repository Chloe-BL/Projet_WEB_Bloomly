<?php
 
require_once 'config/dataBase.php';

$sql = "SELECT * FROM entreprise";
$stmt = $pdo->query($sql);
$entreprises = $stmt->fetchAll();
echo "<pre>";
print_r($entreprises);
echo "</pre>";
 