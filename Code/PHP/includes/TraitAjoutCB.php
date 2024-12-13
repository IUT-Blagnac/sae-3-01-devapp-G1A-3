<?php
session_start();

if (isset($_POST['submit'])) {

    // Récupération des informations lors de l'inscription
    $nomCB = htmlentities($_POST['nomCB']);
    $numeroCB = htmlentities($_POST['numeroCB']);
    $expiration = "01/";
    $expiration .= htmlentities($_POST['expiration']);
    $time = strtotime($expiration);
    $dateExpiration = date('Y-m-d',$time);
    $cvv = htmlentities($_POST['cvv']);
    
	if (empty($nomCB) || empty($numeroCB) || empty($expiration) || empty($cvv)) {
        die('Tous les champs sont obligatoires.');
    }

    // Connexion à la base de données
    require_once '../connect.inc.php';
	
	try {
        $date = date('Y-m-d', time());
        if ($dateExpiration > $date){
            $stmt = $conn->prepare('INSERT INTO CB (NUMCARTE, CVV, DATEEXPIRATION) VALUES (?, ?, ?)');
            $stmt->execute([$numeroCB, $cvv, $dateExpiration]);

            $stmt = $conn->prepare('INSERT INTO METHODEPAIEMENT (IDCOMPTE, IDOPTION, NUMCARTE, STATUT) VALUES (?, 1, ?, ?)');
            $stmt->execute([$_SESSION["idCompte"], $numeroCB, "Valide"]);
            header('Location: ../profile.php');
            exit();
        }
        else{
            $error_message = "Votre carte a expiré.";
            header("Location: ../AjoutCB.php?msgErreur=" . urlencode($error_message));
            exit();
        }
        
        
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>