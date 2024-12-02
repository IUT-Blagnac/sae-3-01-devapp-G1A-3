<?php 
try{
  $connect = new PDO ('mysql:host=localhost;dbname=R2024PHP3011;charset=UTF8','R2024PHP3011','37ewGVpb89Mv5X');
}
catch (PDOException $e) {
  echo "Erreur : ".$e->getMessage()."<br/>";
  die();
}
?>
