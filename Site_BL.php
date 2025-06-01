<?php
session_start();
$redirectAfterLogin = isset($_GET['redirect']) ? $_GET['redirect'] : null;
require_once '../admin/config_admin.php'; // Connexion à $pdo

$cartCount = 0;

if (isset($_SESSION['customer'])) {
    $user_id = $_SESSION['customer']['id'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM cart WHERE Customer_ID = ?");
    $stmt->execute([$user_id]);
    $cartCount = $stmt->fetchColumn(); // Retourne le nombre d’articles différents
}
?>

<?php
// Connexion à la base de données
$host = "localhost";
$dbname = "onlineshopbl_db";
$username = "root";
$password = "LaulauJoy@2003";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer tous les produits
try {
    $stmt = $pdo->query("SELECT * FROM product");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Liputa - Boutique en Ligne</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!--<link rel="stylesheet" href="styles.css"> -->
    <style>
        /* Styles pour la page Femme */
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    color: #333;
    background-color: #fff;
    display: flex;
    flex-direction: column
}

/* Header */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    padding: 10px 20px;
    background-color: #003399;
    color: white;
}

.header-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
}

.logo {
  display: flex;
  align-items: center;
  gap: 10px;
}
.main-menu {
  display: flex;
  align-items: center;
  gap: 20px;
  flex-wrap: wrap;
}
.language-currency {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-left: 10px;
}

.language-select,
.currency-select {
  padding: 10px 20px;
  border-radius: 5px;
  font-weight: bold;
  color: #003399;
  background-color: white;
  border: none;
  margin-right: 20px;
  margin-top: 50px;
}

.account-section {
  display: flex;
  align-items: center;
  gap: 15px;
}

.login-btn {
  background-color: white;
  color: #003399;
  font-weight: bold;
  padding: 8px 16px;
  border: none;
  border-radius: 8px;
}

.logo img {
    width: 150px;
}

nav ul {
    list-style-type: none;
    display: flex;
    align-items: center;
}

nav ul li {
    margin-right: 20px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

nav ul li .btn {
    background-color: #fff;
    color: #003399;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.categories {
    padding: 50px;
    text-align: center;
}

.categories h2 {
    font-size: 2.5em;
    margin-bottom: 40px;
}

.category-grid {
    display: flex;
    justify-content: space-around;
}

.category-item {
    text-align: center;
}

.category-item img {
    width: 300px;
    height: auto;
    border-radius: 10px;
}

.category-item h3 {
    margin-top: 20px;
    font-size: 1.5em;
}
/* Footer */
footer {
    background-color: #003399;
    color: white;
    padding: 20px;
    text-align: center;
}

footer .social-media a {
    color: white;
    margin-right: 10px;
    text-decoration: none;
}

footer .footer-info {
    margin-top: 10px;
}

/* Barre de Recherche */
.search-container {
  margin-top: 15px;
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
}

.search-bar {
   
  padding: 10px;
  border-radius: 5px;
  border: none;
  font-size: 16px;
  color: #003399;
}

.search-button {
  width: 5%;
  padding: 6px 10px;
  font-size: 16px;
  border-radius: 5px;
  background-color:#003399;
  border: none;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.search-btn:hover {
  background-color: #002366;
}
/* Fenêtre Modale */
.modal {
    display: none; /* Par défaut, la fenêtre est cachée */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.6);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 400px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
    position: relative;
}

.modal-content h2 {
    text-align: center;
    color: #003399;
    margin-bottom: 20px;
}

.modal-content label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

.modal-content input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
}

.modal-content button {
    background-color: #003399;
    color: white;
    padding: 10px;
    width: 100%;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
}

.modal-content button:hover {
    background-color: #002366;
}
/* Barre de Recherche */
.search-container {
  margin-top: 15px;
  display: flex;
  align-items: center;
  gap: 10px;
  width: 100%;
}

.search-bar {
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: none;
  font-size: 16px;
  color: #003399;
}

