<p>
    <div class="row">
        <div class="col-md-6">
            <div class="card-header">
                <h3 class="card-title"><a
                            href="index.php?p=produit&idProduit=<?php echo $prod->getProduit()->idProduit ?>"> <?php echo $prod->getProduit()->nomProduit ?></a>
                </h3>
            </div>

            <img src='images/<?php echo $prod->getImageFirst()->pathImage ?>' class='card-img-top' alt=""
                 style="width:100%; height:auto"/>

            <div class="card-body">
<p class="card-text">
    <?php echo $prod->getProduit()->description ?>
</p>
<strong>Catégorie:</strong>
<?php echo $prod->getCategorie()->nomCategorie; ?> <br>
<strong>Début enchère :</strong>
<?php echo date_format(date_create($prod->getEnchere()->dateDebut), 'd/m/Y'); ?> <br>
<strong> Fin enchère :</strong>
<?php echo date_format(date_create($prod->getEnchere()->dateFin), 'd/m/Y'); ?> <br>
<strong>Coût mise :</strong>
<?php echo $prod->getEnchere()->coutMise ?> <br>
<strong>Prix actuel :</strong>
<?php echo $prod->getEnchere()->prixIndicatif . " €" ?> <br>
<?php echo "<a href='index.php?p=encherir&idProduit=" . $prod->getProduit()->idProduit . "' class='btn btn-primary'>Enchérir </a>"; ?>


</div>

</div>
<div class="col-md-6">

    <div class="mx-auto" style="width: 100%; margin-top:18%">
        <h3> Effectuer une mise</h3>
        <form method="POST" action="index.php?p=encherir&idProduit=<?php echo $prod->getProduit()->idProduit ?>">
            <div class="form-group">
                <input class="form-control" name="montantMise" type="number" step="0.01">
                <br>
                <button class="btn btn-outline-success" type="submit">Valider</button>
                <?php
                if (isset($messageErreur)): ?>
                    <div class="text-danger"> <?php echo $messageErreur ?></div>

                <?php elseif (isset($message)): ?>
                    <div class="text-success"> <?php echo $message ?></div>
                <?php endif; ?>

            </div>

        </form>
    </div>
</div>

</div>
</p>