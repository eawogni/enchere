<?php if ($userMises!= null): ?>
<h1> Mes mises </h1>

<table class="table table-striped table-dark"">
    <thead class="thead-dark">
        <tr>
            <th class="tdCentre"  scope="col">Date</th>
            <th class="tdCentre" scope="col">Produit</th>
            <th class="tdCentre"  scope="col">Montant misé</th>
            <th class="tdCentre" scope="col">Statut</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($userMises as $mise) :?>

        <tr>
            <td class="tdCentre"> <?php echo $mise->getDateMise() ?> </td>
            <td class="tdCentre">  <?php echo $mise->getIdProduit()!= null ?  "<a href= 'index.php?p=produit&idProduit={$mise->getIdProduit()}'> {$mise->getNomProduit()}</a>": "<div class='text-info'>Produit indisponible</div> " ?> </td>
            <td class="tdCentre">  <?php echo $mise->getMontantMise() ?> </td>
            <td class="tdCentre">
                <?php
               switch ($mise->getStatut()){
                   case 'Gagnante' : echo "<span title='Gagnante' class='btn btn-success'></span>"; break;
                   case 'Unique' : echo "<span title='Unique'  class='btn btn-primary'></span>"; break;
                   case 'Perdante' : echo "<span title='Perdante'  class='btn btn-danger'></span>"; break;
               }
                ?>
            </td>
        </tr>
    <?php endforeach ;?>
    </tbody>
</table>

<?php endif; ?>