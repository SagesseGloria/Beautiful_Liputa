<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $to = "contact@beautifulliputa.com";  // Ton adresse email
    $subject = "Nouveau message de $nom";
    $body = "Nom : $nom\nEmail : $email\n\nMessage :\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Message envoyé avec succès !');window.location='contact.php';</script>";
    } else {
        echo "<script>alert('Erreur lors de l’envoi. Veuillez réessayer.');window.location='contact.php';</script>";
    }
}
?>
