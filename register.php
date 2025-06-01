<?php
// Connexion à la base
/*require_once '../admin/config_admin.php'; // adapte le chemin si besoin
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'Aucune donnée reçue.']);
    exit;
}

$fullName = $data['fullName'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['phone'] ?? '';
$address = $data['address'] ?? '';
$password = $data['password'] ?? '';

if (empty($fullName) || empty($email) || empty($phone) || empty($address) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis.']);
    exit;
}

// Hasher le mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
    $pdo = new PDO("mysql:host=localhost;dbname=onlineshopbl_db;charset=utf8", "root", "LaulauJoy@2003");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("INSERT INTO customer (full_name, email, phone, address, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$fullName, $email, $phone, $address, $hashedPassword]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur : ' . $e->getMessage()]);
}*/


require_once("../admin/config_admin.php");

// Récupérer et décoder les données JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Données invalides."]);
    exit;
}

$fullName = trim($data['fullName']);
$email = trim($data['email']);
$phone = trim($data['phone']);
$address = trim($data['address']);
$password = password_hash($data['password'], PASSWORD_DEFAULT);

// Vérifier si l'email existe déjà
$stmt = $pdo->prepare("SELECT * FROM customer WHERE Email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    echo json_encode(["success" => false, "message" => "Cet email est déjà utilisé."]);
    exit;
}

// Insérer le nouvel utilisateur
$stmt = $pdo->prepare("INSERT INTO customer (Full_Name, Email, Phone, Address, password)
                       VALUES (?, ?, ?, ?, ?)");
$success = $stmt->execute([$fullName, $email, $phone, $address, $password]);

if ($success) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur d'inscription."]);
}



