<?php
session_start();

if (isset($_POST['submit'])) {

    var_dump($_POST);
    // Récupération des informations lors de l'inscription
    $idCompte = htmlentities($_POST['idcompte']);
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $mail = htmlentities(filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL));
    $dateNaissance = htmlentities($_POST['datenaissance']);
    $numTelephone = htmlentities($_POST['telephone']);

    $idAdresse = htmlentities($_POST['idadresse']);
    $numRue = htmlentities($_POST['numrue']);
    $nomRue = htmlentities($_POST['nomrue']);
    $ville = htmlentities($_POST['ville']);
    $codePostal = htmlentities($_POST['codepostal']);
    $pays = htmlentities($_POST['pays']);
    
    var_dump($nom);

	if (empty($nom) || empty($prenom) || empty($mail)  || empty($numRue) || empty($nomRue) || empty($ville) || empty($codePostal) || empty($pays)) {
        die('Tous les champs sont obligatoires.');
    }
	
	if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        die('Adresse e-mail invalide.');
    }

    // Connexion à la base de données
    require_once '../connect.inc.php';

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
	
	try {
        // Préparation de l'insertion des données
        $stmt = $conn->prepare('UPDATE COMPTE SET DTN = ?, MAIL = ?, NOM = ?, NUMTEL = ?, PRENOM = ? WHERE IDCOMPTE = ?');
        $stmt->execute([$dateNaissance, $mail, $nom, $numTelephone, $prenom , $idCompte]);
        
        $stmt = $conn->prepare('UPDATE ADRESSE SET CODEPOSTAL = ?, NOMRUE = ?, NUMRUE = ?, PAYS = ?, VILLE = ? WHERE IDADRESSE = ?');
        $stmt->execute([$codePostal, $nomRue, $numRue, $pays, $ville, $idAdresse]);

        header('Location: ../profile.php');
        exit();
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>