<?php
session_start();
if (isset($_POST["login"]) and isset($_POST["mdp"])){
    $login=htmlentities(htmlspecialchars($_POST["login"]));
    $motdepasse=htmlentities(htmlspecialchars($_POST["mdp"]));
    if ($login != "Achille" || $motdepasse != "Talon"){
        header("Location: http://193.54.227.208/~R2024PHP2009/PHP/SAE/FormConnexion.php");
        echo "Erreur de login et/ou mot de passe";
    }
    else{
        $_SESSION["value"] = 'OK';
        if (isset($_POST["remember"])){
            setcookie('CLamotheRaphael', htmlentities(htmlspecialchars($_POST["login"]), time()+300));
        }
        header("Location: http://193.54.227.208/~R2024PHP2009/PHP/SAE/index.php");
        exit;
    }
}
else{
    header("Location: http://193.54.227.208/~R2024PHP2009/PHP/SAE/FormConnexion.php");
    echo "Erreur de connexion";
}
?>