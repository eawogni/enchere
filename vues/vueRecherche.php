<div class="mx-auto" style="width: 35%; margin-top:5% ">
    <div class="mx-auto" style="width: 80%;">
        <h1 class="mx-auto " style="width: 200px;"> Rechercher</h1>


        <form class="my-2 my-lg-0" method="POST" action="index.php?p=searching">
            <div class="form-group">
                <label for="login">Nom du produit</label>
                <input type="text" class="form-control" id="nomProduit" name="nomProduit"
                       placeholder="Entrez un nom de produit">
            </div>
            <div class="form-group">
                <label for="login">Catégorie</label>
                <input type="text" class="form-control" id="categorieProduit" name="categorieProduit"
                       placeholder="Catégorie du produit">
            </div>
            <p>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Lancer la recherche</button>
            </p>

        </form>

    </div>
</div>
<?php if (isset($msgRecherche)): ?>
    <div class="alert-danger"> Aucun résultat trouvé</div>
<?php endif; ?>
<?php if (isset($resultatRecherche) && $resultatRecherche != null): ?>
    <h3>Résultat de la recherche</h3>
    <div class="row">
        <?php foreach ($resultatRecherche as $produit): ?>
            <div class='col-sm-4'>
                <div class='card'>
                    <div class='card-body'>
                        <a href="index.php?p=produit&idProduit=<?php echo $produit->idProduit ?>"><h5 class='card-title'> <?php echo $produit->nomProduit ?></h5></a>
                        <img src='images/<?php echo $produit->pathImage ?>' class='card-img-top' alt=""
                             style="width:20%; height:auto"/><br>
                        <strong>Catégorie :</strong>  <?php echo $produit->nomCategorie ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


