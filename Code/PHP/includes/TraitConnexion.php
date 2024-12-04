<?php
// Démarrer la session
session_start();

// Déclaration des identifiants corrects
$correct_login = 'Achille';
$correct_password = 'Talon';

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et sécurisation des entrées utilisateur
    $login = htmlentities($_POST['user_login']);
    $password = htmlentities($_POST['user_passwd']);
    
    // Vérification des identifiants
    if ($login === $correct_login && $password === $correct_password) {
        // Identifiants corrects, initialisation de la session
        $_SESSION['loggedin'] = true;
        $_SESSION['nom'] = $login; // Stocker le login pour réutilisation

        // Gérer l'option "se souvenir de moi"
        if (isset($_POST['seSouvenirMoi']) && $_POST['seSouvenirMoi'] === 'oui') {
            $expiration = time() + 900; // Cookie expire dans 15 minutes
            setcookie('CdavidTran', $login, $expiration, "/");
        }

        // Redirection vers la page d'accueil
        header("Location: ../index.php");
        exit();
    } else {
        // Identifiants incorrects, redirection vers le formulaire avec un message d'erreur
        $url = "formConnexion.php?msgErreur=" . urlencode("Login ou mot de passe incorrect.");
        header("Location: $url");
        exit();
    }
}
