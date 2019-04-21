<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 10/02/2019
 * Time: 11:43
 */

/**
 *
 * Class CategorieManager
 */
class CategorieManager
{
    public static function addCategorie($nomCategorie){
        $bdd = Bdd::getPDO()->prepare('insert into categorie values (:idCategorie, :nomCategorie)');
        $idCategorie=0;
        $bdd->bindParam('idCategorie',$idCategorie);
        $bdd->bindParam('nomCategorie',$nomCategorie);
        $bdd->execute();
    }
    /**
     * Liste les différents catégories pour lesquelles  vec le nombre de produits qui les composent
     * @return array
     */
    public static function getCategories()
    {
        $bdd = Bdd::getPDO()->prepare('SELECT idCategorie, nomCategorie, COUNT(idProduit) as nbProduits from categorie NATURAL join produit  GROUP by idCategorie ');
        $bdd->execute();
        $res = $bdd->fetchAll();
        return $res;
    }

    /**
     * Retourne la liste de toute les catégories
     * @return array
     */
    public static function getCategoriesForAdmin()
    {
        $bdd = Bdd::getPDO()->prepare('SELECT * from categorie ');
        $bdd->execute();
        $res = $bdd->fetchAll(5);
        return $res;
    }

    /**
     * Retourne une catégorie spécifique
     * @param $idCategorie
     * @return mixed
     */
    public static function getCategorie($idCategorie)
    {
        $bdd = Bdd::getPDO()->prepare('SELECT * from categorie where idCategorie = :idCategorie');
        $bdd->bindParam('idCategorie', $idCategorie);
        $bdd->execute();
        $res = $bdd->fetch(5);
        return $res;
    }

    /**
     * @param $donnees : array contenant l'idCategorie à modifier ey le nom de la catégorie pouir la modification
     * @return int
     */
    public static function updateCategorie($donnees)
    {
        $bdd = Bdd::getPDO()->prepare('update  categorie set nomCategorie = :nomCategorie where idCategorie =:idCategorie');
        $bdd->execute($donnees);
        $nbCategorieUpdate = $bdd->rowCount();
        return $nbCategorieUpdate;
    }

    public static function deleteCategorie($idCategorie)
    {
        $bdd = Bdd::getPDO()->prepare('delete  from  categorie where idCategorie =:idCategorie');
        $bdd->bindParam('idCategorie', $idCategorie);
        $bdd->execute();
    }

}