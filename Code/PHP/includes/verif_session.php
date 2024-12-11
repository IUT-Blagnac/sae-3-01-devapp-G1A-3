<?php
session_start();

$limiteTemps = 600;

if (isset($_SESSION["lastActivity"])) {
    $tempsDepuisDerniereActivite = time() - $_SESSION["lastActivity"];
    
    if ($tempsDepuisDerniereActivite > $limiteTemps) {
        session_unset();
        session_destroy();
        header("Location: http://193.54.227.208/~R2024PHP2009/TP/Projet/FormConnexion.php");
        exit();
    }
}

$_SESSION["lastActivity"] = time();

if (empty($_SESSION["loggedin"])){
    $error_message = "Vous ne pouvez entrer sur cette page sans être connecté";
    header("Location: ../Connexion.php?msgErreur=" . urlencode($error_message));
    exit();
}
else{
    if ($_SESSION["loggedin"] == false){
        $error_message = "Vous ne pouvez entrer sur cette page sans être connecté";
        header("Location: ../Connexion.php?msgErreur=" . urlencode($error_message));
        exit();
    }
}
?>