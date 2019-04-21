<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 26/02/2019
 * Time: 13:16
 */
//Cas pour un utilisateur connecté

if (isset($_SESSION['user'])) {
    require C_ROOT . '/model/produitManager.php';
    require C_ROOT . '/model/utilisateurManager.php';
    require C_ROOT . '/model/miseManager.php';
    require C_ROOT . '/model/Bdd.php';
    require C_ROOT . '/model/Produit.php';
    require C_ROOT . '/model/enchereManager.php';
    require C_ROOT . '/model/ImagesProduitManager.php';
    require C_ROOT . '/model/CategorieManager.php';

    if (isset($_POST['montantMise']) && (isset($_GET['idProduit']))) { //effectue la mise
        $produit = produitManager::getProduit($_GET['idProduit']);
        $prod = new Produit($produit);
        $montant = filter_var($_POST['montantMise'], FILTER_VALIDATE_FLOAT);
        $paiementPossible = ($prod != null) && ($montant > 0);
        if ($paiementPossible) {
            $mises = miseManager::miseExiste($prod->getEnchere()->idEnchere, $_SESSION['user']);
            $miseExiste = false;
            foreach ($mises as $mise) {
                if ($mise['montantMise'] == $montant) {
                    $miseExiste = true;
                }
            }
       
            if (!$miseExiste) {
                //on vérifie qu'il dispose de solde suffisant
                $soldeUser = utilisateurManager::getSoldeUser($_SESSION['user'])->solde;
                if ($soldeUser >= $prod->getEnchere()->coutMise) {   //solde suffisant
                    $nouveauSolde = $soldeUser - $prod->getEnchere()->coutMise;
                    utilisateurManager::updateSoldeUser($_SESSION['user'], $nouveauSolde);
                    $_SESSION['solde'] = utilisateurManager::getSoldeUser($_SESSION['user'])->solde;

                    $donneesMise = [
                        'idMise' => 0,
                        'montantMise' => $_POST['montantMise'],
                        'login' => $_SESSION['user'],
                        'idEnchere' => $prod->getEnchere()->idEnchere,
                        'dateMise' => date("Y-m-d H:i:s")
                    ];
                    miseManager::insererUneMise($donneesMise);
                    $message = "Mise de {$montant} euros  effectuée sur le produit {$prod->getProduit()->nomProduit}";
                    require C_ROOT . '/vues/vuePaiementEnchere.php';
                    //Message a affichier apres mise
                } else {
                    $messageErreur = "Solde insuffisant veuillez recharger";
                    require C_ROOT . '/vues/vuePaiementEnchere.php';
                }

            } else {
                $messageErreur = "Vous avez déjà effectué cette mise";
                require C_ROOT . '/vues/vuePaiementEnchere.php';
            }


        } else {
            $messageErreur = "Mise non effectuée, montant incohérent";
            require C_ROOT . '/vues/vuePaiementEnchere.php';
        }


    } else {
        if (isset($_GET['idProduit'])) { //demande de la page de paiement
            $prod = null;
            $produits = produitManager::getProduitsEnCoursEnchere();
            foreach ($produits as $produit) {
                if ($produit->idProduit == $_GET['idProduit']) {
                    $prod = new Produit($produit);
                };
            }
            $page = ($prod != null) ? '/vues/vuePaiementEnchere.php' : '/vues/page404.php';
            require C_ROOT . $page;
        }

    }

} else {  //Cas pour un utilisateur non connecté
    require C_ROOT . '/vues/pageConnexion.php';
}