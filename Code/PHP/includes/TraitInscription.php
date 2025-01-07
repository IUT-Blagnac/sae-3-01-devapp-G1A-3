<?php
if (isset($_POST['submit'])) {

    // Récupération des informations lors de l'inscription
    $nom = htmlentities($_POST['nom']);
    $prenom = htmlentities($_POST['prenom']);
    $mail = htmlentities(filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL));
    $psswd = htmlentities($_POST['password']);
    $dateNaissance = htmlentities($_POST['datenaissance']);
    $numTelephone = htmlentities($_POST['numtelephone']);

    $numeroRue = htmlentities($_POST['numeroRue']);
    $nomRue = htmlentities($_POST['nomRue']);
    $ville = htmlentities($_POST['ville']);
    $codePostal = htmlentities($_POST['codepostal']);
    $pays = htmlentities($_POST['pays']);
    

	if (empty($nom) || empty($prenom) || empty($dateNaissance) || empty($numTelephone) || empty($mail) || empty($psswd)  || empty($numeroRue) || empty($nomRue) || empty($ville) || empty($codePostal) || empty($pays)) {
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
        $idAdr = $stmt->fetch(PDO::FETCH_ASSOC)['IDADRESSE'];

        $stmt = $conn->prepare('INSERT INTO COMPTE (NOM, PRENOM, MAIL, MDP, IDADRESSE, DTN, NUMTEL, IDPERMISSION) VALUES (?, ?, ?, ?, ?, ?, ?, 2)');
        $stmt->execute([$nom, $prenom, $mail, $hashedPassword, $idAdr, $dateNaissance, $numTelephone]);

        $stmt = $conn->prepare('SELECT IDCOMPTE FROM COMPTE WHERE NOM = ? AND PRENOM = ? AND MAIL = ? AND MDP = ? AND IDADRESSE = ? AND DTN = ? AND NUMTEL = ?');
        $stmt->execute([$nom, $prenom, $mail, $hashedPassword, $idAdr, $dateNaissance, $numTelephone]);
        $idCompte = $stmt->fetch(PDO::FETCH_ASSOC)['IDCOMPTE'];

        if (isset($_COOKIE['panierInvite'])){

            $date = date('Y-m-d', time());

            $stmt = $conn->prepare('INSERT INTO COMMANDE (DATECOMMANDE, DATELIVR, IDADRESSE, IDCOMPTE, IDPAIEMENT, STATUSCOMMANDE) VALUES (?, NULL, ?, ?, NULL, "Panier")');
            $stmt->execute([$date, $idAdr, $idCompte]);

            $stmt = $conn->prepare('SELECT IDCOMMANDE FROM COMMANDE WHERE DATECOMMANDE = ? AND IDADRESSE = ? AND IDCOMPTE = ? AND STATUSCOMMANDE = ?');
            $stmt->execute([$date, $idAdr, $idCompte, 'Panier']);
            $panier = $stmt->fetch(PDO::FETCH_ASSOC)['IDCOMMANDE'];

            $_SESSION['panier'] = $panier;

            foreach($_COOKIE["panierInvite"] as $name => $value){
                $data = unserialize($value);

                if (in_array('formatProduit', $data)){
                    $stmt = $conn->prepare('INSERT INTO CONTIENT (IDCOMMANDE, IDFORMAT, IDPROD, QTE) VALUES (?, ?, ?, ?)');
                    $stmt->execute([$panier, $data['formatProduit'], $data['idProduit'], $data['qteProduit']]);
                }
                else{
                    $stmt = $conn->prepare('INSERT INTO CONTIENT (IDCOMMANDE, IDFORMAT, IDPROD, QTE) VALUES (?, ?, ?, ?)');
                    $stmt->execute([$panier, NULL, $data['idProduit'], $data['qteProduit']]);
                }
            }

            unset($_COOKIE['panierInvite']);
        }
        
        header('Location: ../index.php');
        exit();
    } catch (PDOException $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>