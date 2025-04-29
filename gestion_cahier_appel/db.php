<?php
$host = 'sql312.infinityfree.com';
$dbname = 'if0_38850616_mytrack';
$user = 'if0_38850616';
$pass = '4IdNu5f3Aa6'; // Change selon ta config

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
