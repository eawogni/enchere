<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 05/03/2019
 * Time: 14:35
 */
require C_ROOT . '/model/utilisateurManager.php';
require C_ROOT . '/model/Bdd.php';

$infoUser = utilisateurManager::getInfosUser($_SESSION['user']);
$erreur = false;
if ((isset($_POST['nomUser'])) && isset($_POST['prenomUser']) && isset($_POST['emailUser'])) {

    if (!filter_var($_POST['emailUser'], FILTER_VALIDATE_EMAIL)) {
        $erreur = true;
        $msgEmail = "Email incorrect";

    }
    if (($_POST['nomUser']) === "" || ($_POST['prenomUser']) === "") {
        $erreur = true;
        $msgNomPren = "les champs nom et prénom ne peuvent être vide";
    }
    if (!$erreur) {


        $data = [
            'nom' => $_POST['nomUser'],
            'prenom' => $_POST['prenomUser'],
            'mail' => $_POST['emailUser'],
            'login' => $_SESSION['user']
        ];
        utilisateurManager::updateInfosPersoUser($data);
        $infoUser = utilisateurManager::getInfosUser($_SESSION['user']);
        $msgUpdate = "Vos informations personnelles ont bien étés mises à jour";
    }


}

if ((isset($_POST['m2pUserActuel'])) && isset($_POST['nvoM2pUser']) && isset($_POST['nvoM2pUser2'])) {
    $erreurM2p = false;
    $m2p = utilisateurManager::getInfosUser($_SESSION['user'])->m2p ;


    if (strlen($_POST['nvoM2pUser'])<8){
        $erreurM2p =true;
        $msgErrM2p = "Le nouveau mot de passe doit faire au moins 8 caractères";
    }

    if ($_POST['nvoM2pUser'] != $_POST['nvoM2pUser2']){

        $erreurM2p =true;
        $msgErrM2p = "Les deux nouveaux mot de passe saisient  ne correspondent pas";

    }
    if (!password_verify($_POST['m2pUserActuel'], $m2p)){
        $erreurM2p =true;
        $msgErrM2p = "L'ancien mot de passe saisie est incorrect";
    }


    if (!$erreurM2p){
        $data =[
            'login' => $_SESSION['user'],
            'm2p' => password_hash($_POST['nvoM2pUser'], PASSWORD_DEFAULT)
        ];
        utilisateurManager::updateM2pUser($data);
        $msgUpdate = "Votre mot de passe a bien été modifié";
    }

}
require C_ROOT . "/vues/users/vueDetailsCompteUser.php";