<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 31/01/2019
 * Time: 01:53
 */
require C_ROOT . '/model/utilisateurManager.php';
require C_ROOT . '/model/Bdd.php';
$erreur = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //On enlève les espaces inutiles
    $_POST['login'] = trim($_POST['login']);
    $_POST['nom'] = trim($_POST['nom']);
    $_POST['pren'] = trim($_POST['pren']);
    $_POST['dateNaiss'] = trim($_POST['dateNaiss']);
    $_POST['mail'] = trim($_POST['mail']);
    if (!empty($_POST['login']) && !empty($_POST['nom']) && !empty($_POST['pren']) && !empty($_POST['dateNaiss']) && !empty($_POST['mail']) && !empty($_POST['passwd']) && !empty($_POST['passwd2'])) {

        //vérification du login
        if (($_POST['login'] === $_POST['nom']) || ($_POST['login'] === $_POST['nom'])) {
            $erreur = true;
            $msgLogin = "Le login doit être différent du nom et du prénom";
        }
        //vérification du mail
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $erreur = true;
            $msgEmail = "Email incorrect";

        }
        //vérification du mot de passe
        if ($_POST['passwd'] != $_POST['passwd2']) {
            $erreur = true;
            $msgPasswd = "Les deux mots de passe saisis ne sont pas identiques";
        }
        //vérification du mot de passe
        if (strlen($_POST['passwd']) < 8) {
            $erreur = true;
            $msgPasswd = "Le mot de passe doit faire au minimum 8 caractères";
        }

        if ($erreur) { ///cas d'erreur
            require C_ROOT . '/vues/inscription.php';
        } else { //cas pas d'erreur-> enregistrement du nouvel utilisateur

            $donneesUser = [
                'login' => $_POST['login'],
                'nom' => $_POST['nom'],
                'prenom' => $_POST['pren'],
                'dateNaissance' => $_POST['dateNaiss'],
                'm2p' => password_hash($_POST['passwd'], PASSWORD_DEFAULT),
                'mail' => $_POST['mail'],
                'estAdmin' => 0,
                'solde' => 10

            ];

            utilisateurManager::ajouterUtilisateur($donneesUser);
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['user'] = $_POST['login'];
            $_SESSION['solde'] = utilisateurManager::getSoldeUser($_POST['login'])->solde;
            header('Location: index.php');


        }
    } else {
        $msg = "Tous les champs ne sont pas remplis";
        require C_ROOT . '/vues/inscription.php';
    }


}