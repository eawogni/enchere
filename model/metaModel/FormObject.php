<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 22/01/2019
 * Time: 23:54
 */
declare(strict_types=1);

class formObject
{
    private $balise; //input |textarea
    private $type;
    private $nom;
    private $id;
    private $label;     //Le label a afficher pour un champ
    private $ordreAffichage;   // entier définissant l'ordre d'affichage de ce champs dans un formulaire
    private $value; //la valeur du champs value pur la balise
    private $selectContent="";

    /**
     * formObject constructor.
     * @param $balise String : la balise du champs (input | textarea)
     * @param $type String : le type de de champs (text | number  |date | time, search) -> uniquement pour un champs input
     * @param $nom String : le nom pour l ' attribut name du champs
     * @param $id String : l'identifiant de ce champs
     * @param $label String : le texte à afficher pour ce champs
     * @param $ordreAffichage int : ordre d'affichage du champs
     */
    public function __construct(String $balise, String $type= "", String $nom, String $id, String $label, int $ordreAffichage, String $value = "")
    {
        $this->type = $type;
        $this->nom = $nom;
        $this->id = $id;
        $this->label = $label;
        $this->ordreAffichage = $ordreAffichage;
        $this->balise = $balise;
        $this->value = $value;
    }

    /**
     * @return String
     */
    public function getBalise(): String
    {
        return $this->balise;
    }

    /**
     * @return String
     */
    public function getOrdreAffichage(): int
    {
        return $this->ordreAffichage;
    }

    /**
     * @return string le code html pour le champs
     */
    public function draw()
    {
        switch ($this->balise) {
            case 'input':
                {
                    if ($this->type==='number'){
                        return ("<input type='{$this->type}' name='{$this->nom}' id='{$this->id}' value='{$this->value}' step='any' class='form-control'> <br>");
                    }
                    return $this->type==='file' ?  ("<input type='{$this->type}' name='{$this->nom}' id='{$this->id}' > <br>"): ("<input type='{$this->type}' name='{$this->nom}' id='{$this->id}' value='{$this->value}' class='form-control'> <br>");

                }
                break;
            case 'textarea' :
                return ("<textarea name='{$this->nom}' id='$this->id'  class='form-control' >$this->value</textarea> <br>");
                break;

            case 'select':
                return ("<select name='{$this->nom}' id='$this->id'  class='form-control'>
                    $this->selectContent
                  </select><br>" );
        }

    }

    /**
     * @return String
     */
    public function getValue(): String
    {
        return $this->value;
    }

    /**
     * @param String $value
     */
    public function setValue(String $value)
    {
        $this->value = $value;
    }

    /**
     * @return String
     */
    public function getType(): String
    {
        return $this->type;
    }

    /**
     * @return String
     */
    public function getNom(): String
    {
        return $this->nom;
    }

    /**
     * @return String
     */
    public function getId(): String
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getLabel(): String
    {
        return $this->label;
    }

    /**
     * format le contenu de ce champ select
     * @param $arrayContent : tableau contenant les options de ce champs select
     */
   public  function  setSelectContent($arrayContent){
       foreach ($arrayContent as $content){
           $this->selectContent .= "<option value='{$content}'>{$content}</option>" ;
       }
   }



}