<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact - Beautiful Liputa</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fdfdfd;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #d0006f;
            color: white;
            padding: 1.5rem;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 3rem auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #d0006f;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, textarea {
            margin-bottom: 1rem;
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 12px;
            background-color: #d0006f;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #a80058;
        }

        .contact-info {
            margin-top: 2rem;
            font-size: 1.1rem;
        }

        footer {
            text-align: center;
            padding: 1rem;
            margin-top: 3rem;
            background-color: #f3f3f3;
            color: #888;
        }
    </style>
</head>
<body>

<header>
    <h1>Contactez-nous</h1>
</header>

<div class="container">
    <h2>Restons en contact</h2>
    <form action="envoyer_message.php" method="POST">
        <input type="text" name="nom" placeholder="Votre nom" required>
        <input type="email" name="email" placeholder="Votre email" required>
        <textarea name="message" rows="6" placeholder="Votre message..." required></textarea>
        <button type="submit">Envoyer</button>
    </form>

    <div class="contact-info">
        <p><strong>Email :</strong> contact@beautifulliputa.com</p>
        <p><strong>Téléphone :</strong> +242 06 819 8872</p>
        <p><strong>Adresse :</strong> Avenue du Commerce, Brazzaville, Congo</p>
    </div>
</div>

<footer>
    &copy; 2024 Beautiful Liputa - Tous droits réservés.
</footer>

</body>
</html>
