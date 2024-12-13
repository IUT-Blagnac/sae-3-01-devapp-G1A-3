<?php
require_once 'includes/verif_inactivite.php';
require_once 'connect.inc.php';

// Vérification de l'ID du produit passé dans l'URL
if (isset($_GET['idProduit'])) {
    $idProduit = $_GET['idProduit'];
    try {
        // Requête pour récupérer les informations du produit
        $stmt = $conn->prepare("SELECT * FROM PRODUIT WHERE IDPROD = ?");
        $stmt->execute([$idProduit]);
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare('CALL get_dispos_produit(?)');
        $stmt->execute([$idProduit]);
        $carac = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare('CALL get_moyenne_prod(?)');
        $stmt->execute([$idProduit]);
        $moyenneNotes = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification si le produit existe
        if (!$produit) {
            echo "Aucun produit trouvé pour cet ID.";
            exit();
        }
        else{
            echo "<p>";
            echo $produit['NOMPROD'];
            echo "<br>";
            if ($moyenneNotes !== false){
                $moyenneNotes = round($moyenneNotes['noteAvg'], 0, PHP_ROUND_HALF_DOWN);
                for ($i = 0; $i < $moyenneNotes - 1; $i += 2){
                    echo "<img src='images/etoile_pleine.png' width='20' height='20'></img>";
                }
                if ($moyenneNotes - $i == 1){
                    echo "<img src='images/demi_etoile.png' width='20' height='20'></img>";
                    $i +=2;
                }
                for ($i; $i < 10; $i += 2){
                    echo "<img src='images/etoile_vide.png' width='20' height='20'></img>";
                }
            }
            else{
                echo "Aucun avis sur ce produit";
            }
            echo "<br>";
            echo $produit['NOTESTECH'];
            echo "<br>";
            echo $produit['DESCRIPTION'];
            echo "</p>";
            echo "<p>";
            echo "Ingrédients : <br>";
            echo $produit['COMPOSITION'];
            echo "</p>";

            echo "<p>";
            echo "<h3>";
            echo "Format";
            echo "</h3>";
            $formats = array();
            foreach($carac as $car){
                if (!(in_array($car['NOMFORMAT'], $formats))){
                    echo "<input type='button' value='".$car['NOMFORMAT']."'/>";
                    array_push($formats, $car['NOMFORMAT']);
                }
            }
            echo "</p>";
            echo "<p>";
                echo "<h3>";
                echo "Couleur(s) disponible(s)";
                echo "</h3>";
                $couleurs = array();
                foreach($carac as $car){
                    if (!(in_array($car['NOMCOULEUR'], $couleurs))){
                        echo "<input type='button' value='".$car['NOMCOULEUR']."'/>";
                        array_push($couleurs, $car['NOMCOULEUR']);
                    }
                }
            echo "</p>";
            echo "<p>";
            echo "Faire les boutons en bas des bonbons";
            echo "</p>";

            echo "<p>";
            echo "<h3>";
            echo "En STOCK";
            echo "</h3>";
            echo "<form action='includes/TraitAjoutPanier.php?idProduit=".htmlspecialchars($idProduit)."' method='POST'>
                <input type='number' id='quantite' name='quantite' min='1' step='1' value='1' required onblur='checkNegativeOnBlur(this)'/>
                <input type='submit' name='action' value='Ajouter au panier' class='btn btn-primary'/>
                <input type='submit' name='action' value='Acheter' class='btn btn-primary'/>
            </form>";
            echo "</p>";
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
<script>
        $(document).ready(function() {
            let currentIndex = 0; // Index de l'étape actuelle dans la barre de progression
            const steps = $(".progress-step"); // Sélectionne les étapes de progression

            // Fonction pour aller à l'étape suivante
            function goToNextStep(currentStep, nextStep) {
                $(currentStep).hide(); // Masquer l'étape actuelle
                $(nextStep).show(); // Afficher l'étape suivante

                // Activer l'étape suivante dans la barre de progression
                $(steps.eq(currentIndex)).removeClass("active");
                currentIndex++;
                $(steps.eq(currentIndex)).addClass("active");
            }

            // Fonction pour revenir à l'étape précédente
            function goToPreviousStep(currentStep, previousStep) {
                $(currentStep).hide(); // Masquer l'étape actuelle
                $(previousStep).show(); // Afficher l'étape précédente

                // Activer l'étape précédente dans la barre de progression
                $(steps.eq(currentIndex)).removeClass("active");
                currentIndex--;
                $(steps.eq(currentIndex)).addClass("active");
            }

            // Navigation entre les étapes
            $("#nextToStep2").click(function() {
                goToNextStep("#step1-content", "#step2-content");
            });

            $("#nextToStep3").click(function() {
                goToNextStep("#step2-content", "#step3-content");
            });

            $("#nextToStep4").click(function() {
                goToNextStep("#step3-content", "#step4-content");
            });

            // Navigation en arrière
            $("#prevToStep1").click(function() {
                goToPreviousStep("#step2-content", "#step1-content");
            });

            $("#prevToStep2").click(function() {
                goToPreviousStep("#step3-content", "#step2-content");
            });

            $("#prevToStep3").click(function() {
                goToPreviousStep("#step4-content", "#step3-content");
            });
        });

        function checkNegativeOnBlur(input) {
            if (input.value < 1) {
                input.value = 1;
            }
        }
    </script>
</body>

</html>