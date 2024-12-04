<?php 
try{
  $connect = new PDO ('mysql:host=localhost;dbname=R2024MYSAE3008;charset=UTF8','R2024MYSAE3008','59eZ8gGwb4EgC9');
}
catch (PDOException $e) {
  echo "Erreur : ".$e->getMessage()."<br/>";
  die();
}
?>
