<p>
<h1>Administer les Produits</h1>
<?php if (isset($_SESSION['msgErreur'])): ?>
    <div class="alert-danger"><?php echo(htmlentities($_SESSION['msgErreur']));
        unset($_SESSION['msgErreur']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['msg'])): ?>
    <div class="alert-success"><?php echo(htmlentities($_SESSION['msg']));
        unset($_SESSION['msg']); ?></div>
<?php endif; ?>
<div class="text-right">
    <a href="index.php?p=adminProduits&action=getVueAddProduit" class="btn btn-success">Ajouter un produit</a>
</div>

<?php if (isset($produits)): ?>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">id</th>
            <th scope="col">nom</th>
            <th scope="col">Action</th>


        </tr>
        </thead>
        <?php foreach ($produits as $produit): ?>
            <tr>
                <th scope="row"><?php echo($produit->idProduit) ?></th>
                <td>
                    <a href="index.php?p=produit&idProduit=<?php echo $produit->idProduit ?>"><?php echo $produit->nomProduit ?>
                </td>
                <td>
                    <a href="index.php?p=adminProduits&action=getVueEdit&idProduit=<?php echo $produit->idProduit ?>"
                       class="btn btn-primary">Editer</a>
                    <form class="d-inline" method="POST"
                          action="index.php?p=adminProduits&action=deleteProduit&idProduit=<?php echo $produit->idProduit ?>"
                          onsubmit="return confirm('Etes vous sûr?')">
                        <button class="btn btn-danger">Supprimer</button>
                    </form>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>


</p>



