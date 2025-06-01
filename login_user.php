<?php
/*require_once '../admin/config_admin.php';
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Email et mot de passe requis.']);
    exit;
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=onlineshopbl_db;charset=utf8", "root", "LaulauJoy@2003");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM customer WHERE Email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Aucun utilisateur trouvé.', 'debug' => $email]);
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Mot de passe incorrect.',
            'debug' => [
                'mot_de_passe_saisi' => $password,
                'hash_en_base' => $user['password']
            ]
        ]);
        exit;
    }

    $_SESSION['user_id'] = $user['Customer_ID'];
    $_SESSION['user_email'] = $user['Email'];
    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur : ' . $e->getMessage()]);
}*/

session_start();
require_once("../admin/config_admin.php");

// Récupérer et décoder les données JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Données invalides."]);
    exit;
}

$email = trim($data['email']);
$password = $data['password'];

$stmt = $pdo->prepare("SELECT * FROM customer WHERE Email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['customer'] = [
        'id' => $user['Customer_ID'],
        'name' => $user['Full_Name']
    ];
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Email ou mot de passe incorrect"]);
}



