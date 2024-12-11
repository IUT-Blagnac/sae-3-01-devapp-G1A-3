<?php


require_once 'connect.inc.php';

// Vérification de l'ID du produit passé dans l'URL
if (isset($_GET['idProduit'])) {
    $idProduit = $_GET['idProduit'];
    try {
        // Requête pour récupérer les informations du produit
        $stmt = $conn->prepare("SELECT * FROM PRODUIT WHERE IDPROD = ?");
        $stmt->execute([$idProduit]);
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification si le produit existe
        if (!$produit) {
            echo "Aucun produit trouvé pour cet ID.";
            exit();
        }
        else{
            
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        die();
    }
} else {
    echo "ID produit manquant.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="website icon" type="png" href="./images/logo/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./includes/style.css">
    <title>Détails du Produit | SweetShops</title>
</head>

<body>
    
</body>

</html>