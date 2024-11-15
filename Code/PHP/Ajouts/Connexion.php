<?php require_once("../include/verif_session.php")?>

<!-- partie html & head -->
<?php require_once("../include/head.php"); ?>

<!-- partie body -->
<?php require_once("../include/header.php"); ?>

<head>
    <meta charset="utf-8">
    <link href="Connexion.css" rel="stylesheet">
</head>      
  <p class="title">CONNEXION</p>
  <form action="../index.php">
        <div class="form_group">
            <label class="sub_title" for="email">Email</label>
            <input placeholder="Entrez votre e-mail" id="email" class="form_style" type="email">
        </div>
        <div class="form_group">
            <label class="sub_title" for="password">Password</label>
            <input placeholder="Entrez votre mot de passe" id="password" class="form_style" type="password">
        </div>
        <div>
            <button class="btn">CONNEXION</button>
            <center><p>Vous souhaitez creer un compte ? <a class="link" href="Inscription.php">Inscrivez-vous ici !</a></p></center>
        </div>
  </form>