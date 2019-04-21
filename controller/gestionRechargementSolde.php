<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 04/03/2019
 * Time: 17:03
 */

require C_ROOT .  '/model/utilisateurManager.php';
require C_ROOT .  '/model/Bdd.php';

$montant = random_int(1,50);
$montantFinal = $montant + utilisateurManager::getSoldeUser($_SESSION['user'])->solde;
utilisateurManager::updateSoldeUser($_SESSION['user'],$montantFinal);
$_SESSION['solde'] =  utilisateurManager::getSoldeUser($_SESSION['user'])->solde ;
$message = $montant ." euros ajouté à votre solde";
require C_ROOT .  '/vues/vueRecharge.php';
