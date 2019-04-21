<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 04/02/2019
 * Time: 19:36
 */

class enchereManager
{
    /**
     * Retourne une enchere selon un  idEnchere
     * @param $idEnchere
     * @return
     */
    public static function getEnchere($idEnchere){
        $bdd = Bdd::getPDO()->prepare('SELECT * FROM enchere where idEnchere = :idEnchere');
        $bdd->bindParam('idEnchere',$idEnchere);
        $bdd->execute();
        $res = $bdd->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Retourne une enchere en cours du produit
     * @param $idProduit
     * @return mixed
     */
    public static  function  getEnchereForProoduit($idProduit){
        $bdd = Bdd::getPDO()->prepare('SELECT * FROM enchere where idProduit = :idProduit  and dateFin >= now() ');
        $bdd->bindParam('idProduit',$idProduit);
        $bdd->execute();
        $res = $bdd->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * @param $idProduit
     * @return array
     */
    public static  function  getAllEnchereForProduit($idProduit){
        $bdd = Bdd::getPDO()->prepare('SELECT * FROM enchere where idProduit = :idProduit order by dateDebut DESC  ');
        $bdd->bindParam('idProduit',$idProduit);
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;
    }
    public static  function  getNbreMiseEnchere($idEnchere){
        $bdd = Bdd::getPDO()->prepare('SELECT count(idEnchere) FROM mise where idEnchere = :idEnchere  ');
        $bdd->bindParam('idEnchere',$idEnchere);
        $bdd->execute();
        $res = $bdd->fetch(PDO::FETCH_OBJ);
        return $res;
    }

    /**
     * Retourne la liste des encheres
     * @return mixed
     */
    public  static function getEncheres(){
        $bdd = Bdd::getPDO()->prepare('SELECT * FROM enchere');
        $bdd->execute();
        $res = $bdd->fetchAll(PDO::FETCH_OBJ);
        return $res;

}


    public static function updateEnchere($donnees)
    {
        $bdd = Bdd::getPDO()->prepare('update  enchere set dateDebut = :dateDebut, dateFin = :dateFin, coutMise= :coutMise, prixIndicatif = :prixIndicatif where idEnchere = :idEnchere');
        $bdd->execute($donnees);
        $nb = $bdd->rowCount();
        return $nb;
    }

    public static function addEnchere($donnees){
        $bdd= Bdd::getPDO()->prepare('insert into enchere values(:idEnchere,:dateDebut, :dateFin, :coutMise, :prixIndicatif, :idProduit)');
        $bdd->execute($donnees);
    }

    public static function deleteEnchere($idEnchere)
    {
        $bdd = Bdd::getPDO()->prepare('delete  from  enchere where idEnchere =:idEnchere');
        $bdd->bindParam('idEnchere', $idEnchere);
        $bdd->execute();
    }

    public static function updateProduitEnchere($idProduitEnchere, $idEnchere )
    {
        $bdd = Bdd::getPDO()->prepare('update  enchere set idProduit = :idProduit where idEnchere = :idEnchere');
        $bdd->bindParam('idProduit',$idProduitEnchere);
        $bdd->bindParam('idEnchere',$idEnchere);
        $bdd->execute();

    }


}