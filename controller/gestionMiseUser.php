<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 04/02/2019
 * Time: 19:15
 */
if(!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user']) ){
    require  C_ROOT . '/model/produitManager.php';
    require  C_ROOT . '/model/enchereManager.php';
    require  C_ROOT . '/model/VuesStatusManager.php';
    require  C_ROOT . '/model/Mise.php';
    require  C_ROOT . '/model/Bdd.php';

    $userMises = array();
    $mises = produitManager::getMisesByUser($_SESSION['user']);

    foreach ($mises as $mise){
        $idProduit= enchereManager::getEnchere($mise->idEnchere)->idProduit;
        $produit = produitManager::getProduit($idProduit);
        $enchere = enchereManager::getEnchere($mise->idEnchere);
        $statut = VuesStatusManager::getStatutMise($mise->idMise)->statut;

        $userMises[] = new Mise($mise,$enchere,$produit,$statut);

    }


    require  C_ROOT . '/vues/users/vueMisesUser.php';
}