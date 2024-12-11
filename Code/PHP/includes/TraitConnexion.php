<?php
// Démarrer la session
session_start();

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et sécurisation des entrées utilisateur
    $mail = htmlentities($_POST['user_mail']);
	$password = htmlentities($_POST['user_password']);
	$remember_me = isset($_POST['seSouvenirMoi']) && $_POST['seSouvenirMoi'] === 'on';
    
	// Connexion à la base de données
    require_once '../connect.inc.php';
	
	try {
        $stmt = $conn->prepare('SELECT * FROM COMPTE
								WHERE MAIL = ?');
		$stmt->execute([$mail]);
		
		// Récupère les résultats sous forme de tableau associatif
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result){
            $idCompte = $result['IDCOMPTE'];
            $passwordBD = $result['MDP'];
            $nom = $result['NOM'];
            $prenom = $result['PRENOM'];
            $idAdresse = $result['IDADRESSE'];
            $idPermission = $result['IDPERMISSION'];
            $numTelephone = $result['NUMTEL'];
            $dateNaissance = $result['DTN'];
        }
    
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }

    try {
        $stmt = $conn->prepare('	SELECT * FROM ADRESSE
                                    WHERE IDADRESSE = ?');
        $stmt->execute([$idAdresse]);
        
        // Récupère les résultats sous forme de tableau associatif
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result){
            $numRue = $result['NUMRUE'];
            $ville = $result['VILLE'];
            $codePostal = $result['CODEPOSTAL'];
            $pays = $result['PAYS'];
            $nomRue = $result['NOMRUE'];
        }
         
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
	
    // Vérification des identifiants
    if (password_verify($password, $passwordBD)) {
        // Identifiants corrects, initialisation de la session
        $_SESSION["loggedin"] = true;
        if ($idPermission === 1){
            $_SESSION["idPermission"] = "Administrateur";
        }
        else{
            $_SESSION["idPermission"] = "Client";
        }
        $_SESSION["idCompte"] = $idCompte;
        $_SESSION["nom"] = $nom;
        $_SESSION["prenom"] = $prenom;
        $_SESSION["mail"] = $mail;
        $_SESSION["dateNaissance"] = $dateNaissance;
        $_SESSION["numeroTelephone"] = $numTelephone;

        $_SESSION["numRue"] = $numRue;
        $_SESSION["ville"] = $ville;
        $_SESSION["codePostal"] = $codePostal;
        $_SESSION["pays"] = $pays;
        $_SESSION["nomRue"] = $nomRue;
        $_SESSION["idAdresse"] = $idAdresse;

        // Gérer l'option "se souvenir de moi"
        if ($remember_me) {
            setcookie('CookieMail', $mail, time() + 900, "/", "", false, true);
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