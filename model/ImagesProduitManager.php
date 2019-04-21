<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 14/03/2019
 * Time: 20:15
 */

class ImagesProduitManager
{
    /**
     * @param $idProduit
     * @return array
     */
    public static  function  getImagesForProduit($idProduit){
        $bdd = Bdd::getPDO()->prepare('SELECT * FROM imageproduit where idProduit = :idProduit');
        $bdd->bindParam('idProduit',$idProduit);
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }

    /***
     * @param $idProduit
     * @return mixed
     */
    public static  function  getImageFisrt($idProduit){
        $bdd = Bdd::getPDO()->prepare('SELECT pathImage FROM imageproduit where idProduit = :idProduit and firstImagine= true');
        $bdd->bindParam('idProduit',$idProduit);
        $bdd->execute();
        $res = $bdd->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    public  static  function insertImage($donnees){
        $bdd = Bdd::getPDO()->prepare('insert into imageproduit values (:idImage,:pathImage,:firstImagine,:idProduit)');
        $bdd->execute($donnees);
    }

    public static function updateImage($idProduit,$oldImageId,$newPathImage)
    {
        $bdd = Bdd::getPDO()->prepare('update imageproduit set pathImage = :newPathImage where idProduit = :idProduit AND idImage = :oldImageId');
        $bdd->bindParam('oldImageId',$oldImageId);
        $bdd->bindParam('newPathImage',$newPathImage);
        $bdd->bindParam('idProduit',$idProduit);
        $bdd->execute();
    }



}