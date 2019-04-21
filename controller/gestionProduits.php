<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 07/01/2019
 * Time: 20:31
 */

require C_ROOT . '/model/produitManager.php';
require C_ROOT . '/model/Bdd.php';
require C_ROOT . '/model/CategorieManager.php';
require C_ROOT . '/model/ImagesProduitManager.php';
require C_ROOT . '/model/enchereManager.php';

if (isset($_GET['idCategorie'])) {

    $produits =produitManager::getProduitsEnEnchereByCategorie($_GET['idCategorie']);
    $page= C_ROOT . '/vues/vueProduitParCategorie.php';

} else if ((isset($_GET['type'])) && ($_GET['type'] === 'enCours')) {

    $produits = produitManager::getProduitsEnCoursEnchere();
    $page =$page= C_ROOT . '/vues/vueProduitsEnEnchere.php';


} else{
    $produits = produitManager::getProduits();
    $page= C_ROOT . '/vues/vueProduits.php';
}


require $page ;


?>

