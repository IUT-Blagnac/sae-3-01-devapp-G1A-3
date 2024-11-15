<?php require_once("./include/verif_session.php")?>

<!-- partie html & head -->
<?php require_once("./include/head.php"); ?>

<!-- partie body -->
<?php require_once("./include/header.php"); ?>

<!-- Conteneur principal -->
<div class="container-fluid flex-grow-1">
    <div class="row">

        <!-- partie menu -->
        <?php require_once("./include/menu.php"); ?>

        <!-- partie contenu principal -->
        <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-4">
            <form method='POST' action="AjoutCategorie.php">
                <div class="form-group">
                    <label>ID Categorie</label>
                    <input type="text" name="idCateg" value="700">
                </div>
                <div class="form-group">
                    <label>Nom de la categorie</label>
                    <input type="text" name="nomCateg" value="Batterie a cochon">
                </div>
                <input type="submit" value="Valider">
                <?php
                    $motif_id = "#^[4-9]{1}[0]{2}$#";
                    $motif_nom = "#[a-z ]{3,25}#i";

                    if (isset($_POST["idCateg"]) and isset($_POST["nomCateg"])){
                        if (!empty($_POST["idCateg"]) and !empty($_POST["nomCateg"])){
                            if (preg_match($motif_id, $_POST["idCateg"]) and preg_match($motif_nom, $_POST["nomCateg"])){
                                require_once('connect.inc.php');
                                $result = $conn -> prepare ("INSERT INTO Categories VALUES (?,?)");
                                $result -> execute(array(htmlentities($_POST["idCateg"]), htmlentities($_POST["nomCateg"])));
                                header("Location: http://193.54.227.208/~R2024PHP2009/PHP/SAE/consultCateg.php");
                                exit();
                            }
                            else{
                                echo "L'une des valeurs saisies n'a pas le bon format (id avec valeur 400, 500, 600, 700, 800, 900) (nom avec entre 3 et 25 caractères sans accent)";
                            }
                        }
                        else{
                            echo "Une des valeurs n'a pas été saisie";
                        } 
                    }
                ?>
            </form>
		</main>
	</div>
</div>

<!-- Pied de page & fin html -->
<?php require_once("./include/footer.php"); ?>