<?php if ($produits != null) : ?>
    <h1> Nos produits pour la catégorie <?php echo htmlentities($produits[0]->nomCategorie) ?> </h1>
    <p style="text-align: right"><a href="index.php?p=produits&type=enCours">Afficher tous les produits en cours
            d'enchère actuellement</a></p>

    <?php foreach ($produits as $prod): ?>
        <div class="row">
            <div class="col-12">
                <div class="card mx-auto bg-dark text-white" style="width: 60%;"
                ">
                <div class="card-header">
                    <h3 class="card-title"><a
                                href="index.php?p=produit&idProduit=<?php echo $prod->idProduit ?>"> <?php echo $prod->nomProduit ?></a>
                    </h3>
                </div>

                <img src='images/<?php echo $prod->pathImage ?>' class='card-img-top' alt=""
                     style="width:20%; height:auto"/>

                <div class="card-body">
                    <p class="card-text">
                        <?php echo htmlentities($prod->description) ?>
                    </p>

                </div>
            </div>

        </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="alert-danger"> Aucun produit trouvé</div>
    <?php ?>
<?php endif; ?>











