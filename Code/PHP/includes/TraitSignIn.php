<?php
// Fonction permettant de générer un id unique
function generateId($prefix)
{
    $randomNumber = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT); // Génère un nombre à 6 chiffres
    return $prefix . $randomNumber; // Ajoute un préfixe (ex: 'CP', 'ADR')
}

if (isset($_POST['submit'])) {
    // Récupération des informations lors de l'inscription
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    $psswd = $_POST['password'];

	if (empty($nom) || empty($prenom) || empty($mail) || empty($psswd)) {
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
        $stmt = $connect->prepare('INSERT INTO COMPTE (IDCOMPTE, NOM, PRENOM, MAIL, MDP) VALUES (?, ?, ?, ?, ?)');
        $id = generateId('CP'); // Génère un ID unique
        $stmt->execute([$id, $nom, $prenom, $mail, $hashedPassword]);

        echo 'Compte créé avec succès !';
        header('Location: index.php'); // Redirige l'utilisateur après inscription
        exit();
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>