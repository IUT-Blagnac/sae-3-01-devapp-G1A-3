<?php
if (empty($_SESSION)){
    session_start();
}
if (empty($_SESSION["loggedin"])){
    $error_message = "Vous ne pouvez entrer sur cette page sans être connecté";
    header("Location: http://193.54.227.208/~R2024SAE3008/index.php?msgErreur=" . urlencode($error_message));
    exit();
}
else{
    if ($_SESSION["loggedin"] == false){
        $error_message = "Vous ne pouvez entrer sur cette page sans être connecté";
        header("Location: http://193.54.227.208/~R2024SAE3008/index.php?msgErreur=" . urlencode($error_message));
        exit();
    }
}
?>