<?php
namespace App\Class;

class User {

    public $id;
    public $picturePath;
    public $secuNumber;
    public $civility;
    public $lastName;
    public $firstName;
    public $city;
    public $postalCode;
    public $address;
    public $birthDate;
    public $birthPlace;
    public $referringDoctor;

    public function __construct(object $obj) {
        $this->id = $obj->idUsager;
        $this->picturePath = $obj->photo;
        $this->secuNumber = $obj->nir;
        $this->civility = $obj->civilite;
        $this->lastName = $obj->nom;
        $this->firstName = $obj->prenom;
        $this->city = $obj->ville;
        $this->postalCode = $obj->codePostal;
        $this->address = $obj->adresse;
        $this->birthDate = $obj->dateNaissance;
        $this->birthPlace = $obj->lieuNaissance;
        $this->referringDoctor = $obj->idMedecin;
    }

    public function getCard() {
        ob_start(); ?>
        <div class="col-4">
            <div class="divUser row position-relative m-0 border rounded" data-id="<?= $this->id ?>">
                <div class="col-2 p-2" data-bs-toggle="modal" data-bs-target="#modal-modif">
                    <img src="assets/images/<?= $this->picturePath ?>" class="rounded-circle card-img-top" alt="photo de profil">
                </div>
                <div class="col-9 p-1 d-flex flex-column justify-content-evenly" data-bs-toggle="modal" data-bs-target="#modal-modif">
                    <div><?= ($this->civility==="M" ? "Mr. " : "Mme. ") . $this->lastName . " " . $this->firstName ?></div>
                    <div>
                        <span class="me-2"><i class="bi bi-calendar-event"></i><?= "  " . $this->birthDate ?></span>
                        <span><i class="bi bi-geo-alt"></i><?= "  " . $this->city . ", " . $this->postalCode ?></span>
                    </div>
                </div>
                <div class="col-1 p-0 d-flex justify-content-center align-items-center">
                    <form action="other" method="POST">
                        <input type="hidden" name="id" value="<?= $this->id ?>">
                        <button class="btn btn-primary p-1"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }


}