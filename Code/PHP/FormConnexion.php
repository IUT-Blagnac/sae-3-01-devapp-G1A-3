<?php
    $login = "";

    if(isset($_COOKIE["CLamotheRaphael"])){
        $login = htmlentities($_COOKIE["CLamotheRaphael"]);
    }
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Formulaire de connexion</title>
</head>
<body>
	<form method='POST' action="TraitConnexion.php">
		<div class="form-group">
            <label>Login</label>
            <input type="text" name="login" placeholder="Entrez votre login" value="<?php echo $login; ?>">
        </div>
		<div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="mdp" placeholder="Entrez votre mot de passe">
        </div>
        <div class="form-group">
            <label>Se Souvenir de moi</label>
            <input type="checkbox" name="remember">
        </div>
		<input type="submit" value="Valider">
	</form>
</body>
</html>