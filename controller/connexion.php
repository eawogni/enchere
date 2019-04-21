<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 08/02/2019
 * Time: 14:48
 */


if (isset ($_POST['log']) && $_POST['m2p'] ){
    require C_ROOT.'/model/utilisateurManager.php';
    require  C_ROOT . '/model/Bdd.php';
    $data = array(
        'login' => $_POST['log'] ,
        'm2p'   => $_POST['m2p']
    );
    $res = utilisateurManager::authentification($data);
    if ($res){
        if(!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['user'] = $_POST['log'] ;
        $estAdmin = utilisateurManager::getInfosUser($_POST['log'])->estAdmin;

        if ($estAdmin){
            $_SESSION['admin'] = true;
        }else{
            $_SESSION['solde'] = utilisateurManager::getSoldeUser($_POST['log'])->solde;
        }

       header( 'Location: index.php');

    }else{
        $msg= 'Login ou mot de passe incorrect';
        require C_ROOT . '/vues/pageConnexion.php' ;
    }
}else{
    $msg= 'Login ou mot de passe incorrect';
    require C_ROOT . '/vues/pageConnexion.php' ;
}

