
/*const translations = {
    "fr": {
        "menu": ["Femme", "Homme", "Enfants", "Autres", "À propos de nous", "Contact"],
        "sub-menu": ["Accessoires", "Tissues"],
        "hero-text": "Découvrez l'élégance de la mode africaine",
        "filters": "Filtres",
        "add-to-cart": "Ajouter au panier",
        "categories-title": "Nos Catégories",
        "category-dress": "Robes Africaines",
        "category-shirt": "Chemises Africaines",
        "category-accessories": "Accessoires",
        "login": "Se Connecter",
        "login-modal-title": "Connexion",
        "email-label": "Adresse mail",
        "email-placeholder": "Entrez votre adresse mail",
        "password-label": "Mot de passe",
        "password-placeholder": "Entrez votre mot de passe",
        "register-link": "Pas encore de compte ? Inscrivez-vous ici",
        "register-modal-title": "Inscription",
        "full-name-label": "Nom complet",
        "new-email-label": "Adresse mail",
        "phone-label": "Numéro de téléphone",
        "address-label": "Adresse",
        "new-password-label": "Mot de passe",
        "confirm-password-label": "Confirmez le mot de passe",
        "register-button": "S'inscrire"
    },
    "en": {
        "menu": ["Woman", "Man", "Kids", "Others", "About Us", "Contact"],
        "sub-menu": ["Accessories", "Fabrics"],
        "hero-text": "Discover the elegance of African fashion",
        "filters": "Filters",
        "add-to-cart": "Add to Cart",
        "categories-title": "Our Categories",
        "category-dress": "African Dresses",
        "category-shirt": "African Shirts",
        "category-accessories": "Accessories",
        "login": "Login",
        "login-modal-title": "Login",
        "email-label": "Email Address",
        "email-placeholder": "Enter your email address",
        "password-label": "Password",
        "password-placeholder": "Enter your password",
        "register-link": "Don't have an account? Sign up here",
        "register-modal-title": "Registration",
        "full-name-label": "Full Name",
        "new-email-label": "Email Address",
        "phone-label": "Phone Number",
        "address-label": "Address",
        "new-password-label": "Password",
        "confirm-password-label": "Confirm Password",
        "register-button": "Sign Up"
    },
    "ru": {
        "menu": ["Женщины", "Мужчины", "Дети", "Другие", "О нас", "Контакт"],
        "sub-menu": ["Аксессуары", "Ткани"],
        "hero-text": "Откройте для себя элегантность африканской моды",
        "filters": "Фильтры",
        "add-to-cart": "Добавить в корзину",
        "categories-title": "Наши категории",
        "category-dress": "Африканские платья",
        "category-shirt": "Африканские рубашки",
        "category-accessories": "Аксессуары",
        "login": "Войти",
        "login-modal-title": "Вход",
        "email-label": "Адрес электронной почты",
        "email-placeholder": "Введите ваш адрес электронной почты",
        "password-label": "Пароль",
        "password-placeholder": "Введите ваш пароль",
        "register-link": "Еще нет аккаунта? Зарегистрируйтесь здесь",
        "register-modal-title": "Регистрация",
        "full-name-label": "Полное имя",
        "new-email-label": "Адрес электронной почты",
        "phone-label": "Номер телефона",
        "address-label": "Адрес",
        "new-password-label": "Пароль",
        "confirm-password-label": "Подтвердите пароль",
        "register-button": "Зарегистрироваться"
    }
};

function updateContent(lang) {
    // Update menu items
    const menuItems = translations[lang]["menu"];
    const subMenuItems = translations[lang]["sub-menu"];
    
    const menuList = document.querySelectorAll("nav.menu > ul > li > a");
    menuList.forEach((item, index) => {
        if (index < menuItems.length) {
            item.textContent = menuItems[index];
        }
    });

    // Update sub-menu items
    const subMenuList = document.querySelectorAll("nav.menu > ul > li > ul.sub-menu > li > a");
    subMenuList.forEach((item, index) => {
        if (index < subMenuItems.length) {
            item.textContent = subMenuItems[index];
        }
    });

    // Update login button
    document.getElementById("open-login").textContent = translations[lang]["login"];


    // Update login modal
    document.getElementById("login-modal").querySelector("h2").innerText = translations[lang]["login-modal-title"];
    document.getElementById("email").placeholder = translations[lang]["email-placeholder"];
    document.getElementById("password").placeholder = translations[lang]["password-placeholder"];
    document.getElementById("register-link").innerText = translations[lang]["register-link"];

    // Update registration modal
    document.getElementById("register-modal").querySelector("h2").innerText = translations[lang]["register-modal-title"];
    document.getElementById("full-name").placeholder = translations[lang]["full-name-label"];
    document.getElementById("new-email").placeholder = translations[lang]["new-email-label"];
    document.getElementById("phone").placeholder = translations[lang]["phone-label"];
    document.getElementById("address").placeholder = translations[lang]["address-label"];
    document.getElementById("new-password").placeholder = translations[lang]["new-password-label"];
    document.getElementById("confirm-password").placeholder = translations[lang]["confirm-password-label"];
    document.querySelector("#register-form button").innerText = translations[lang]["register-button"];
}

// Event listener for language change
document.getElementById("language").addEventListener("change", function () {
    const lang = this.value;
    updateContent(lang);
});

// Initial content update based on the default language
updateContent(document.getElementById("language").value);
document.getElementById("language").addEventListener("change", function () {
    const lang = this.value;

    document.querySelectorAll("[data-lang]").forEach(element => {
        const key = element.getAttribute("data-lang");
        element.textContent = translations[lang][key];
    });
});



// Sélection des éléments
const loginModal = document.getElementById("login-modal");
const closeModal = document.getElementById("close-modal");
const openLogin = document.getElementById("open-login");

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


 // Fermer le formulaire d'inscription
 const closeRegisterModal = document.getElementById("close-register-modal");
 const registerModal = document.getElementById("register-modal");
 
 closeRegisterModal.addEventListener("click", () => {
     registerModal.style.display = "none";
 });
 
 // Валидация формы регистрации
 document.getElementById("register-form").addEventListener("submit", async function (e) {
     e.preventDefault();
 
     const fullName = document.getElementById("full-name").value;
     const email = document.getElementById("new-email").value;
     const phone = document.getElementById("phone").value;
     const address = document.getElementById("address").value;
     const password = document.getElementById("new-password").value;
     const confirmPassword = document.getElementById("confirm-password").value;
 
     // Проверка совпадения паролей
     if (password !== confirmPassword) {
         alert("Les mots de passe ne correspondent pas.");
         return;
     }
     // Проверка номера телефона: должен начинаться с '+' и содержать только цифры
    const phoneRegex = /^\+\d{1,}$/; // + и минимум одна цифра
    if (!phoneRegex.test(phone)) {
        alert("Le numéro de téléphone doit commencer par '+' suivi uniquement de chiffres.");
        return;
    }
 
    try {
        const response = await fetch("register.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ fullName, email, phone, address, password })
        });

        const result = await response.json();
        if (result.success) {
            alert("Inscription réussie !");
            registerModal.style.display = "none";
        } else {
            alert("Erreur : " + result.message);
        }
    } catch (error) {
        alert("Erreur lors de l'inscription.");
        console.error(error);
    }
});

// ✅ Soumission du formulaire de connexion
document.getElementById("login-form").addEventListener("submit", async function (e) {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    try {
        const response = await fetch("login.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ email, password })
        });

        const result = await response.json();
        if (result.success) {
            alert("Connexion réussie !");
            loginModal.style.display = "none";

            const loginBtn = document.getElementById("open-login");
            loginBtn.textContent = "Se déconnecter";
            loginBtn.addEventListener("click", () => {
                window.location.href = "logout.php";
            });
        } else {
            alert("Erreur : " + result.message);
        }
    } catch (error) {
        alert("Erreur lors de la connexion.");
        console.error(error);
    }
});

// 🔁 Lien vers le formulaire d’inscription
document.getElementById("register-link").addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("login-modal").style.display = "none";
    document.getElementById("register-modal").style.display = "block";
});

// Gestion du panier
const cart = []; // Tableau pour stocker les produits ajoutés

// Exemple d'ajout d'un produit au panier
function addToCart(product, price) {
    const item = {
        product: product,
        price: price
    };
    cart.push(item);
    updateCartUI();
}

// Fonction pour mettre à jour l'affichage du panier
function updateCartUI() {
    const cartCount = document.getElementById('cart-count');
    const cartDetails = document.getElementById('cart-details');
    let totalPrice = 0;

    // Compter les articles et calculer le prix total
    cartDetails.innerHTML = ''; // Réinitialiser les détails du panier
    cart.forEach((item, index) => {
        totalPrice += item.price;

        // Ajouter un élément au panier
        cartDetails.innerHTML += `
            <div class="cart-item">
                <span>${item.product}</span>
                <span>${item.price} FCFA</span>
                <button onclick="removeFromCart(${index})">Retirer</button>
            </div>
        `;
    });

    // Mettre à jour le compteur et le prix total
    cartCount.innerText = cart.length;
    const totalPriceElement = document.getElementById('total-price');
    if (totalPriceElement) {
        totalPriceElement.innerText = '${totalPrice} FCFA';
    }
}

// Fonction pour retirer un article du panier
function removeFromCart(index) {
    cart.splice(index, 1); // Retirer l'article à l'index spécifié
    updateCartUI();
}


function applyFilters() {
    const material = document.getElementById('material').value;
    const size = document.getElementById('size').value;
    const price = document.getElementById('price').value;
    const style = document.getElementById('style').value;
    const type = document.getElementById('type').value;

    const products = document.querySelectorAll('.product');

    products.forEach(product => {
        const productMaterial = product.getAttribute('data-material');
        const productSize = product.getAttribute('data-size');
        const productPrice = parseFloat(product.getAttribute('data-price'));
        const productStyle = product.getAttribute('data-style');
        const productType = product.getAttribute('data-type');

        let show = true;

        if (material && productMaterial !== material) show = false;
        if (size && productSize !== size) show = false;
        if (style && productStyle !== style) show = false;
        if (type && productType !== type) show = false;

        if (price) {
            if (price === "0-30" && !(productPrice >= 0 && productPrice <= 30)) show = false;
            if (price === "30-60" && !(productPrice > 30 && productPrice <= 60)) show = false;
            if (price === "60+" && !(productPrice > 60)) show = false;
        }

        product.style.display = show ? "block" : "none";
    });
}
// Sélection des éléments
// script.js
// script.js
let currentIndex = 0;
const slides = document.querySelectorAll('.carousel img');
const totalSlides = slides.length;

// Function to show the current slide
function showSlide(index) {
    const offset = -index * (100 / totalSlides); // Calculate the offset
    document.querySelector('.carousel').style.transform = `translateX(${offset}%)`;
}

// Function to change the slide
function changeSlide(direction) {
    currentIndex = (currentIndex + direction + totalSlides) % totalSlides; // Update index
    showSlide(currentIndex); // Show the new slide
}

// Automatically change slide every second
setInterval(() => {
    changeSlide(1);
}, 1000);



// Event listeners for navigation buttons
document.querySelector('.fa-angle-left').addEventListener('click', () => changeSlide(-1));
document.querySelector('.fa-angle-right').addEventListener('click', () => changeSlide(1));

// Initial display
showSlide(currentIndex);

document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".filter-btn"); // Sélectionne les boutons de filtre
    const products = document.querySelectorAll(".product-card"); // Sélectionne les produits

    filterButtons.forEach(button => {
        button.addEventListener("click", function () {
            const filter = this.dataset.filter; // Récupère la catégorie du bouton
            products.forEach(product => {
                if (filter === "all" || product.classList.contains(filter)) {
                    product.style.display = "block"; // Affiche l'élément
                } else {
                    product.style.display = "none"; // Masque les autres
                }
            });
        });
    });
});*/

