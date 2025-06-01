<?php
$host = 'localhost';
$db   = 'onlineshopbl_db'; // Remplace avec ta base
$user = 'root';
$pass = 'LaulauJoy@2003'; // Ton mot de passe WAMP si tu en as mis un
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
