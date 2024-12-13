<?php
if (empty($_SESSION)){
    session_start();
}

$limiteTemps = 600;

if (isset($_SESSION["lastActivity"])) {
    $tempsDepuisDerniereActivite = time() - $_SESSION["lastActivity"];
    
    if ($tempsDepuisDerniereActivite > $limiteTemps) {
        session_unset();
        session_destroy();
        header("Location: http://193.54.227.208/~R2024SAE3008/index.php");
        exit();
    }
}

$_SESSION["lastActivity"] = time();
?>