.search-button {
    width: 5%;
  padding: 6px 10px;
  font-size: 16px;
  border-radius: 5px;
  background-color:#003399;
  border: none;
  cursor: pointer;
  transition: background-color 0.2s ease;
}

.search-button:hover {
  background-color: #002366;
}
.close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 1.5em;
    color: #aaa;
    cursor: pointer;
}

.close:hover {
    color: #000;
}
ul li a:hover{
    color: rgb(101, 100, 100); text-decoration: none;}
/*.menu li{
    float: left; text-decoration: none;}*/
.menu {
    display: flex;
    align-items: center;
    flex-grow: 1;
}
.menu li a{
    text-decoration: none; display: block; padding: 10px; color: white; cursor: pointer; margin-top: 50px;}
.menu li a:hover{
    background-color:  rgb(233, 231, 231); color: rgb(80, 78, 78);}

nav li:hover .sub-menu{ display: block;}
.sub-menu{
    position: absolute; display: none;
    }
.sub-menu li{
    display: block; width: 200px; top: 0px; z-index: 1;
    } 
.sub-menu li a{ color: white; background-color: #003399}
.sub-menu li:hover a{
    background-color: rgba(255, 255, 255, 0.627); color: rgb(80, 78, 78);}

h1 {
    text-align: center;
    color: #333;
}

.product-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 20px;
}

.product-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    width: 300px;
    text-align: center;
    padding: 15px;
    transition: transform 0.3s;
}

.product-card img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.product-card h2 {
    color: #003399;
    font-size: 1.2em;
    margin: 10px 0;
}

.product-card p {
    color: #666;
    font-size: 0.9em;
}

.price {
    display: block;
    color: #e60000;
    font-weight: bold;
    margin: 10px 0;
}

