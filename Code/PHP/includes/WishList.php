<!-- Liste de souhaits -->
<div class="container my-5">
        <h1 class="fw-bold text-danger" id="liste_souhaits">Liste de souhaits</h1>
        <div id="wishlistCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                
			<?php 
				require_once 'connect.inc.php';
				$getWishList = $conn -> prepare('CALL get_panier(?)');
				$getWishList -> execute([$_SESSION["idCompte"]]);
				$wishList = $getWishList -> fetch();
				$getWishList -> closeCursor();
				$wishlistitems = $conn -> prepare('CALL get_commande_details(?)');
				$wishlistitems -> execute([$wishList["IDCOMMANDE"]]);
				$cpt = 1;
				$firstRoll = true;
				foreach($wishlistitems as $item){
					if($cpt==1){
						if($firstRoll = true){
							echo'<div class="carousel-item active">';
						}else{
							echo '<div class="carousel-item">';
						}
						echo '<div class="row">';
						$cpt=$cpt+1;
					}
					echo '<div class="col-md-3">
							<div class="card">
								<a href="detailProd.php?idProduit='.$item["IDPROD"].'"><img src="./images/produits/image'.$item["IDPROD"].'.jpeg" class="card-img-top" alt="'.$item["NOMPROD"].'"></a>
							</div>
						</div>';
					if($cpt==4){
						echo '</div>';
						echo '</div>';
						$cpt=1;
					}
				}
				if($cpt!=1){
						echo '</div>';
						echo '</div>';
				}
			?>
			</div>
            <button class="carousel-control-prev" type="button" data-bs-target="#wishlistCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#wishlistCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>