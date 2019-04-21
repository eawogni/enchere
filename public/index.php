<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 18/12/2018
 * Time: 14:11
 */
define('C_ROOT', dirname(__DIR__));
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

if (isset($_SESSION['user']) && isset($_SESSION['admin'])) { //Administrateur
    ob_start();
    if ($p === 'home') {
        $titrePage = "Page d'accueil";
        require C_ROOT . '/vues/home.php';
    } else if ($p === 'produits') {
        $titrePage = "Produits";
        require C_ROOT . '/controller/gestionProduits.php';
    } else if ($p === 'produit') {
        $titrePage = "Produit";
        require C_ROOT . '/controller/gestionProd.php';
    } else if ($p === 'categorie') {
        $titrePage = "Catégorie";
        require C_ROOT . '/controller/gestionCategories.php';
    } else if ($p === 'deconnexion') {
        require C_ROOT . '/controller/dexonnexion.php';
    } else if ($p === 'adminCategorie') {
        $titrePage = "Administration  des catégories";
        require C_ROOT . '/controller/administrerCategorie.php';
    } else if ($p === 'adminProduits') {
        $titrePage = "Administration des produits";
        require C_ROOT . '/controller/administrerProduit.php';
    } else if ($p === 'adminEncheres') {
        $titrePage = "Administration des enchères";
        require C_ROOT . '/controller/administrerEnchere.php';
    } else if ($p === "encherir") {
        $titrePage = "Enchérir";
        require C_ROOT . '/vues/admin/vueEncherirAdmin.php';
    } else if ($p === "search") {
        $titrePage = "Recherche";
        require C_ROOT . '/vues/vueRecherche.php';
    } else if ($p === "searching") {
        $titrePage = "Recherche";
        require C_ROOT . '/controller/gestionSearch.php';
    } else {
        $titrePage = "Page 404";
        require C_ROOT . '/vues/page404.php';
    }
    $content = ob_get_clean();
    require C_ROOT . '/vues/templates/default_admin.php';

} else if (isset($_SESSION['user'])) {        //Utilisateur connecté
    ob_start();
    if ($p === 'home') {
        $titrePage = "Page d'accueil";
        require C_ROOT . '/vues/home.php';
    } else if ($p === 'misesUser') {
        $titrePage = "Mises";
        require C_ROOT . '/controller/gestionMiseUser.php';
    } else if ($p === 'produits') {
        $titrePage = "Produits";
        require C_ROOT . '/controller/gestionProduits.php';
    } else if ($p === 'compte') {
        $titrePage = "Compte";
        require C_ROOT . '/controller/gestionCompteUser.php';
    } else if ($p === 'produit') {
        $titrePage = "Produit";
        require C_ROOT . '/controller/gestionProd.php';
    } else if ($p === 'deconnexion') {
        require C_ROOT . '/controller/dexonnexion.php';
    } else if ($p === 'categorie') {
        $titrePage = "Catégorie";
        require C_ROOT . '/controller/gestionCategories.php';
    } else if ($p === "encherir") {
        $titrePage = "Enchérir";
        require C_ROOT . '/controller/gestionEncherir.php';
    } else if ($p === "recharger") {
        $titrePage = "Recharge compte";
        require C_ROOT . '/controller/gestionRechargementSolde.php';
    } else if ($p === "search") {
        $titrePage = "Recherche";
        require C_ROOT . '/vues/vueRecherche.php';
    } else if ($p === "searching") {
        $titrePage = "Recherche";
        require C_ROOT . '/controller/gestionSearch.php';
    } else {
        $titrePage = "Page 404";
        require C_ROOT . '/vues/page404.php';
    }

    $content = ob_get_clean();
    require C_ROOT . '/vues/templates/default_user.php';

} else {
    //VISITEUR SIMPLE
    ob_start();
    if ($p == 'home') {
        $titrePage = "Page d'accueil";
        require C_ROOT . '/vues/home.php';
    } else if ($p === 'produits') {
        $titrePage = "Produits";
        require C_ROOT . '/controller/gestionProduits.php';
    } else if ($p == 'produit') {
        $titrePage = "Produit";
        require C_ROOT . '/controller/gestionProd.php';
    } else if ($p === 'inscriptionUser') {
        $titrePage = "Inscription";
        require C_ROOT . '/vues/inscription.php';
    } else if ($p === 'inscrire') {
        $titrePage = "Inscription";
        require C_ROOT . '/controller/traitementInscription.php';
    } else if ($p === 'connexion') {
        $titrePage = "Connexion";
        require C_ROOT . '/controller/connexion.php';
    } else if ($p === 'categorie') {
        $titrePage = "Categorie";
        require C_ROOT . '/controller/gestionCategories.php';
    } else if ($p === "encherir") {
        $titrePage = "Encherir";
        require C_ROOT . '/vues/pageConnexion.php';
    } else if ($p === "search") {
        $titrePage = "Recherche";
        require C_ROOT . '/vues/vueRecherche.php';
    } else if ($p === "searching") {
        $titrePage = "Recherche";
        require C_ROOT . '/controller/gestionSearch.php';
    } else {
        $titrePage = "Page 404";
        require C_ROOT . '/vues/page404.php';
    }

    $content = ob_get_clean();
    require C_ROOT . '/vues/templates/default.php';


}


