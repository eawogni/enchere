<p>
<h1>Administer les catégories de produits</h1>
<?php if (isset($_SESSION['msgErreur'])): ?>
    <div class="alert-danger"><?php echo($_SESSION['msgErreur']);
        unset($_SESSION['msgErreur']); ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['msg'])): ?>
    <div class="alert-success"><?php echo(htmlentities($_SESSION['msg']));
        unset($_SESSION['msg']); ?></div>
<?php endif; ?>
<div class="text-right">
    <a href="index.php?p=adminCategorie&action=getVueAddCategorie" class="btn btn-success">Ajouter une catégorie</a>
</div>

<?php if (isset($categories)): ?>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">idCategorie</th>
            <th scope="col">nom</th>
            <th scope="col">Action</th>

        </tr>
        </thead>
        <?php foreach ($categories as $categorie): ?>
            <tr>
                <th scope="row"><?php echo($categorie->idCategorie) ?></th>
                <td>
                    <a href="index.php?p=produits&idCategorie=<?php echo $categorie->idCategorie ?>"><?php echo htmlentities($categorie->nomCategorie) ?></a>
                </td>

                <td>

                    <a href="index.php?p=adminCategorie&action=getVueEdit&idCategorie=<?php echo $categorie->idCategorie ?>"
                       class="btn btn-primary">Editer</a>

                    <form class="d-inline" method="POST"
                          action="index.php?p=adminCategorie&action=deleteCategorie&idCategorie=<?php echo $categorie->idCategorie ?>"
                          onsubmit="return confirm('Etes vous sûr?')">
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif ?>


</p>





