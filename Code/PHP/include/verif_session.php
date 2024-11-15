<?php
session_start();

$limiteTemps = 600;

if (isset($_SESSION["lastActivity"])) {
    $tempsDepuisDerniereActivite = time() - $_SESSION["lastActivity"];
    
    if ($tempsDepuisDerniereActivite > $limiteTemps) {
        session_unset();
        session_destroy();
        header("Location: http://193.54.227.208/~R2024PHP2009/PHP/SAE/FormConnexion.php");
        exit();
    }
}

$_SESSION["lastActivity"] = time();

if (empty($_SESSION["value"])){
    header("Location: http://193.54.227.208/~R2024PHP2009/PHP/SAE/FormConnexion.php");
    exit();
}
else{
    if ($_SESSION["value"] != 'OK'){
        header("Location: http://193.54.227.208/~R2024PHP2009/PHP/SAE/FormConnexion.php");
        exit();
    }
}
?>