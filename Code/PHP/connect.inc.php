<?php
try {
  $user = 'R2024MYSAE3008';
  $pass = '59eZ8gGwb4EgC9';
  $conn = new PDO(
    'mysql:host=localhost;dbname=R2024MYSAE3008;charset=UTF8',
    $user,
    $pass,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
} catch (PDOException $e) {
  echo "Erreur: " . $e->getMessage() . "<br>";
  die();
}
?>
