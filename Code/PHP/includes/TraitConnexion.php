<?php
// Démarrer la session
session_start();

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et sécurisation des entrées utilisateur
    $login = filter_input(INPUT_POST, 'user_login', FILTER_SANITIZE_STRING);
	$hashedPassword = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
	$remember_me = isset($_POST['seSouvenirMoi']) && $_POST['seSouvenirMoi'] === 'on';
    
	// Connexion à la base de données
    require_once '../connect.inc.php';
	
	try {
        $stmt = $conn->prepare('	SELECT * FROM COMPTE
									WHERE MAIL = :mail
									AND	MDP = :mdp 		');
		$stmt->bindParam(':mail', $login);
		$stmt->bindParam(':mdp', $hashedPassword);
        $stmt->execute();
		
		// Récupère les résultats sous forme de tableau associatif
		$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// Affiche les données
		foreach ($utilisateurs as $utilisateur) {
			echo "Nom : " . $utilisateur['nom'] . ", Email : " . $utilisateur['email'] . "<br>";
		}

        header('Location: ../Connexion.php');
        exit();
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
	
    // Vérification des identifiants
    if ($login === $correct_login && password_verify($password, $correct_password)) {
        // Identifiants corrects, initialisation de la session
        $_SESSION['loggedin'] = true;
        $_SESSION['nom'] = $login; // Stocker le login pour réutilisation

        // Gérer l'option "se souvenir de moi"
        if ($remember_me) {
            $expiration = time() + 900; // Cookie expire dans 15 minutes
            setcookie('CookieAchilleTalon', $login, $expiration, "/", "", true, true);
        }

        // Redirection vers la page d'accueil
        header("Location: ../index.php");
		exit();
    } else {
        // Identifiants incorrects, redirection vers le formulaire avec un message d'erreur
        $error_message = "Login ou mot de passe incorrect.";
        header("Location: ../Connexion.php?msgErreur=" . urlencode($error_message));
        exit();
    }
}
?>