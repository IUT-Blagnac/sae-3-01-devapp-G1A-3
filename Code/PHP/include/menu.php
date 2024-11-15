        <!-- Menu vertical sur la gauche -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="position-sticky">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"> LOGO SWEETSHOPS </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Ajouts/consultProd.php"> PRODUITS </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="consultCateg.php"> CATEGORIES </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Ajouts/Aide.php"> AIDE </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Ajouts/Contact.php"> CONTACT </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Ajouts/Connexion.php"> SE CONNECTER </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Ajouts/Panier.php"> MON PANIER </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Script JavaScript pour ajouter la classe 'active' sur le lien de la page courante-->
        <script>
            // Récupère l'URL actuelle de la page
            const currentPage = window.location.pathname;
            // Sélectionne tous les liens du menu
            const navLinks = document.querySelectorAll('.nav-link');
            // Parcourt les liens et compare leur attribut 'href' avec l'URL actuelle
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPage.split("/").pop()) {
                    link.classList.add('active');
                }
            });
        </script>