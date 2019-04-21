<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 23/01/2019
 * Time: 15:43
 */

declare(strict_types=1);
require 'Form.php';
require 'FormObject.php';

/**
 * Class DrawAform
 * Rassemble toutes les informations necessaire à l'écriture d'un formulaire
 */
class DrawAform
{
    private $pdo;
    private $formNameInDataBase;
    private $formObjectNameInDataBase;
    private $idForm;
    private $donneesChamps;     //: tableau de FormObject : il s'agit des objets(FormObject) composants le formulaire du formulaire
    private $form; //l'objet Form

    /**
     * DrawAform constructor.
     * @param $pdo PDO : l'objet de connexion a la bdd
     * @param $formNameInDataBase String : le nom de la table contenant les infos du formulaire dans la bdd
     * @param $formObjectNameInDataBase String : le nom de  la table contenant les champs du formulaire en bdd
     * @param $idForm int : l'identifiant du formulaire a traiter
     */
    public function __construct(PDO $pdo, String $formNameInDataBase, String $formObjectNameInDataBase, int $idForm)
    {
        $this->pdo = $pdo;
        $this->formNameInDataBase = $formNameInDataBase;
        $this->formObjectNameInDataBase = $formObjectNameInDataBase;
        $this->idForm = $idForm;
        $this->setFormulaire();

    }



    /**
     * Recupère le contenu du formulaire à construire depuis la Bdd sous forme de table d'objet
     * @return array|null
     */
    private function getContenuFormulaireFromBdd()
    {
        if ($this->pdo instanceof PDO) {
            //Recupération des champs pour le formulaire demandé
            $req = $this->pdo->prepare("select * from {$this->formObjectNameInDataBase} where idForm = :idForm");
            $req->bindParam('idForm', $this->idForm);
            $req->execute();
            $tabChamps = $req->fetchAll(5);
            if ($tabChamps !=null) {
                return $tabChamps;
            }
        }
        return null;
    }

    /**
     * Récupère les unformations sur le formulaire depuis la Bdd sous forme d'objet
     * @return mixed|null
     */
    private function getFormulaireFromBdd()
    {
        if ($this->pdo instanceof PDO) {
            $req = $this->pdo->prepare("select * from {$this->formNameInDataBase} where idForm = :idForm");
            $req->bindParam('idForm', $this->idForm);
            $req->execute();
            $formEnBase = $req->fetch(5);

            if ($formEnBase != null) {
                return $formEnBase;
            }

        }
        return null;


    }

    private function setFormulaire()
    {

        if ($this->getContenuFormulaireFromBdd() != null) {   //Si le formulaire existe
            $tabChamps = $this->getContenuFormulaireFromBdd();
            //recuperation du contenu du formulaire
            $this->donneesChamps = array();
            foreach ($tabChamps as $champ) {
                $this->donneesChamps[] = new FormObject($champ->balise, $champ->type, $champ->nom, $champ->id, $champ->label, (int)$champ->ordreAffichage);
            }

            //Création du formulaire
            if ( $this->getFormulaireFromBdd() != null){
                $formEnBase = $this->getFormulaireFromBdd();
                $this->form = new Form($formEnBase->methode, $this->donneesChamps, $formEnBase->actionForm, $formEnBase->texteSubmit);

            }


        }

    }


    /**
     * Renvoie le code html du Formulaire créeé
     * @return String
     */
    public function getHtmlFormulaire()
    {
       if ($this->form != null){
           return $this->form->draw();
       }
       return null ;

    }


    /**
     * Modifie la valeur d'un champs donné
     * @param $nomChamp : valeur de l'attribut name du champ
     * @param $value :la valeur de la l'attribut value du champ
     */
    public function setValueChamps($nomChamp, $value)
    {
        foreach ($this->donneesChamps as $champ) {
            if ($champ->getNom() == $nomChamp) {
                $champ->setValue($value);
            }
        }
    }

    /**
     * Modifie le contenu du champ select présent dans le formulaire
     * @param $nomChamp : la valeur name du champ select
     * @param $content : les options à mettre dans le champs
     */
    public function setContectSelect($nomChamp,$content){

        foreach ($this->donneesChamps as $champ) {
            if ($champ->getNom() == $nomChamp) {
                $champ->setSelectContent($content);
            }
        }
    }


    /**
     * Modifie la valeur de l'attribut action(l'url de traitement) du formulaire
     * @param $action : l'url de traitement
     */
    public function setActionForm($action)
    {
        if ($this->form != null) {
            $this->form->setAction($action);
        }

    }


    /**
     * Indique que le formulaire contiendra des champs de typeFichier
     */
    public  function  allowEnctypeAttribute(){
        $this->form->setContentFile(true);

    }

}