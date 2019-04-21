<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 09/02/2019
 * Time: 11:29
 */

class Mise
{


    private $statut;        //le statut de la mise
    private $idMise;        //l'id de la mise
    private $montantMise;
    private $login;         //id de l'utilisateur ayant fait la mise
    private $dateMise;      //data à laquelle a mise  a ete effectué

    private $enchere;       //object représentant un enchère
    private $produit;       //object représentant un produit


    /**
     * Mise constructor.
     * @param $miseObjectBdd object obtenu via FETCH_OBJ lors de la requête dans la base de données
     * @param $enchere      object obtenu via FETCH_OBJ lors de la requête dans la base de données
     * @param $produit      object obtenu via FETCH_OBJ lors de la requête dans la base de données
     * @param $statut       string
     */
    public function __construct($miseObjectBdd, $enchere, $produit, $statut)
    {

        $this->statut =$statut ;
        $this->idMise =  $miseObjectBdd->idMise;
        $this->montantMise = $miseObjectBdd->montantMise;
        $this->login = $miseObjectBdd->login ;
        $this->dateMise = $miseObjectBdd->dateMise;
        $this->enchere = $enchere;
        $this->produit =$produit;

    }

    /**
     * @return mixed
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * @return mixed
     */
    public function getIdMise()
    {
        return $this->idMise;
    }

    /**
     * @return mixed
     */
    public function getMontantMise()
    {
        return $this->montantMise;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getDateMise()
    {
        return $this->dateMise;
    }

    public function  getIdProduit(){
        if ($this->produit != null){
            return $this->produit->idProduit;
        }
        return null;

    }

    public function  getNomProduit(){
        if ($this->produit != null){
            return $this->produit->nomProduit;
        }
        return null;

    }

    public function  getIdEnchere(){
        if ($this->enchere !=null){
            return $this->enchere->idEnchere;
        }
        return null ;

    }







}