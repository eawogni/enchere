<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 09/02/2019
 * Time: 11:54
 */

class VuesStatusManager
{

    public static function getStatutMise($idMise)
    {
        $bdd = Bdd::getPDO()->prepare('select statut from vue_statut_mises where idMise = :idMise');
        $bdd->bindParam('idMise', $idMise);
        $bdd->execute();
        $res = $bdd->fetch(5);
        return $res;
    }

}