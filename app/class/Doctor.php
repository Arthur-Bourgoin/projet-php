<?php
namespace App\Class;

class Doctor {

    public $id;
    public $civility;
    public $lastName;
    public $firstName;
    public $picturePath;

    public function __construct(object $obj) {
        $this->id = $obj->idMedecin;
        $this->civility = $obj->civilite;
        $this->lastName = $obj->nom;
        $this->firstName = $obj->prenom;
        $this->picturePath = $obj->photo;
    }

    public function getOption() {
        return "<option value='$this->id'>" . ($this->civility === "M" ? "Mr." : "Mme") . " " . $this->lastName . " " . $this->firstName . "</option>";
    }

}