document.addEventListener("DOMContentLoaded", function () {

    // Gestion de la langue
    const translations = {
        "fr": {
        "menu": ["Femmes", "Hommes", "Enfants", "Autres", "À propos de nous", "Contact"],
        "sub-menu": ["Accessoires", "Tissues"],
        "hero-text": "Découvrez l'élégance de la mode africaine",
        "filters": "Filtres",
        "add-to-cart": "Ajouter au panier",
        "categories-title": "Nos Catégories",
        "category-dress": "Robes Africaines",
        "category-shirt": "Chemises Africaines",
        "category-accessories": "Accessoires",
        "login": "Se Connecter",
        "login-modal-title": "Connexion",
        "email-label": "Adresse mail",
        "email-placeholder": "Entrez votre adresse mail",
        "password-label": "Mot de passe",
        "password-placeholder": "Entrez votre mot de passe",
        "register-link": "Pas encore de compte ? Inscrivez-vous ici",
        "register-modal-title": "Inscription",
        "full-name-label": "Nom complet",
        "new-email-label": "Adresse mail",
        "phone-label": "Numéro de téléphone",
        "address-label": "Adresse",
        "new-password-label": "Mot de passe",
        "confirm-password-label": "Confirmez le mot de passe",
        "register-button": "S'inscrire"
    },
    "en": {
        "menu": ["Woman", "Man", "Kids", "Others", "About Us", "Contact"],
        "sub-menu": ["Accessories", "Fabrics"],
        "hero-text": "Discover the elegance of African fashion",
        "filters": "Filters",
        "add-to-cart": "Add to Cart",
        "categories-title": "Our Categories",
        "category-dress": "African Dresses",
        "category-shirt": "African Shirts",
        "category-accessories": "Accessories",
        "login": "Login",
        "login-modal-title": "Login",
        "email-label": "Email Address",
        "email-placeholder": "Enter your email address",
        "password-label": "Password",
        "password-placeholder": "Enter your password",
        "register-link": "Don't have an account? Sign up here",
        "register-modal-title": "Registration",
        "full-name-label": "Full Name",
        "new-email-label": "Email Address",
        "phone-label": "Phone Number",
        "address-label": "Address",
        "new-password-label": "Password",
        "confirm-password-label": "Confirm Password",
        "register-button": "Sign Up"
    },
    "ru": {
        "menu": ["Женщины", "Мужчины", "Дети", "Другие", "О нас", "Контакт"],
        "sub-menu": ["Аксессуары", "Ткани"],
        "hero-text": "Откройте для себя элегантность африканской моды",
        "filters": "Фильтры",
        "add-to-cart": "Добавить в корзину",
        "categories-title": "Наши категории",
        "category-dress": "Африканские платья",
        "category-shirt": "Африканские рубашки",
        "category-accessories": "Аксессуары",
        "login": "Войти",
        "login-modal-title": "Вход",
        "email-label": "Адрес электронной почты",
        "email-placeholder": "Введите ваш адрес электронной почты",
        "password-label": "Пароль",
        "password-placeholder": "Введите ваш пароль",
        "register-link": "Еще нет аккаунта? Зарегистрируйтесь здесь",
        "register-modal-title": "Регистрация",
        "full-name-label": "Полное имя",
        "new-email-label": "Адрес электронной почты",
        "phone-label": "Номер телефона",
        "address-label": "Адрес",
        "new-password-label": "Пароль",
        "confirm-password-label": "Подтвердите пароль",
        "register-button": "Зарегистрироваться"
    }
    };

    function updateContent(lang) {
        // Update menu
        const menuItems = translations[lang]["menu"];
        const subMenuItems = translations[lang]["sub-menu"];
        const menuList = document.querySelectorAll("nav.menu > ul > li > a");
        const subMenuList = document.querySelectorAll("nav.menu > ul > li > ul.sub-menu > li > a");

        menuList.forEach((item, index) => {
            if (index < menuItems.length) {
                item.textContent = menuItems[index];
            }
        });

        subMenuList.forEach((item, index) => {
            if (index < subMenuItems.length) {
                item.textContent = subMenuItems[index];
            }
        });

        // Login content
        const loginBtn = document.getElementById("open-login");
        const loginModal = document.getElementById("login-modal");
        const registerModal = document.getElementById("register-modal");

        if (loginBtn) loginBtn.textContent = translations[lang]["login"];
        if (loginModal) {
            loginModal.querySelector("h2").innerText = translations[lang]["login-modal-title"];
            document.getElementById("email").placeholder = translations[lang]["email-placeholder"];
            document.getElementById("password").placeholder = translations[lang]["password-placeholder"];
            document.getElementById("register-link").innerText = translations[lang]["register-link"];
        }

        if (registerModal) {
            registerModal.querySelector("h2").innerText = translations[lang]["register-modal-title"];
            document.getElementById("full-name").placeholder = translations[lang]["full-name-label"];
            document.getElementById("new-email").placeholder = translations[lang]["new-email-label"];
            document.getElementById("phone").placeholder = translations[lang]["phone-label"];
            document.getElementById("address").placeholder = translations[lang]["address-label"];
            document.getElementById("new-password").placeholder = translations[lang]["new-password-label"];
            document.getElementById("confirm-password").placeholder = translations[lang]["confirm-password-label"];
            document.querySelector("#register-form button").innerText = translations[lang]["register-button"];
        }

        // Elements using data-lang
        document.querySelectorAll("[data-lang]").forEach(element => {
            const key = element.getAttribute("data-lang");
            element.textContent = translations[lang][key];
        });
    }

    // Gestion du changement de langue
    const langSelect = document.getElementById("language");
    if (langSelect) {
        updateContent(langSelect.value);
        langSelect.addEventListener("change", function () {
            updateContent(this.value);
        });
    }

    // Fenêtres modales
    const loginModal = document.getElementById("login-modal");
    const registerModal = document.getElementById("register-modal");
    const openLogin = document.getElementById("open-login");
    const closeLoginModal = document.getElementById("close-modal");
    const closeRegisterModal = document.getElementById("close-register-modal");
    const registerLink = document.getElementById("register-link");

    if (openLogin && loginModal) {
        openLogin.addEventListener("click", function (e) {
            e.preventDefault();
            loginModal.style.display = "block";
        });
    }

    if (closeLoginModal && loginModal) {
        closeLoginModal.addEventListener("click", () => {
            loginModal.style.display = "none";
        });
    }

    if (closeRegisterModal && registerModal) {
        closeRegisterModal.addEventListener("click", () => {
            registerModal.style.display = "none";
        });
    }

    if (registerLink && loginModal && registerModal) {
        registerLink.addEventListener("click", function (e) {
            e.preventDefault();
            loginModal.style.display = "none";
            registerModal.style.display = "block";
        });
    }

    window.addEventListener("click", function (e) {
        if (e.target === loginModal) loginModal.style.display = "none";
        if (e.target === registerModal) registerModal.style.display = "none";
    });

    // Connexion
    const loginForm = document.getElementById("login-form");
    if (loginForm) {
        loginForm.addEventListener("submit", async function (e) {
            e.preventDefault();
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            try {
                const response = await fetch("login_user.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ email, password })
                });
                const result = await response.json();
                if (result.success) {
                    alert("Connexion réussie !");
                    loginModal.style.display = "none";
                    openLogin.textContent = "Se déconnecter";
                    openLogin.addEventListener("click", () => {
                        window.location.href = "logout_user.php";
                    });
                } else {
                    alert("Erreur : " + result.message);
                }
            } catch (err) {
                console.error(err);
                alert("Erreur lors de la connexion.");
            }
        });
    }

    // Inscription
    const registerForm = document.getElementById("register-form");
    if (registerForm) {
        registerForm.addEventListener("submit", async function (e) {
            e.preventDefault();

            const fullName = document.getElementById("full-name").value;
            const email = document.getElementById("new-email").value;
            const phone = document.getElementById("phone").value;
            const address = document.getElementById("address").value;
            const password = document.getElementById("new-password").value;
            const confirmPassword = document.getElementById("confirm-password").value;

            if (password !== confirmPassword) {
                alert("Les mots de passe ne correspondent pas.");
                return;
            }

            const phoneRegex = /^\+\d{1,}$/;
            if (!phoneRegex.test(phone)) {
                alert("Le numéro de téléphone doit commencer par '+' suivi uniquement de chiffres.");
                return;
            }

            try {
                const response = await fetch("register.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ fullName, email, phone, address, password })
                });

                const result = await response.json();
                if (result.success) {
                    alert("Inscription réussie !");
                    registerModal.style.display = "none";
                } else {
                    alert("Erreur : " + result.message);
                }
            } catch (error) {
                alert("Erreur lors de l'inscription.");
                console.error(error);
            }
        });
    }

    // Panier
   /* const cart = [];

    function updateCartUI() {
        const cartCount = document.getElementById('cart-count');
        const cartDetails = document.getElementById('cart-details');
        let totalPrice = 0;
        cartDetails.innerHTML = '';
        cart.forEach((item, index) => {
            totalPrice += item.price;
            cartDetails.innerHTML += `
                <div class="cart-item">
                    <span>${item.product}</span>
                    <span>${item.price} FCFA</span>
                    <button onclick="removeFromCart(${index})">Retirer</button>
                </div>
            `;
        });
        if (cartCount) cartCount.innerText = cart.length;
        const totalPriceElement = document.getElementById('total-price');
        if (totalPriceElement) totalPriceElement.innerText = `${totalPrice} FCFA`;
    }

    window.addToCart = function (product, price) {
        cart.push({ product, price });
        updateCartUI();
    };

    window.removeFromCart = function (index) {
        cart.splice(index, 1);
        updateCartUI();
    };*/

    document.querySelectorAll(".add-to-cart-btn").forEach(button => {
        button.addEventListener("click", async function () {
            const product = {
                id: this.dataset.id,
                nom: this.dataset.nom,
                prix: parseInt(this.dataset.prix),
                image: this.dataset.image
            };
    
            try {
                const response = await fetch("ajouter_panier.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(product)
                });
    
                const result = await response.json();
                if (result.success) {
                    alert("Produit ajouté au panier !");
                    // Mettre à jour le compteur 🛒
                    document.getElementById("cart-count").textContent = result.count;
                } else {
                    alert("Erreur lors de l'ajout au panier.");
                }
            } catch (e) {
                alert("Erreur réseau.");
                console.error(e);
            }
        });
    });
    

    // Filtres produits
    const filterButtons = document.querySelectorAll(".filter-btn");
    const products = document.querySelectorAll(".product-card");

    filterButtons.forEach(button => {
        button.addEventListener("click", function () {
            const filter = this.dataset.filter;
            products.forEach(product => {
                product.style.display = (filter === "all" || product.classList.contains(filter)) ? "block" : "none";
            });
        });
    });

    // Filtres avancés
    window.applyFilters = function () {
        const material = document.getElementById('material').value;
        const size = document.getElementById('size').value;
        const price = document.getElementById('price').value;
        const style = document.getElementById('style').value;
        const type = document.getElementById('type').value;

        const allProducts = document.querySelectorAll('.product');

        allProducts.forEach(product => {
            const matches = (
                (!material || product.dataset.material === material) &&
                (!size || product.dataset.size === size) &&
                (!style || product.dataset.style === style) &&
                (!type || product.dataset.type === type) &&
                (!price || (
                    (price === "0-30" && product.dataset.price <= 30) ||
                    (price === "30-60" && product.dataset.price > 30 && product.dataset.price <= 60) ||
                    (price === "60+" && product.dataset.price > 60)
                ))
            );
            product.style.display = matches ? "block" : "none";
        });
    };



});


document.getElementById('searchInput').addEventListener('input', function () {
    const query = this.value.trim();

    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'search.php?q=' + encodeURIComponent(query), true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const productContainer = document.getElementById('product-list');
            productContainer.innerHTML = xhr.responseText;
        }
    };

    xhr.send();
});


function searchProducts() {
    const query = document.getElementById('searchInput').value.trim();

    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'search.php?q=' + encodeURIComponent(query), true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            const productContainer = document.getElementById('product-list');
            productContainer.innerHTML = xhr.responseText;
        }
    };

    xhr.send();
}

// Recherche aussi si on appuie sur Entrée
searchInput.addEventListener('keydown', function (event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        searchProducts(this.value.trim());
    }
});

window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('redirect')) {
        const loginModal = document.getElementById('login-modal');
        if (loginModal) {
            loginModal.style.display = 'block';
        }
    }

    // Fermer la modale si on clique sur le bouton de fermeture
    document.getElementById('close-modal').onclick = function() {
        document.getElementById('login-modal').style.display = 'none';
    }
}