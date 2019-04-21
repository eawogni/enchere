<?php if (($produit != null)): ?>
    <h1> <?php echo $produit->getProduit()->nomProduit ?></h1>
    <p>
        <?php

        foreach ($produit->getImages() as $image):?>

            <?php echo "<img src='images/{$image->pathImage} ' height='250' width='250'  class=\"rounded \" />" ?>

        <?php endforeach; ?>
    </p>
    <div>
        <?php echo $produit->getProduit()->description ?><br>
        <?php if ($produit->getCategorie()): ?>
            <strong>Catégorie :</strong>
            <?php echo $produit->getCategorie()->nomCategorie ?>
        <?php endif; ?>
    </div>

    <div>
        <?php if ($encheres = $produit->getAllEnchere()) : ?>
            <strong>Enchères</strong>
            <table class="table table-hover">
                <thead class="thead-light">
                <tr class="text-center">
                    <th scope="col">Début enchère</th>
                    <th scope="col">Fin enchère</th>
                    <th scope="col">Coût mise</th>
                    <th scope="col">Prix</th>
                    <th scope="col">En cours / Terminée</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($encheres as $enchere) : ?>
                    <tr class="text-center">
                        <td><?php echo date_format(date_create($enchere->dateDebut), 'd/m/Y') ?></td>
                        <td><?php echo date_format(date_create($enchere->dateFin), 'd/m/Y') ?></td>
                        <td><?php echo $enchere->coutMise ?></td>
                        <td><?php echo $enchere->prixIndicatif . " €" ?></td>
                        <td style="text-align: center" colspan="2">
                            <?php
                            $now = new DateTime("now");
                            $dateFin = new DateTime($enchere->dateFin);
                            if ($dateFin > $now) {
                                echo "<a href='index.php?p=encherir&idProduit=" . $enchere->idProduit . "' class='btn btn-primary'>Enchérir </a>";
                            }else{
                                echo "Terminé";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
<?php else : ?>

    <div class="alert-danger"> Ce produit n'existe pas</div>


<?php endif ?>





