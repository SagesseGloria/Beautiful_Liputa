<?php
session_start();
require_once 'config_admin.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM super_admin WHERE Email = ?");
    $stmt->execute([$email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['SuperAdmin_Password'])) {
        $_SESSION['super_admin_id'] = $admin['SuperAdmin_ID'];
        $_SESSION['super_admin_name'] = $admin['Full_Name'];
        header('Location: super_admin_dashboard.php');
        exit;
    } else {
        $message = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Super Admin</title>
    <style>
        .form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin-top: 20px;
}
        form{
            position: relative;
            width: 300px;
            height: 150px;
            border-radius: 5px;
            justify-content: center; 
            align-items: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.6);
        }
        form button{
            background-color: #444;
            color: white;
            padding: 10px;
            margin: 40px;
            margin-top: 0px;
            /*margin-left: 45px;*/
            width: 50%;
            justify-content: center;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }
        header {
      background-color: #333;
      color: white;
      padding: 15px 20px;
      justify-content: space-between;
      align-items: center;
    }
header h1 {
      margin: 0;
      font-size: 22px;
      text-align: center;
    }
        .logo {
        display: flex;
        align-items: center;
        gap: 10px;
        }
        .logo img {
    width: 150px;
}
    </style>
</head>
<body>
<header>
    <div class="logo">
    <img src="/Beautiful Liputa/Images/Remove_LogoBL.png" alt="Beautiful Liputa Logo">
</div>
    <h1>Connexion Super Administrateur</h1>
</header>
    <?php if ($message): ?>
        <p style="color:red;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
<div class="form-container">
    <form method="post">
        <label>Email :<br>
            <input type="email" name="email" required>
        </label><br><br>

        <label>Mot de passe :<br>
            <input type="password" name="password" required>
        </label><br><br>

        <button type="submit">Se connecter</button>
    </form>
    </div>
</body>
</html>