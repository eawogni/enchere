<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 07/01/2019
 * Time: 20:11
 */


class produitManager
{

    public static function insererProduit($donnees)
    {
        $bdd = Bdd::getPDO()->prepare('insert into produit(nomProduit, description,idCategorie)
                                        values(:nomProduit,:description,:idCategorie)');
        $bdd->execute($donnees);


    }

    /**
     * Renvoie la liste de tous les produits et leurs image d'affiche
     * @return array
     */
    public static function getProduits()
    {

        $bdd = Bdd::getPDO()->prepare('select * from produit natural join imageproduit where firstImagine=true');
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Renvoie la liste de tous les produits et leurs image d'affiche
     * @return array
     */
    public static function getProduitsForAdmin()
    {
        $bdd = Bdd::getPDO()->prepare('select * from produit');
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Retourneles informations sur un produit selon l'id
     * @param $idProduit
     * @return mixed
     */
    public static function getProduit($idProduit)
    {
        $bdd = Bdd::getPDO()->prepare('select * from produit where idProduit= :idProduit');
        $bdd->bindParam('idProduit', $idProduit);
        $bdd->execute();
        $res = $bdd->fetch(PDO::FETCH_OBJ);
        return $res;

    }


    /**
     * Retourne les images d'un produit
     * @param $idProduit
     * @return array
     */
    public static function getImagesProduit($idProduit)
    {
        $bdd = Bdd::getPDO()->prepare('select * from imageProduit where idProduit= :idProduit');
        $bdd->bindParam('idProduit', $idProduit);
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;

    }

    public static function updateCategorieProduit($idCategorie, $idProduit){
        $bdd = Bdd::getPDO()->prepare('update produit set idCategorie= :idCategorie where idProduit= :idProduit');
        $bdd->bindParam('idProduit', $idProduit);
        $bdd->bindParam('idCategorie', $idCategorie);
        $bdd->execute();

    }


    /**
     * Retourne la liste des produits actuellement en enchère et leursinformations
     * @return array
     */
    public static function getProduitsEnCoursEnchere()
    {
        $bdd = Bdd::getPDO()->prepare('SELECT * FROM enchere NATURAL JOIN produit left join  categorie on produit.idCategorie = categorie.idCategorie natural join imageProduit WHERE  dateFin >= now() AND firstImagine = true');
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    /**
     * Retourne la liste des produits actuellement en enchère et leursinformations
     * @return array
     */
    public static function getProduitsAenchereTerminees()
    {
        $bdd = Bdd::getPDO()->prepare('SELECT * FROM enchere NATURAL JOIN produit left join  categorie on produit.idCategorie = categorie.idCategorie natural join imageProduit WHERE  dateFin < now() AND firstImagine = true');
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Retourne la liste des produits pour une catégorie donnée
     * @return array
     */
    public static function getProduitsEnEnchereByCategorie($idCategorie)
    {
        $bdd = Bdd::getPDO()->prepare('SELECT *  From produit natural  join categorie natural join  imageproduit where idCategorie = :idCategorie  and firstImagine=true ');
        $bdd->bindParam('idCategorie', $idCategorie);
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    public static function getIdProduitByName($nomProduit)
    {
        $bdd = Bdd::getPDO()->prepare('SELECT idProduit  From produit where nomProduit = :nomProduit   ');
        $bdd->bindParam('nomProduit', $nomProduit);
        $bdd->execute();
        $res = $bdd->fetch(PDO::FETCH_OBJ);
        return $res;
    }


    /**
     * Retourne la liste des mises(du plus rcent au moins récent) pour un utilisateur donné
     * @param $login
     * @return mixed
     */
    public static function getMisesByUser($login)
    {
        $bdd = Bdd::getPDO()->prepare('SELECT * FROM mise where login = :login order by dateMise desc');
        $bdd->bindParam('login', $login);
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;


    }

    public static function updateProduit($donnees)
    {
        $bdd = Bdd::getPDO()->prepare('update  produit set nomProduit = :nomProduit, description = :description where idProduit = :idProduit');
        $bdd->execute($donnees);
        $nb = $bdd->rowCount();
        return $nb;
    }

    public static function deleteProduit($idProduit)
    {
        $bdd = Bdd::getPDO()->prepare('delete  from  produit where idProduit =:idProduit');
        $bdd->bindParam('idProduit', $idProduit);
        $bdd->execute();
    }

    public static function  getProduitsAvecFinEnchere(){
        $bdd = Bdd::getPDO()->prepare('SELECT * FROM enchere NATURAL JOIN produit left join  categorie on produit.idCategorie = categorie.idCategorie natural join imageProduit WHERE  dateFin < now() AND firstImagine = true');
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    public static function  getProdAvecFinEnchere($idProduit){
        $bdd = Bdd::getPDO()->prepare('SELECT * FROM enchere NATURAL JOIN produit left join  categorie on produit.idCategorie = categorie.idCategorie natural join imageProduit WHERE  dateFin < now() AND firstImagine = true AND idProduit = :idProduit');
       $bdd->bindParam('idProduit',$idProduit);
        $bdd->execute();
        $res = $bdd->fetch(PDO::FETCH_OBJ);
        return $res;
    }

}