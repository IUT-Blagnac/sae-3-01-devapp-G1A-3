<?php
$user = 'R2024PHP3009';
$passwd = 'P224e8NV3qUbwr';

try{
    $conn = new PDO("mysql:host=127.0.0.1;dbname=R2024PHP3009;charset=UTF8", $user, $passwd);
}catch(PDOException $e){
    echo "Erreur de connexion :".$e->getMessage()."<br>";
    die;
}
?>