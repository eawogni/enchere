<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 07/01/2019
 * Time: 21:54
 */

require C_ROOT . '/model/produitManager.php';
require C_ROOT . '/model/Bdd.php';
require C_ROOT .'/model/Produit.php';
require C_ROOT . '/model/CategorieManager.php';
require C_ROOT . '/model/ImagesProduitManager.php';
require C_ROOT . '/model/enchereManager.php';


if (isset($_GET['idProduit'])) {

    $prod = produitManager::getProduit($_GET['idProduit']);
    $produit =  $prod ? new Produit($prod) : null;
    require C_ROOT . '/vues/vueProd.php';

} else {
    require C_ROOT . '/vues/page404.php';
}