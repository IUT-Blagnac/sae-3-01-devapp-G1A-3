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
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>ID Categorie</label>
                    <input type="text" name="idCateg" value="100">
                </div>
                <div class="form-group">
                    <label>ID du produit</label>
                    <input type="text" name="idProduit" value="221">
                </div>
                <div class="form-group">
                    <label>Nom du produit</label>
                    <input type="text" name="nomProduit" value="Batterie a cochon">
                </div>
                <div class="form-group">
                    <label>Prix du produit</label>
                    <input type="text" name="prixProduit" value="28">
                </div>
                <div class="form-group">
                    <label>Image du produit</label>
                    <input type="file" name="monfichier" /><br>
                </div>
                <input type="submit" value="Valider">
                <?php
                    require_once("./connect.inc.php");
                    $motif_id = "#^[0-9]{3}$#";
                    $motif_nom = "#[a-z ]{3,25}#i";

                    if (isset($_POST["idCateg"]) and isset($_POST["idProduit"]) and isset($_POST["nomProduit"]) and isset($_POST["prixProduit"])){
                        if (!empty($_POST["idCateg"]) and !empty($_POST["idProduit"]) and !empty($_POST["nomProduit"]) and !empty($_POST["prixProduit"])){
                                require_once('connect.inc.php');
                                $result = $conn -> prepare ("INSERT INTO Produits VALUES (?,?,?,?)");
                                $result -> execute(array(htmlentities($_POST["idProduit"]), htmlentities($_POST["idCateg"]), htmlentities($_POST["nomProduit"]), htmlentities($_POST["prixProduit"])));
                        }
                    }
                    if (!empty($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0) {
                        // Testons si l'extension est autorisée
                        $infosfichier = pathinfo($_FILES['monfichier']['name']);
                        $extension_upload = $infosfichier['extension'];
                        $extensions_autorisees = array('jpg');
                        if (in_array($extension_upload, $extensions_autorisees) &&  500000 > $_FILES["monfichier"]["size"]) {
                            // On peut valider le fichier et le stocker définitivement
                            move_uploaded_file($_FILES['monfichier']['tmp_name'], 'images/prod'.$_POST["idProduit"].'.'.$extension_upload);
                            echo "L'envoi a bien ete fait ! <br>";
                        }
                        else {
                            echo "Le fichier n'est pas du bon type ou il est trop volumineux !<br>";
                        }
                    }
                ?>
            </form>
		</main>
	</div>
</div>

<!-- Pied de page & fin html -->
<?php require_once("./include/footer.php"); ?>