.add-to-cart-btn {
    background-color: #003399;
    color: white;
    padding: 10px 15px;
    margin-top: 10px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add-to-cart-btn:hover {
    background-color: #001f66;
}
.main-container {
  display: flex;
  flex-direction: row;
  padding: 20px;
  gap: 30px;
  align-items: flex-start;
}

.filters {
  width: 250px;
  background-color: #f2f2f2;
  padding: 20px;
  border-radius: 10px;
}

.filters h2 {
  color: #003399;
  margin-bottom: 20px;
  text-align: left;
}

.filter-group {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.filter-group select,
.filter-group button {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 14px;
}

.filter-group button {
  background-color: #003399;
  color: white;
  cursor: pointer;
}

.filter-group button:hover {
  background-color: #002366;
}

/*.products {
  flex: 1;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 20px;
}*/

.product {
  background: white;
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 15px;
  text-align: center;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  width: 300px;
  transition: transform 0.3s;
    
}
.product img{
    width: 100%;
    height: auto;
    border-radius: 8px;
}
/*.product h2 {
    color: #003399;
    font-size: 1.2em;
    margin: 10px 0;
}

.product p {
    color: #666;
    font-size: 0.9em;
}*/

.language-selector{
    display: none;
}
.payment-methods {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 20px;
  padding: 20px 0;
}

.payment-methods img {
  height: 30px;
  object-fit: contain;
  filter: grayscale(100%);
  transition: filter 0.3s ease;
}

.payment-methods img:hover {
  filter: grayscale(0%);
}

.icon-historique {
  font-size: 40px; /* Ajuste selon ton besoin */
  color: white; /* Harmonise avec ton header */
  margin-top: 0px;  /*Pour l'aligner avec les autres éléments si besoin */
  cursor: pointer;
  transition: color 0.3s ease;
}

.icon-historique:hover {
  color: #ccc;
}
.menu li {
  list-style-type: none;
}


    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <img src="/Beautiful Liputa/Images/Remove_LogoBL.png" alt="Beautiful Liputa Logo">
        </div>
        <nav class="menu">
            <ul>
                <!--<li><a href="Site_BL.html">Accueil</a></li>-->
                <li><a href="femme.html">Femmes</a></li>
                <li><a href="homme.html">Hommes</a></li>
                <li><a href="enfants.html">Enfants</a></li>
                <li>
                    <a>Autres</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="Accessoire.html">Accessoires</a>
                        </li>
                        <li>
                            <a href="Tissue.html">Tissues</a>
                        </li>
                        </ul>
                </li>
                <li><a href="about.html">À propos de nous</a></li>
                <li><a href="contact.php">Contact</a></li>
            <li>
                <a href="afficher_panier.php" id="cart">
                    🛒 (<span id="cart-count"><?= $cartCount ?></span>)
                </a>
                <li>
    <?php if (isset($_SESSION['customer'])): ?>
        <a href="logout_user.php" class="btn">Se Déconnecter</a>
    <?php else: ?>
        <a href="#" id="open-login" class="btn">Se Connecter</a>
    <?php endif; ?>
</li>

            </ul>
            <div class="language-currency">
                <select class="language-select" id="language">
                  <option value="fr" selected>FR</option>
                  <option value="en">EN</option>
                  <option value="ru">RU</option>
                </select>
                <select class="currency-select">
                  <option>XOF FCFA</option>
                  <option>₽ Rouble</option>
                  <option>€ Euro</option>
                </select>
              </div>
              <li>
                <a href="historique_commandes.php" title="Historique des commandes">
                    <i class="fas fa-clock icon-historique"></i>
                </a>
              </li>

        </nav>
        <!-- Fenêtre Modale pour le Formulaire de Connexion -->
<div id="login-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-modal">&times;</span>
        <h2>Connexion</h2>
        <form id="login-form" method="post" action="connexion.php">
        <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirectAfterLogin) ?>">
            <label for="email">Adresse mail</label>
            <input type="text" id="email" placeholder="Entrez votre adresse mail" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" placeholder="Entrez votre mot de passe" required>

            <button type="submit" class="btn">Se Connecter</button>
            <!-- Добавлена ссылка на регистрацию -->
        <p> <a href="Form_inscription.html" id="register-link">Inscrivez-vous ici</a></p>
        </form>
    </div>
</div>
<div id="register-modal" class="modal">
    <div class="modal-content">
        <span class="close" id="close-register-modal">&times;</span>
        <h2>Inscription</h2>
        <form id="register-form">
            <!-- Поле для ФИО -->
            <label for="full-name">Nom complet</label>
            <input type="text" id="full-name" name="full-name" placeholder="Entrez votre nom complet" required>

            <!-- Поле для электронной почты -->
            <label for="new-email">Adresse mail</label>
            <input type="email" id="new-email" name="new-email" placeholder="Entrez votre adresse mail" required>

            <!-- Поле для номера телефона -->
            <label for="phone">Numéro de téléphone</label>
            <input type="tel" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone" required>

            <!-- Поле для адреса -->
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" placeholder="Entrez votre adresse" required>

            <!-- Поле для пароля -->
            <label for="new-password">Mot de passe</label>
            <input type="password" id="new-password" name="new-password" placeholder="Créez un mot de passe" required>

            <!-- Подтверждение пароля -->
            <label for="confirm-password">Confirmez le mot de passe</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez votre mot de passe" required>

            <!-- Кнопка отправки -->
            <button type="submit" class="btn">S'inscrire</button>
        </form>
    </div>
</div>
         
           <!-- Barre de Recherche -->
    <div class="search-container">
        <input type="text" id="searchInput" class="search-bar" placeholder="Rechercher...">
        <button id="search-btn" class="search-button" onclick="searchProducts()">🔍</button>
    </div>
        <!-- Language Selector -->
        <div class="language-selector">
            <select id="language">
                <option value="fr" selected>FR</option>
                <option value="en">EN</option>
                <option value="ru">RU</option>
            </select>
        </div> 
        
    </header>
    <section class="hero">
        <div class="hero-text">
            <h1 data-lang="hero-text">Découvrez l'élégance de la mode africaine</h1>
        </div>
    </section>
    <div class="main-container">
    <aside class="filters" id="filters">
  <h2>Filtres</h2>
  <form method="GET" action="" class="filter-group">
    <label for="material">Matériau :</label>
    <select id="material" name="material">
      <option value="">Tous</option>
      <option value="bogolan">Bogolan</option>
      <option value="wax">Wax</option>
      <option value="vlisco">Vlisco</option>
    </select>

    <label for="size">Taille :</label>
    <select id="size" name="size">
      <option value="">Toutes</option>
      <option value="S">S</option>
      <option value="M">M</option>
      <option value="L">L</option>
      <option value="XL">XL</option>
    </select>

    <label for="price">Prix :</label>
    <select id="price" name="price">
      <option value="">Tous</option>
      <option value="0-30">0FCFA - 10000FCFA</option>
      <option value="30-60">10000FCFA - 25000FCFA</option>
      <option value="60+">25000FCFA et plus</option>
    </select>

    <label for="style">Style :</label>
    <select id="style" name="style">
      <option value="">Tous</option>
      <option value="traditionnel">Traditionnel</option>
      <option value="moderne">Moderne</option>
    </select>

    <label for="type">Type :</label>
    <select id="type" name="type">
      <option value="">Tous</option>
      <option value="robe">Robe & Jupe</option>
      <option value="chemise">Chemises & Costumes</option>
      <option value="pantalon">Pantalon & Culotte</option>
      <option value="combinaison">Combinaison</option>
      <option value="acss">Accessoires</option>
      <option value="tissue">Tissues</option>
    </select>

    <button type="submit">Filtrer</button>
  </form>
</aside>
<?php
// Connexion à la base de données
require_once __DIR__ . '/../admin/config_admin.php'; // adapte selon ton projet

// Récupération des filtres depuis $_GET
$selectedMaterial = $_GET['material'] ?? '';
$selectedSize     = $_GET['size'] ?? '';
$selectedPrice    = $_GET['price'] ?? '';
$selectedStyle    = $_GET['style'] ?? '';
$selectedType     = $_GET['type'] ?? '';

// Construction de la requête SQL dynamique
$sql = "SELECT * FROM product WHERE 1=1";
$params = [];

if ($selectedMaterial !== '') {
    $sql .= " AND Material = :material";
    $params[':material'] = $selectedMaterial;
}

if ($selectedSize !== '') {
    $sql .= " AND size = :size";
    $params[':size'] = $selectedSize;
}

if ($selectedStyle !== '') {
    $sql .= " AND Style = :style";
    $params[':style'] = $selectedStyle;
}

if ($selectedType !== '') {
    $sql .= " AND Category_Name = :type";
    $params[':type'] = $selectedType;
}

// Gestion du filtre par prix
if ($selectedPrice !== '') {
    if ($selectedPrice === '0-30') {
        $sql .= " AND Price BETWEEN 0 AND 10000";
    } elseif ($selectedPrice === '30-60') {
        $sql .= " AND Price BETWEEN 10000 AND 25000";
    } elseif ($selectedPrice === '60+') {
        $sql .= " AND Price > 25000";
    }
}

// Préparation et exécution de la requête
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>

    <div class="product-container" id="product-list">
    
        <?php if (count($products) > 0): ?>
            <?php foreach ($products as $product): ?>
                <div class="product">
                <img src="/Beautiful Liputa/admin/<?= htmlspecialchars($product['Image']) ?>" alt="<?= htmlspecialchars($product['Product_Name']) ?>">
                <h3><?= htmlspecialchars($product['Product_Name']) ?></h3>
                <p><?= htmlspecialchars($product['Description_product']) ?></p>
                    <p><strong>Prix:</strong> <?= number_format($product['Price'], 2) ?> FCFA</p>
            
        <!-- FORMULAIRE D'AJOUT AU PANIER -->
        <form method="post" action="panier.php">
                <input type="hidden" name="product_id" value="<?= $product['Product_ID'] ?>">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['Product_Name']) ?>">
                <input type="hidden" name="product_price" value="<?= $product['Price'] ?>">
                <input type="hidden" name="product_size" value="<?= $product['size'] ?>">
                <input type="hidden" name="product_image" value="<?= $product['Image'] ?>">
                <button type="submit" class="add-to-cart-btn">Ajouter au panier</button>
            </form>
        </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun produit disponible pour le moment.</p>
        <?php endif; ?>
    </div>
    </div>    
    <!-- Categories Section -->
    <section class="categories">
        <h2>Nos Catégories</h2>
        <div class="category-grid">
            <div class="category-item">
                <img src="/Beautiful Liputa/Images/Femme6.jpg" alt="Robes">
                <h3>Robes en pagne Africain</h3>
            </div>
            <div class="category-item">
                <img src="/Beautiful Liputa/Images/Enfant12.jpg" alt="Chemises">
                <h3>Chemises</h3>
            </div>
           <!-- <div class="category-item">
                <img src="C:\wamp64\www\Beautiful Liputa\Images\Femme4.jpg" alt="Accessoires">
                <h3>Chemise en pagne africain</h3>
            </div>-->
            <div class="category-item">
                <img src="/Beautiful Liputa/Images/Accessoire1.jpg" alt="Accessoires">
                <h3>Accessoires</h3>
            </div>
           <!-- <div class="category-item">
                <img src="C:\wamp64\www\Beautiful Liputa\Images\Couple1.jpg" alt="Accessoires">
                <h3>Couple</h3>
            </div>-->
            <div class="category-item">
                <img src="/Beautiful Liputa/Images/Men2.jpg" alt="Pantalons & Culottes">
                <h3> Pantalons & Culottes</h3>
            </div>
        </div>
    </section>


    

    <!-- Footer -->
    <footer>
        <div class="social-media">
            <a href="https://www.facebook.com/share/1Dy4ctj5yT/?mibextid=wwXIfr">Facebook</a>
            <a href="#">WhatsApp</a>
            <a href="https://www.instagram.com/gloriambon/">Instagram</a>
            <a href="https://vk.com/id693623059">VKontakte</a>
        </div>
        <div class="footer-info">
            <p>&copy; 2024 Beautiful Liputa - Tous droits réservés</p>
        </div>
        <div class="payment-methods">
            <img src="/Beautiful Liputa/Images/Visa.png" alt="Visa" />
            <img src="/Beautiful Liputa/Images/MasterCard.png" alt="Mastercard" />
            <img src="/Beautiful Liputa/Images/Paypal.png" alt="PayPal" />
            <img src="/Beautiful Liputa/Images/MIR.png" alt="MIR" />
            <img src="/Beautiful Liputa/Images/UnionPay.png" alt="UnionPay" />
          </div>
    </footer>
    <script src="Site_BL.js"></script>
    <!--<script src="scripts.js"></script> -->
    <script>
        // Compteur du panier
let cartCount = 0;

// Fonction pour ajouter au panier
document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", () => {
        cartCount++;
        document.getElementById("cart-count").innerText = cartCount;
        alert("Produit ajouté au panier !");
    });
});
// Sélection des éléments
const loginModal = document.getElementById("login-modal");
const openLogin = document.getElementById("open-login");
const closeModal = document.getElementById("close-modal");

// Ouvrir la fenêtre modale
openLogin.addEventListener("click", function (event) {
    event.preventDefault();
    loginModal.style.display = "block";
});

// Fermer la fenêtre modale
closeModal.addEventListener("click", function () {
    loginModal.style.display = "none";
});

// Fermer si on clique en dehors du formulaire
window.addEventListener("click", function (event) {
    if (event.target === loginModal) {
        loginModal.style.display = "none";
    }
});
    </script>
</body>
</html>


