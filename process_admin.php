<?php
session_start();
require 'config_admin.php';

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM Admin WHERE `Email` = ?");
$stmt->execute([$email]);
$admin = $stmt->fetch();

if ($admin && password_verify($password, $admin['Admin_Password'])) {
    $_SESSION['admin_id'] = $admin['Admin_ID'];
    $_SESSION['admin_name'] = $admin['ФИО'];
    header("Location: admin_dashboard.php");
    exit;
} else {
    echo "Email ou mot de passe incorrect.";
}
?>
