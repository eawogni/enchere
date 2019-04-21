<?php
require C_ROOT . '/model/enchereManager.php';
require C_ROOT . '/model/Bdd.php';
require C_ROOT . '/model/metaModel/DrawAform.php';
require C_ROOT . '/model/produitManager.php';
require C_ROOT . '/model/miseManager.php';
$page = C_ROOT . '/vues/page404.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getList' :
            {
                $encheres = enchereManager::getEncheres();
                $page = C_ROOT . '/vues/admin/vueEncheresAdmin.php';
            }
            break;
        case 'getVueEdit' :
            {
                if (isset($_GET['idEnchere'])) {
                    $enchere = enchereManager::getEnchere($_GET['idEnchere']);
                    if ($enchere) {
                        $dessinForm = new DrawAform(Bdd::getPDO(), "form", "objetFormulaire", 3);
                        $action = 'index.php?p=adminEncheres&action=editEnchere&idEnchere=' . $_GET['idEnchere'];
                        $dessinForm->setActionForm($action);
                        $dessinForm->setValueChamps('dateDebut', $enchere->dateDebut);
                        $dessinForm->setValueChamps('dateFin', $enchere->dateFin);
                        $dessinForm->setValueChamps('coutMise', $enchere->coutMise);
                        $dessinForm->setValueChamps('prixIndicatif', $enchere->prixIndicatif);
                        $listeProduit = produitManager::getProduitsForAdmin();
                        $produits = array();
                        foreach ($listeProduit as $prod) {
                            $produits[] = $prod->nomProduit;
                        }
                        $dessinForm->setContectSelect('nomProduit', $produits);
                        $enchereHtml = $dessinForm->getHtmlFormulaire();
                        $_SESSION['idEnchere'] = $_GET['idEnchere'];
                        $page = C_ROOT . '/vues/admin/vueEditEnchere.php';

                    }

                }
            }
            break;
        case 'editEnchere':
            {

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if ($_GET['idEnchere'] == $_SESSION['idEnchere']) { //Pour vérifier que l'idEnchere n'ai pas été modifié depuis le formulaire

                        $donnees = [
                            'idEnchere' => $_GET['idEnchere'],
                            'dateDebut' => $_POST['dateDebut'],
                            'dateFin' => $_POST['dateFin'],
                            'coutMise' => $_POST['coutMise'],
                            'prixIndicatif' => $_POST['prixIndicatif']
                        ];

                        $nb = enchereManager::updateEnchere($donnees);
                        unset($_SESSION['idEnchere']);

                        $misesExisteSurEnchere = miseManager::misesPourUneEnchere($_GET['idEnchere']);

                        if (empty($misesExisteSurEnchere)) {
                            $listeProduits = produitManager::getProduitsForAdmin();
                            $idProduitEnchere = -1;
                            foreach ($listeProduits as $produit) {
                                if ($produit->nomProduit === $_POST['nomProduit']) $idProduitEnchere = $produit->idProduit;
                            }

                            if ($idProduitEnchere != -1)
                                enchereManager::updateProduitEnchere($idProduitEnchere, $_GET['idEnchere']);
                            $_SESSION['msg'] = "Toutes les informations ont été mises à jour ";
                        }else{
                            $_SESSION['msg'] = "Toutes les informations ont été mises à jour à l'exception du produit associé à l'enchère :  
                                                  des mises existent pour cette enchère";
                        }

                    }
                    header("Location: /index.php?p=adminEncheres&action=getList");
                }
            }
            break;
        case 'getVueAddEnchere':
            {
                $dessinForm = new DrawAform(Bdd::getPDO(), "form", "objetFormulaire", 3);
                $action = "index.php?p=adminEncheres&action=addEnchere";
                $dessinForm->setActionForm($action);
                $listeProduit = produitManager::getProduitsForAdmin();
                $produits = array();
                foreach ($listeProduit as $prod) {
                    $produits[] = $prod->nomProduit;
                }
                $dessinForm->setContectSelect('nomProduit', $produits);
                $htmlAddEnchere = $dessinForm->getHtmlFormulaire();
                $page = C_ROOT . '/vues/admin/vueAddEnchere.php';

            }
            break;
        case 'addEnchere':
            {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $listeProduit = produitManager::getProduitsForAdmin();
                    $idProduit = -1;       //l'idCategorie du produit a ajouté
                    foreach ($listeProduit as $produit) {
                        if ($produit->nomProduit === $_POST['nomProduit']) {
                            $idProduit = $produit->idProduit;
                        }
                    }
                    if (($idProduit != -1) && !empty($_POST['dateDebut']) && !empty($_POST['dateFin']) && !empty($_POST['prixIndicatif']) && !empty($_POST['coutMise'])) {
                        $donnees = [
                            'idEnchere' => 0,
                            'dateDebut' => $_POST['dateDebut'],
                            'dateFin' => $_POST['dateFin'],
                            'coutMise' => $_POST['coutMise'],
                            'prixIndicatif' => $_POST['prixIndicatif'],
                            'idProduit' => $idProduit
                        ];

                        enchereManager::addEnchere($donnees);
                        $_SESSION['msg'] = "L'enchere a bien été ajouté";

                    } else {
                        $_SESSION['msgErreur'] = 'Veuillez vérifier les informations envoyées';


                    }

                    header("Location: /index.php?p=adminEncheres&action=getList");
                }


            }
            break;
        case 'deleteEnchere':
            {
                if (isset($_GET['idEnchere'])) {
                    try {
                        enchereManager::deleteEnchere($_GET['idEnchere']);

                    } catch (Exception $err) {
                        $_SESSION['msgErreur'] = "Impossible de supprimer une enchère associé à une mise ";
                    }
                    header("Location: /index.php?p=adminEncheres&action=getList");
                }
            }
            break;
    }

}

require $page;
