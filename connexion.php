<?php
/*session_start();
require '../admin/config_admin.php'; // ton fichier BDD

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM customer WHERE Email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['Password'])) {
        // Stocker les infos client dans la session
        $_SESSION['customer'] = [
            'id'    => $user['Customer_ID'],
            'name'  => $user['Full_Name'],
            'email' => $user['Email']
        ];

        // Redirection vers la page précédente ou panier
        header("Location: page_paiement.php"); // ou une autre page
        exit;
    } else {
        // Retour avec erreur
        header("Location: Site_BL.php?erreur_connexion=1");
        exit;
    }
}*/

/*session_start();
// ... vérification des identifiants réussie ...
$_SESSION['customer'] = [
    'id' => $user_id,
    'email' => $email
];

if (isset($_POST['redirect']) && !empty($_POST['redirect'])) {
    header('Location: ' . $_POST['redirect']);
    exit;
}

// Sinon, rediriger vers l’accueil ou autre page par défaut
header('Location: Site_BL.php');
exit;*/

session_start();
require_once '../admin/config_admin.php'; // Connexion PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérifier l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM customer WHERE Email = ? AND Mot_de_passe = ?");
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Stocker toutes les infos nécessaires dans la session
        $_SESSION['customer'] = [
            'id' => $user['Customer_ID'],
            'Nom' => $user['Nom'],
            'email' => $user['Email'],
            'Telephone' => $user['Telephone'],
            'Adresse' => $user['Adresse']
        ];

        // Rediriger vers la page souhaitée ou page d’accueil
        if (!empty($_POST['redirect'])) {
            header('Location: ' . $_POST['redirect']);
        } else {
            header('Location: Site_BL.php');
        }
        exit;
    } else {
        // Mauvais identifiants
        echo "Email ou mot de passe incorrect.";
    }
}
?>


