

<?php
require_once(../connect.inc.php);

function accessProduits(){
	$PDOReq = $connect -> prepare('SELECT * FROM PRODUIT');
	$PDOReq -> execute();
	return $PDOReq -> fetchAll();
}

function accessProduitPrix($idProduit){
		$PDOReq = -> $connect -> prepare('SELECT * FROM DISPOFORMAT WHERE idProduit = ?');
		$PDOReq -> execute([$idProduit]);
		return $PDOReq -> fetchAll();
}

function accessProduitsId($ID){
	$PDOReq = $connect -> prepare('SELECT * FROM PRODUIT WHERE idProduit = ?');
	$PDOReq -> execute([$ID]);
	return $PDOReq -> fetchAll();
}



function accessImagesLinks($prodId){
	$PDOReq = $connect -> prepare('SELECT nomFichier FROM IMAGE WHERE idProduit = ?');
	$PDOReq -> execute ([$ID]);
	return $PDOReq -> fetchAll();
}

function accessCategories(){
	$PDOReq = $connect -> prepare('SELECT * FROM CATEGORIE');
	$PDOReq -> execute();
	return $PDOReq -> fetchAll();
}

function accessFormats(){
	$PDOReq = $connect -> prepare('SELECT * FROM FORMAT');
	$PDOReq -> execute();
	return $PDOReq -> fetchAll();
}

function accessCouleurs(){
	$PDOReq = $connect -> prepare('SELECT * FROM COULEUR');
	$PDOReq -> execute();
	return $PDOReq -> fetchAll();
}

function accessConditionnements(){
	$PDOReq = $connect -> prepare('SELECT * FROM CONDITIONNEMENT');
	$PDOReq -> execute();
	return $PDOReq -> fetchAll();
}
?>