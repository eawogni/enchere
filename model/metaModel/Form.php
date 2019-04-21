<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 22/01/2019
 * Time: 23:48
 */
declare(strict_types=1);

/**
 * Class form : Représente un formulaire html
 */
class form
{
    private $methode;
    private $donnees;
    private $action;
    private $texteSubmit;
    private $contentFile = false;

    /**
     * form constructor.
     * @param $methode  String :la methode du formulaire (POST ou GET)
     * @param $donnees  array : tableau de formObject -> contient des objets de type formOject (représente un les champs du formulaire)
     * @param $action   String : l'url de traitement du formulaire
     * @param $texteSubmit String : le texte qui s'affichera pour le boutton submit . il sera également la valeur des attriibuts name et id de ce objet
     */
    public function __construct($methode, array $donnees, $action, $texteSubmit)
    {
        $this->methode = $methode;
        $this->donnees = $donnees;
        $this->action = $action;
        $this->texteSubmit = $texteSubmit;
        $this->ordonnerChamps();


    }

    /**
     * @return String : le code html pour le formulaire ayant pour champs les données passées en paramètre
     */
    public function draw()
    {
        $htmlFormulaire = "<div class='container'>";

        $htmlFormulaire = $htmlFormulaire . "<form action='{$this->action}' method='{$this->methode}'";
        $htmlFormulaire = $this->contentFile ? $htmlFormulaire . " enctype='multipart/form-data'>" : $htmlFormulaire . ">";


        foreach ($this->donnees as $formObject) {
            $htmlFormulaire = $htmlFormulaire . "<div class='form-group'><label for='{$formObject->getid()}'>{$formObject->getLabel()} :</label> <br>";
            $htmlFormulaire = $htmlFormulaire . $formObject->draw() . '</div>';

        }

        $htmlFormulaire = $htmlFormulaire . "<input type='submit' class='btn btn-primary' name='{$this->texteSubmit}' id='{$this->texteSubmit}'  value='{$this->texteSubmit}'><br>";

        $htmlFormulaire = $htmlFormulaire . "</form></div>";
        return $htmlFormulaire;
    }

    /**
     * Ordonner le tableau de donnees par ordre de champs pour l'affichage
     */
    private function ordonnerChamps()
    {
        $donneesChamps = array();
        for ($i = 0; $i < count($this->donnees); $i++) {
            foreach ($this->donnees as $champ) {     // cette implémentation permet de s'assurer que deux champs ayant le même ordreAffichage(ce qui ne doit pas être le cas) s'affichent
                if ($champ->getOrdreAffichage() == $i) {
                    $donneesChamps[] = $champ;
                }
            }
        }
        $this->donnees = $donneesChamps;
    }

    /**
     * @return String
     */
    public function getMethode(): String
    {
        return $this->methode;
    }

    /**
     * @param String $methode
     */
    public function setMethode(String $methode)
    {
        $this->methode = $methode;
    }

    /**
     * @return array
     */
    public function getDonnees(): array
    {
        return $this->donnees;
    }

    /**
     * @param array $donnees
     */
    public function setDonnees(array $donnees)
    {
        $this->donnees = $donnees;
    }

    /**
     * @return String
     */
    public function getAction(): String
    {
        return $this->action;
    }

    /**
     * @param String $action
     */
    public function setAction(String $action)
    {
        $this->action = $action;
    }

    /**
     * @return String
     */
    public function getTexteSubmit(): String
    {
        return $this->texteSubmit;
    }

    /**
     * @param String $texteSubmit
     */
    public function setTexteSubmit(String $texteSubmit)
    {
        $this->texteSubmit = $texteSubmit;
    }

    /**
     * @return bool
     */
    public function isContentFile(): bool
    {
        return $this->contentFile;
    }

    /**
     * @param bool $contentFile
     */
    public function setContentFile(bool $contentFile)
    {
        $this->contentFile = $contentFile;
    }


}