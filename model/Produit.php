<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 14/03/2019
 * Time: 19:55
 */

class Produit
{
    private $produit;

    public function __construct($produit)
    {
        $this->produit = $produit;

    }

    public function getProduit()
    {
        return $this->produit;
    }

    public function getCategorie()
    {
        return CategorieManager::getCategorie($this->produit->idCategorie);

    }

    /**
     * Liste des enchères encours asssocié à ce produit
     * @return mixed
     *
     */
    public function getEnchere()
    {
        return enchereManager::getEnchereForProoduit($this->produit->idProduit);
    }

    /**
     * Liste des enchères(Terminés ou pas)  asssocié à ce produit
     * @return array
     */
    public function getAllEnchere()
    {
        return enchereManager::getAllEnchereForProduit($this->produit->idProduit);
    }
    public function getNbMisesForEnchere($idEnchere)
    {
        return enchereManager::getNbreMiseEnchere($idEnchere);
    }


    public function getImages()
    {
        return ImagesProduitManager::getImagesForProduit($this->produit->idProduit);
    }

    public function getImageFirst()
    {
        return ImagesProduitManager::getImageFisrt($this->produit->idProduit);
    }


}