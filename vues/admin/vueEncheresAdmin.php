<p>
<h1>Administer les enchères</h1>
<?php  if (isset($_SESSION['msgErreur'])):?>
<div class="alert-danger"><?php  echo ($_SESSION['msgErreur']); unset($_SESSION['msgErreur']);?></div>
<?php endif;?>
<?php  if (isset($_SESSION['msg'])):?>
    <div class="alert-success"><?php  echo (htmlentities($_SESSION['msg'])); unset($_SESSION['msg']);?></div>
<?php endif;?>
<div class="text-right">
    <a href="index.php?p=adminEncheres&action=getVueAddEnchere" class="btn btn-success">Ajouter une enchère</a>
</div>

<?php if (isset($encheres)):?>
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">idEnchere</th>
            <th scope="col">Date de début</th>
            <th scope="col">Date de fin</th>
            <th scope="col">Coût de la mise</th>
            <th scope="col">Prix indicatif</th>
            <th scope="col">Fiche Produit</th>
            <th scope="col">Action</th>

        </tr>
        </thead>
        <?php foreach ($encheres as $enchere): ?>
            <tr>
                <th scope="row"><?php echo ($enchere->idEnchere)?></th>
                <th scope="row"><?php echo ($enchere->dateDebut)?></th>
                <th scope="row"><?php echo ($enchere->dateFin)?></th>
                <th scope="row"><?php echo ($enchere->coutMise)?></th>
                <th scope="row"><?php echo ($enchere->prixIndicatif)?></th>
                <td><?php if ($enchere->idProduit):?>
                    <a href="index.php?p=produit&idProduit=<?php echo $enchere->idProduit?>"><?php echo htmlentities($enchere->idProduit) ?></a>
               <?php else : echo  "produit supprimé" ; ?>
                <?php endif; ?></td>
                <td>
                    <a href="index.php?p=adminEncheres&action=getVueEdit&idEnchere=<?php echo $enchere->idEnchere ?>" class="btn btn-primary">Editer</a>
                    <form class="d-inline" method="POST"
                          action="index.php?p=adminEncheres&action=deleteEnchere&idEnchere=<?php echo $enchere->idEnchere ?>"
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



