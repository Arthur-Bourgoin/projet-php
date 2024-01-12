<?php
namespace App\Class;

class User {

    const PATH = "/assets/images/users/";

    public $idUser;
    public $picture;
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
        $this->idUser = $obj->idUsager;
        $this->picture = self::PATH . $obj->photo;
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

    public function getAge() {
        return (new \DateTime())->diff(new \DateTime($this->birthDate))->y;
    }

    public function getOption(bool $selected) {
        $text = ($this->civility === "M" ? "Mr." : "Mme") . " " . $this->lastName . " " . $this->firstName;
        return "<option value='$this->idUser'" . ($selected ? "selected>" : ">") . $text . "</option>";
    }

    public function getCellTabRdv() {
        ob_start()
        ?>
        <div class="d-flex align-items-center">
            <div class="me-2" style="height: 40px;">
                <img src="<?= $this->picture ?>" class="object-fit-contain mw-100 mh-100" alt="Photo de profil">
            </div>
            <div>
                <?= ($this->civility==="M" ? "Mr. " : "Mme. ") . $this->lastName . " " . $this->firstName ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function getCard() {
        ob_start();
        ?>
        <div class="col-4">
            <div class="divUser row position-relative m-0 border rounded" data-id-user="<?= $this->idUser ?>">
                <div class="col-2 p-2 d-flex align-items-center justify-content-center" style="height: 80px;" data-bs-toggle="modal" data-bs-target="#modal-modif">
                    <img src="<?= $this->picture ?>" class="object-fit-contain mw-100 mh-100" alt="photo de profil">
                </div>
                <div class="col-9 p-1 d-flex flex-column justify-content-evenly" data-bs-toggle="modal" data-bs-target="#modal-modif">
                    <div><?= ($this->civility==="M" ? "Mr. " : "Mme. ") . $this->lastName . " " . $this->firstName ?></div>
                    <div>
                        <span class="me-2"><i class="bi bi-calendar-event"></i><?= "  " . (new \DateTime($this->birthDate))->format('d/m/Y') ?></span>
                        <span><i class="bi bi-geo-alt"></i><?= "  " . $this->city . ", " . $this->postalCode ?></span>
                    </div>
                </div>
                <div class="col-1 p-0 d-flex justify-content-center align-items-center">
                    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                        <input type="hidden" name="action" value="deleteUser">
                        <input type="hidden" name="idUser" value="<?= $this->idUser ?>">
                        <button class="btn btn-primary p-1"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }


}