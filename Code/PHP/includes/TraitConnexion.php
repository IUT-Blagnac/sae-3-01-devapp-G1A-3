<?php
// Démarrer la session
session_start();

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et sécurisation des entrées utilisateur

    print_r($_POST);

    $mail = htmlentities($_POST['user_mail']);
	$password = htmlentities($_POST['user_password']);
	$remember_me = isset($_POST['seSouvenirMoi']) && $_POST['seSouvenirMoi'] === 'on';
    
	// Connexion à la base de données
    require_once '../connect.inc.php';
	
	try {
        $stmt = $conn->prepare('	SELECT * FROM COMPTE
									WHERE MAIL = ?');
		$stmt->execute([$mail]);
		
		// Récupère les résultats sous forme de tableau associatif
		$passwordBD = $stmt->fetch(PDO::FETCH_ASSOC)['MDP'];
        $prenom = $stmt->fetch(PDO::FETCH_ASSOC)['PRENOM'];
        
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
	
    // Vérification des identifiants
    if (password_verify($password, $passwordBD)) {
        // Identifiants corrects, initialisation de la session
        $_SESSION['loggedin'] = true;
        $_SESSION['nom'] = $mail; // Stocker le login pour réutilisation

        // Gérer l'option "se souvenir de moi"
        if ($remember_me) {
            setcookie('CookieMail', $mail, time() + 900, "/", "", true, true);
            setcookie('CookiePrenom', $prenom, time() + 900, "/", "", true, true);
        }

        // Redirection vers la page d'accueil
        header("Location: ../index.php");
		exit();
    }
    else {
        // Identifiants incorrects, redirection vers le formulaire avec un message d'erreur
        $error_message = "Login ou mot de passe incorrect.";
        header("Location: ../Connexion.php?msgErreur=" . urlencode($error_message));
        exit();
    }
}
?>