<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 07/02/2019
 * Time: 11:12
 */

class utilisateurManager
{

    public static  function ajouterUtilisateur($donneesUser){
        $bdd = Bdd::getPDO()->prepare('insert into utilisateur values (:login , :nom , :prenom , :dateNaissance, :m2p, :mail , :estAdmin, :solde)');
        $bdd->execute($donneesUser);

    }

    public static function authentification($data)
    {
        $req = Bdd::getPDO()->prepare('select * from utilisateur where login = :login ');
        $req->bindParam('login', $data['login']);
        $req->execute();
        $res = $req->fetch(PDO::FETCH_OBJ);
        if ($res != null) {

            if (password_verify($data['m2p'], $res->m2p)) {
                return true;
            }
            return false;

        }
    }

    public static  function getSoldeUser($login){
        $req = Bdd::getPDO()->prepare('select solde from utilisateur where login = :login ');
        $req->bindParam('login', $login);
        $req->execute();
        $res = $req->fetch(5);
        return $res;

    }

    /**
     * Permet de modifir le solde d'un utilisateur
     * @param $login
     * @param $nouveausolde
     */
    public static  function updateSoldeUser($login,$nouveausolde){
        $req = Bdd::getPDO()->prepare('UPDATE   utilisateur set  solde= :nouveauSolde where login = :login ');
        $req->bindParam('login', $login);
        $req->bindParam('nouveauSolde', $nouveausolde);
        $req->execute();

    }

    public static function getInfosUser($login){
        $req = Bdd::getPDO()->prepare('select * from   utilisateur where login = :login ');
        $req->bindParam('login', $login);
        $req->execute();
        $res = $req->fetch(5);
        return $res;
    }
    public static function updateInfosPersoUser($data){
        $req = Bdd::getPDO()->prepare('update  utilisateur set nom = :nom , prenom = :prenom , mail = :mail where login = :login ');
        $req->execute($data);
    }
    public static function updateM2pUser($data){
        $req = Bdd::getPDO()->prepare('update  utilisateur set m2p = :m2p where login = :login ');
        $req->execute($data);
    }
}