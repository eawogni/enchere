<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 08/02/2019
 * Time: 16:47
 */


//Activation de la variable session
if(!isset($_SESSION)) {
    session_start();
}
//Le code s'exécutera si et seulement si l'utilisateur est authentifié

if ( isset($_SESSION['user'])){

// Détruit toutes les variables de session
    $_SESSION = array();

// destruction complèteme de  la session,->on efface les cookies
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

// Finalement, on détruit la session.
    session_destroy();
    header('Location: index.php?p=home');

}
