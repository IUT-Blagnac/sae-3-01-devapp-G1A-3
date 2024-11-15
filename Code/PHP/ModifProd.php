<?php require_once("./include/verif_session.php")?>

<!-- partie html & head -->
<?php require_once("./include/head.php"); ?>

<!-- partie body -->
<?php require_once("./include/header.php"); ?>

<!-- Conteneur principal -->
<div class="container-fluid flex-grow-1">
    <div class="row">

        <!-- partie menu -->
        <?php require_once("./include/menu.php"); 
        require_once('connect.inc.php');?>

        <!-- partie contenu principal -->
        <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-4">
            <form method='GET' action="ModifProd.php".$produit['idProduit']>
                <div class="form-group">
                    <label>ID Categorie</label>
                    <input type="text" name="idCateg" value=<?php $result1 = $conn -> prepare ("SELECT idCategorie FROM Produits WHERE idProduit = ?");
                                                                        $result1 -> execute(array($_GET['idProduit']));
                                                                        foreach($result1 as $test){
                                                                          echo $test['idCategorie'];
                                                                        }?>>
                </div>
                <div class="form-group">
                    <label>ID du produit</label>
                    <input type="text" name="idProduit" value=<?php $result1 = $conn -> prepare ("SELECT idProduit FROM Produits WHERE idProduit = ?");
                                                                        $result1 -> execute(array($_GET['idProduit']));
                                                                        foreach($result1 as $test){
                                                                          echo $test['idProduit'];
                                                                        }?> readonly>
                </div>
                <div class="form-group">
                    <label>Nom du produit</label>
                    <input type="text" name="nomProduit" value=<?php $result1 = $conn -> prepare ("SELECT nomProduit FROM Produits WHERE idProduit = ?");
                                                                        $result1 -> execute(array($_GET['idProduit']));
                                                                        foreach($result1 as $test){
                                                                          echo $test['nomProduit'];
                                                                        }?>>
                </div>
                <div class="form-group">
                    <label>Prix du produit</label>
                    <input type="text" name="prixProduit" value=<?php $result1 = $conn -> prepare ("SELECT prixProduit FROM Produits WHERE idProduit = ?");
                                                                        $result1 -> execute(array($_GET['idProduit']));
                                                                        foreach($result1 as $test){
                                                                          echo $test['prixProduit'];
                                                                        }?>>
                </div>
                <div class="form-group">
                    <label>Image du produit</label>
                    <br>
                    <?php
                      echo "<a><img src=\"./images/prod".$_GET['idProduit'].".jpg\" width=30% alt=\"Img du bien\" /></a>";
                    ?>
                    <p></p>
                    <input type="file" name="monfichier"/><br>
                </div>
                <input type="submit" value="Valider">
                <?php
                    require_once("./connect.inc.php");
                    $motif_id = "#^[0-9]{3}$#";
                    $motif_nom = "#[a-z ]{3,25}#i";

                    if (isset($_GET["idCateg"]) and isset($_GET["idProduit"]) and isset($_GET["nomProduit"]) and isset($_GET["prixProduit"])){
                        if (!empty($_GET["idCateg"]) and !empty($_GET["idProduit"]) and !empty($_GET["nomProduit"]) and !empty($_GET["prixProduit"])){
                                require_once('connect.inc.php');
                                $result2 = $conn -> prepare ("UPDATE Produits SET idCategorie = ?, nomProduit = ?, prixProduit = ? WHERE idProduit = ?");
                                $result2 -> execute(array(htmlentities($_GET["idCateg"]), htmlentities($_GET["nomProduit"]), htmlentities($_GET["prixProduit"]), htmlentities($_GET["idProduit"])));
                                header("Location: http://193.54.227.208/~R2024PHP2009/PHP/SAE/index.php");
                                exit();
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