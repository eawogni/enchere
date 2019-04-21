<?php
require C_ROOT . '/model/produitManager.php';
require C_ROOT . '/model/Bdd.php';
require C_ROOT . '/model/metaModel/DrawAform.php';
require C_ROOT . '/model/ImagesProduitManager.php';
require C_ROOT . '/model/CategorieManager.php';
$page = C_ROOT . '/vues/page404.php';

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'getList' :
            {
                $produits = produitManager::getProduitsForAdmin();
                $page = C_ROOT . '/vues/admin/vueProduitsAdmin.php';
            }
            break;
        case 'getVueEdit' :
            {
                if (isset($_GET['idProduit'])) {
                    $prod = produitManager::getProduit($_GET['idProduit']);
                    if ($prod) {
                        $dessinForm = new DrawAform(Bdd::getPDO(), "form", "objetFormulaire", 2);
                        $dessinForm->setValueChamps('nomProduit', $prod->nomProduit);
                        $dessinForm->setValueChamps('descriptionProduit', $prod->description);
                        $action = 'index.php?p=adminProduits&action=editProduit&idProduit=' . $_GET['idProduit'];
                        $dessinForm->setActionForm($action);
                        $listeCategorie = CategorieManager::getCategoriesForAdmin();
                        $contentChampSelect = [];
                        foreach ($listeCategorie as $categorie) {
                            $contentChampSelect[] = $categorie->nomCategorie;
                        }
                        $dessinForm->setContectSelect('categorie', $contentChampSelect);
                        $dessinForm->allowEnctypeAttribute(true);
                        $htmlProd = $dessinForm->getHtmlFormulaire();
                        $_SESSION['idProduit'] = $_GET['idProduit'];
                        $page = C_ROOT . '/vues/admin/vueEditProduit.php';

                    }

                }

            }
            break;
        case 'editProduit':
            {

                if ((isset($_GET['idProduit'])) && (isset($_POST['nomProduit'])) && (isset($_POST['descriptionProduit']))) {
                    $nb = 0;
                    if ($_GET['idProduit'] == $_SESSION['idProduit']) { //Pour vérifier que l'idProduit n'ai pas été modifié depuis le formulaire
                        $donnees = [
                            'idProduit' => $_GET['idProduit'],
                            'nomProduit' => $_POST['nomProduit'],
                            'description' => $_POST['descriptionProduit']
                        ];
                        $nb = produitManager::updateProduit($donnees);

                    }
                    //EDITER LA CATEGORIE DU PRODUIT
                    if (isset($_POST['categorie'])) {
                        $listeCategorie = CategorieManager::getCategoriesForAdmin();
                        $idCategorieProduit = -1;       //l'idCategorie du produit a ajouté
                        foreach ($listeCategorie as $categorie) {
                            if ($categorie->nomCategorie === $_POST['categorie']) {
                                $idCategorieProduit = $categorie->idCategorie;
                            }
                        }
                        if ($idCategorieProduit != -1) {
                            produitManager::updateCategorieProduit($idCategorieProduit, $_GET['idProduit']);
                            $nb = 1;// modification effectué
                        }
                    }

                    //EDITER LES IMAGES DU PRODUITS
                    $pathsOldImages = ImagesProduitManager::getImagesForProduit($_GET['idProduit']);
                    $oldPathImageFirstId = $pathsOldImages[0]->idImage;
                    $oldImage2Id = isset($pathsOldImages[1]) ? $pathsOldImages[1]->idImage : null;
                    $oldImage3Id = isset($pathsOldImages[2]) ? $pathsOldImages[2]->idImage : null;

                    updateImageProduit('imageFirst', $oldPathImageFirstId, $_GET['idProduit']);
                    updateImageProduit('image2', $oldImage2Id, $_GET['idProduit']);
                    updateImageProduit('image3', $oldImage3Id, $_GET['idProduit']);


                    if ($nb == 1) {
                        unset($_SESSION['idProduit']);
                        header("Location: /index.php?p=adminProduits&action=getList");
                        exit;

                    }
                }


            }
            break;
        case 'deleteProduit':
            {
                if (isset($_GET['idProduit'])) {
                    try {
                        produitManager::deleteProduit($_GET['idProduit']);

                    } catch (Exception $err) {
                        $_SESSION['msgErreur'] = "Impossible de supprimer un produit associé à une enchère ";

                    }
                    header("Location: /index.php?p=adminProduits&action=getList");
                }

            }
            break;
        case 'getVueAddProduit':
            {
                $dessinForm = new DrawAform(Bdd::getPDO(), "form", "objetFormulaire", 2);
                $action = "index.php?p=adminProduits&action=addProduit";
                $dessinForm->setActionForm($action);

                $listeCategorie = CategorieManager::getCategoriesForAdmin();
                $contentChampSelect = [];
                foreach ($listeCategorie as $categorie) {
                    $contentChampSelect[] = $categorie->nomCategorie;
                }
                $dessinForm->setContectSelect('categorie', $contentChampSelect);
                $dessinForm->allowEnctypeAttribute(true);
                $htmlAddProduit = $dessinForm->getHtmlFormulaire();
                $page = C_ROOT . '/vues/admin/vueAddProduit.php';

            }
            break;
        case 'addProduit':
            {

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $_POST['categorie'] = trim($_POST['categorie']);
                    $_POST['nomProduit'] = trim($_POST['nomProduit']);
                    if (!empty($_FILES['imageFirst']['tmp_name']) && !empty($_POST['categorie']) && !empty($_POST['nomProduit'])) {
                        //Enregistrement de l'image dans le fichier image d serveur
                        $name = basename($_FILES["imageFirst"]["name"]);
                        move_uploaded_file($_FILES['imageFirst']['tmp_name'], C_ROOT . "/public/images/$name");
                        //enregistrement du produit
                        $listeCategorie = CategorieManager::getCategoriesForAdmin();
                        $idCategorieProduit = -1;       //l'idCategorie du produit a ajouté
                        foreach ($listeCategorie as $categorie) {
                            if ($categorie->nomCategorie === $_POST['categorie']) {
                                $idCategorieProduit = $categorie->idCategorie;
                            }
                        }
                        $listeProduits = produitManager::getProduitsForAdmin();
                        $produitExiste = false;
                        foreach ($listeProduits as $produit) {
                            if ($produit->nomProduit === $_POST['nomProduit']) {
                                $produitExiste = true;
                            }
                        }
                        if (($idCategorieProduit != -1) && (!$produitExiste)) {    //On fais l'ajout complet si la categorie du produit existe et le nom du produit n'existe oas déja
                            $donnees = [
                                'nomProduit' => $_POST['nomProduit'],
                                'description' => $_POST['descriptionProduit'],
                                'idCategorie' => $idCategorieProduit
                            ];
                            produitManager::insererProduit($donnees);
                            //isertion de l'image du produit
                            $idProd = produitManager::getIdProduitByName($_POST['nomProduit']);
                            $data = [
                                'idImage' => 0,
                                'pathImage' => $name,
                                'firstImagine' => true,
                                'idProduit' => $idProd->idProduit
                            ];
                            ImagesProduitManager::insertImage($data);
                            $_SESSION['msg'] = "le produit " . $_POST['nomProduit'] . " a bien été ajouté ";

                            //Insertion des autres images 2 et 3 : pas trop d'exigeance pour insérer un produit
                            //image2
                            insertImageProduit('image2', $idProd->idProduit);
                            //Image3
                            insertImageProduit('image3', $idProd->idProduit);
                        }else {
                            $_SESSION['msgErreur'] = "Ce nom de produit existe déjà";
                        }


                    } else {
                        $_SESSION['msgErreur'] = "Veuillez Insérer au moins une image d'affiche , un nom de produit corrrect et une catégorie du produit";
                    }


                    header("Location: /index.php?p=adminProduits&action=getList");
                    exit;

                }


            }
            break;
    }

}

require $page;


function updateImageProduit($nameImage, $oldImageId, $idProduit)
{
    if (!empty($_FILES[$nameImage]['tmp_name'])) {
        //Enregistrement de l'image dans le fichier image d serveur
        $name = basename($_FILES[$nameImage]["name"]);
        move_uploaded_file($_FILES[$nameImage]['tmp_name'], C_ROOT . "/public/images/$name");
        if ($oldImageId) {
            ImagesProduitManager::updateImage($_GET['idProduit'], $oldImageId, $name);
        } else {
            insertImageProduit($nameImage, $idProduit);

        }


    }
}

function insertImageProduit($nameImage, $idProduit)
{

    if (!empty($_FILES[$nameImage]['tmp_name'])) {
        $name = basename($_FILES[$nameImage]["name"]);
        move_uploaded_file($_FILES[$nameImage]['tmp_name'], C_ROOT . "/public/images/$name");
        $data = [
            'idImage' => 0,
            'pathImage' => $name,
            'firstImagine' => 0,
            'idProduit' => $idProduit
        ];
        ImagesProduitManager::insertImage($data);
    }

}
