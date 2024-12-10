<?php
if (isset($_POST['submit'])) {
    // Récupération des informations lors de l'inscription
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    $psswd = $_POST['password'];

    $numeroRue = $_POST['numeroRue'];
    $nomRue = $_POST['nomRue'];
    $ville = $_POST['ville'];
    $codePostal = $_POST['codePostal'];
    $pays = $_POST['pays'];
    

	if (empty($nom) || empty($prenom) || empty($mail) || empty($psswd)  || empty($numeroRue) || empty($nomRue) || empty($ville) || empty($codePostal) || empty($pays)) {
        die('Tous les champs sont obligatoires.');
    }
	
	if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        die('Adresse e-mail invalide.');
    }
	
	$hashedPassword = password_hash($psswd, PASSWORD_BCRYPT);

    // Connexion à la base de données
    require_once '../connect.inc.php';
	
	try {
        // Préparation de l'insertion des données
        $stmt = $conn->prepare('INSERT INTO ADRESSE (CODEPOSTAL, NOMRUE, NUMRUE, PAYS, VILLE) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$codePostal, $nomRue, $numeroRue, $pays, $ville]);

        $stmt = $conn->prepare('SELECT IDADRESSE FROM ADRESSE WHERE CODEPOSTAL = ? AND NOMRUE = ? AND NUMRUE = ? AND PAYS = ? AND VILLE = ?');
        $stmt->execute([$codePostal, $nomRue, $numeroRue, $pays, $ville]);
        $idAdr = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare('INSERT INTO COMPTE (NOM, PRENOM, MAIL, MDP, IDADRESSE) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$nom, $prenom, $mail, $hashedPassword, $idAdr]);

        echo 'Compte créé avec succès !';
        header('Location: ../index.php');
        exit();
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>