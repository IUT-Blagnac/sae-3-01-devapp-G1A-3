<!-- Liste de souhaits -->
<div class="container my-5">
        <h1 class="fw-bold text-danger">Liste de souhaits</h1>
        <div id="wishlistCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=1" class="card-img-top" alt="Catégorie 1"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=2" class="card-img-top" alt="Catégorie 2"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=3" class="card-img-top" alt="Catégorie 3"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=4" class="card-img-top" alt="Catégorie 4"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=5" class="card-img-top" alt="Catégorie 5"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=6" class="card-img-top" alt="Catégorie 6"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=7" class="card-img-top" alt="Catégorie 7"></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <a href=""><img src="http://placehold.it/380?text=8" class="card-img-top" alt="Catégorie 8"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php 
				require_once 'connect.inc.php';
				$getWishList = $conn -> prepare('CALL get_panier(?)');
				$getWishList -> execute([$_SESSION["idCompte"]]);
				$wishList = $getWishList -> fetch();
				$getWishList -> closeCursor();
				$wishlistitems = $conn -> prepare('CALL get_commande_details(?)');
				$wishlistitems -> execute([$wishList["IDCOMMANDE"]]);
				$cpt = 1;
				foreach($wishlistitems as $item){
					if(cpt==1){
						echo '<div class="carousel-item">';
						echo '<div class="row">';
					}
					echo '<div class="col-md-3">
							<div class="card">
								<a href="detailProd.php?idProduit='.$item["IDPROD"].'"><img src="./images/produits/image'.$item["IDPROD"].'.jpeg" class="card-img-top" alt="'.$item["NOMPROD"]."></a>
							</div>
						</div>';
				}
			?>
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