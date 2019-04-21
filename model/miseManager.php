<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 27/02/2019
 * Time: 10:43
 */

class miseManager
{
    public  static  function insererUneMise($data){

        $bdd = Bdd::getPDO()->prepare('insert into mise values(:idMise, :montantMise, :login, :idEnchere, :dateMise)' );
        $bdd->execute($data);

    }

    /**
     * Renvoie les mises associé à une enchère et un login donné
     * @param $idEnchere
     * @param $login
     * @return array
     */
    public static function miseExiste($idEnchere,$login){
        $bdd = Bdd::getPDO()->prepare('select * from mise where idEnchere = :idEnchere AND  login = :login' );
        $bdd->bindParam('idEnchere',$idEnchere);
        $bdd->bindParam('login',$login);
        $bdd->execute();
        $res = $bdd->fetchAll();
        return $res;

    }

    /**
     * Renvoie les mises pour une enchere donné
     * @param $idEnchere
     * @return array
     */
    public  static  function misesPourUneEnchere($idEnchere){
        $bdd = Bdd::getPDO()->prepare('select * from mise where idEnchere = :idEnchere ' );
        $bdd->bindParam('idEnchere',$idEnchere);
        $bdd->execute();
        $res = $bdd->fetchAll();
        return $res;
    }

}