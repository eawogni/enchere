<?php if ($produits != null) : ?>
    <h1> Produits en cours d'enchère </h1>

    <?php foreach ($produits as $prod): ?>
        <div class="row">
            <div class="col-12">
                <div class="card mx-auto bg-dark text-white" " style="width: 60%;"
                ">
                <div class="card-header">
                    <h3 class="card-title "><a
                                href="index.php?p=produit&idProduit=<?php echo $prod->idProduit ?>"> <?php echo $prod->nomProduit ?></a>
                    </h3>
                </div>

                <img src='images/<?php echo $prod->pathImage ?>' class='card-img-top' alt=""
                     style="width:20%; height:auto"/>

                <div class="card-body">
                    <p class="card-text">
                        <?php echo "$prod->description" ?>
                    </p>
                    <strong>Catégorie:</strong>
                    <?php echo $prod->nomCategorie; ?> <br>
                    <strong>Début enchère :</strong>
                    <?php echo date_format(date_create($prod->dateDebut), 'd/m/Y'); ?> <br>
                    <strong> Fin enchère :</strong>
                    <?php echo date_format(date_create($prod->dateFin), 'd/m/Y'); ?> <br>
                    <strong>Coût mise :</strong>
                    <?php echo $prod->coutMise ?> <br>
                    <strong>Prix actuel :</strong>
                    <?php echo $prod->prixIndicatif . " €" ?> <br>
                    <?php echo "<a href='index.php?p=encherir&idProduit=" . $prod->idProduit .  "' class='btn btn-primary'>Enchérir </a>" ; ?>


                </div>
            </div>

        </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="alert-danger"> Aucun produit trouvé</div>
    <?php ?>
<?php endif; ?>











