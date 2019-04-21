<?php
require C_ROOT . '/model/CategorieManager.php';
require C_ROOT . '/model/Bdd.php';
require C_ROOT . '/model/metaModel/DrawAform.php';
$page = C_ROOT . '/vues/page404.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getList' :
            {
                $categories = CategorieManager::getCategoriesForAdmin();
                $page = C_ROOT . '/vues/admin/vueCategoriesAdmin.php';
            }
            break;
        case 'getVueEdit' :
            {
                if (isset($_GET['idCategorie'])) {
                    $categ = CategorieManager::getCategorie($_GET['idCategorie']);
                    if ($categ) {
                        $dessinForm = new DrawAform(Bdd::getPDO(), "form", "objetFormulaire", 1);
                        $dessinForm->setValueChamps('nomCategorie', $categ->nomCategorie);
                        $action = 'index.php?p=adminCategorie&action=editCategorie&idCategorie=' . $_GET['idCategorie'];
                        $dessinForm->setActionForm($action);
                        $html = $dessinForm->getHtmlFormulaire();
                        $_SESSION['idCategorie'] = $_GET['idCategorie'];
                        $page = C_ROOT . '/vues/admin/vueEditCategorie.php';

                    }

                }
            }
            break;
        case 'editCategorie':
            {
                if (isset($_GET['idCategorie']) && (isset($_POST['nomCategorie']))) {
                    if ($_GET['idCategorie'] == $_SESSION['idCategorie']) { //Pour vérifier que l'idCategorie n'ai pas été modifié depuis le formulaire
                        $_POST['nomCategorie'] = trim($_POST['nomCategorie']);
                        if (!empty($_POST['nomCategorie'])) {
                            $donnees = [
                                'idCategorie' => $_GET['idCategorie'],
                                'nomCategorie' => $_POST['nomCategorie']
                            ];
                            $nb = CategorieManager::updateCategorie($donnees);
                            if ($nb == 1) {
                                unset($_SESSION['idCategorie']);
                                header("Location: /index.php?p=adminCategorie&action=getList");
                                exit;

                            }
                        }else{
                            $_SESSION['msgErreur'] = " Nom de catégorie incorrect";
                            header("Location: /index.php?p=adminCategorie&action=getList");
                            exit;

                        }
                    }

                }
            }
            break;
        case 'deleteCategorie':
            {
                if (isset($_GET['idCategorie'])) {
                    try {
                        CategorieManager::deleteCategorie($_GET['idCategorie']);

                    } catch (Exception $err) {
                        $_SESSION['msgErreur'] = "Impossible de supprimer une catégorie associé à un produit";

                    }
                    header("Location: /index.php?p=adminCategorie&action=getList");
                }

            }
            break;
        case 'getVueAddCategorie':
            {
                $dessinForm = new DrawAform(Bdd::getPDO(), "form", "objetFormulaire", 1);
                $action = "index.php?p=adminCategorie&action=addCategorie";
                $dessinForm->setActionForm($action);
                $htmlAddCategorie = $dessinForm->getHtmlFormulaire();
                $page = C_ROOT . '/vues/admin/vueAddCategorie.php';

            }
        case 'addCategorie':
            {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $_POST['nomCategorie'] = trim($_POST['nomCategorie']);
                    if (!empty($_POST['nomCategorie'])) {
                        $listeCategories = CategorieManager::getCategoriesForAdmin();
                        $categorieExite = false;
                        foreach ($listeCategories as $categorie) {
                            if ($categorie->nomCategorie === $_POST['nomCategorie']) {
                                $categorieExite = true;
                            }
                        }
                        if (!$categorieExite) {
                            CategorieManager::addCategorie($_POST['nomCategorie']);
                            $_SESSION['msg'] = "la catégorie " . htmlspecialchars($_POST['nomCategorie']) . " a bien été ajouté";
                        } else {
                            $_SESSION['msgErreur'] = "la catégorie " . htmlspecialchars($_POST['nomCategorie']) . "  existe déjà";
                        }

                        header("Location: /index.php?p=adminCategorie&action=getList");
                    } else {
                        $_SESSION['msgErreur'] = " Nom de catégorie incorrect";
                        header("Location: /index.php?p=adminCategorie&action=getList");
                    }
                }


            }
            break;
    }

}

require $page;
