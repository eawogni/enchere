<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 28/03/2019
 * Time: 03:03
 */
require C_ROOT . "/model/Bdd.php";

$requete = " select * from produit natural join categorie natural join imageproduit where  ";
$donnees = array();
$concatene = false;
$resultatRecherche=null;
$_POST['nomProduit'] = trim($_POST['nomProduit']);
$_POST['categorieProduit'] = trim($_POST['categorieProduit']);

if (!empty($_POST['nomProduit'])) {
    $requete = $requete . " nomProduit like :nomProduit ";
    $concatene = true;

}

if (!empty($_POST['categorieProduit'])) {
    $requete = $concatene ? $requete . " AND nomCategorie like :nomCategorie" : $requete . " nomCategorie like :nomCategorie ";
    $concatene = true;
}
$requete = $concatene?  $requete  . " And firstImagine = true ": null;

$bdd = Bdd::getPDO()->prepare($requete);
if (!empty($_POST['nomProduit'])) {
    $nomProd = "%" . $_POST['nomProduit'] . "%";
    $bdd->bindParam('nomProduit', $nomProd);
}
if (!empty($_POST['categorieProduit'])) {
    $nomCateg= "%" . $_POST['categorieProduit'] . "%";
    $bdd->bindParam('nomCategorie', $nomCateg);
}
if ($requete !=null){
    $bdd->execute();
    $resultatRecherche = $bdd->fetchAll(5);
}
if($resultatRecherche==null){
    $msgRecherche=true;
}


require C_ROOT ."/vues/vueRecherche.php";
