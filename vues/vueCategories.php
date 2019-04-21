<?php if ($categories != null) : ?>
    <p><h1> Produits par catégories </h1></p>

    <div class='row'>
        <?php foreach ($categories as $category): ?>
            <div class='col-sm-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h5 class='card-title'> <?php echo $category['nomCategorie'] ?></h5>
                        <p> Produits: <?php echo $category['nbProduits'] ?></p>
                        <a href='index.php?p=produits&idCategorie=<?php echo $category['idCategorie'] ?>'
                           class='btn btn-primary'>Voir produits</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
<?php endif; ?>
