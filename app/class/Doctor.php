<?php
namespace App\Class;

class Doctor {

    const PATH = "/assets/images/users/";

    public $idDoctor;
    public $civility;
    public $lastName;
    public $firstName;
    public $picturePath;

    public function __construct(object $obj) {
        $this->idDoctor = $obj->idMedecin;
        $this->civility = $obj->civilite;
        $this->lastName = $obj->nom;
        $this->firstName = $obj->prenom;
        $this->picture = self::PATH . $obj->photo;
    }

    public function getOption() {
        return "<option value='$this->idDoctor'>" . ($this->civility === "M" ? "Mr." : "Mme") . " " . $this->lastName . " " . $this->firstName . "</option>";
    }

    public function getCard() {
        ob_start();
        ?>
        <div class="col-3">
            <div class="d-flex flex-column align-items-center border rounded p-3">
                <div class="d-flex w-50" style="height: 150px;">
                    <img src="<?= $this->picture ?>" class="object-fit-contain mw-100 mh-100" alt="Photo de profil">
                </div>
                <div class="my-3">
                    <?= ($this->civility === "M" ? "Mr. " : "Mme. ") . $this->lastName . " " . $this->firstName ?> 
                </div>
                <div class="d-flex">
                    <button class="btn btn-primary">
                        <i class="bi bi-person"></i>
                    </button>
                    <button class="btn btn-primary mx-3 btnUpdateModal" data-bs-toggle="modal" data-bs-target="#modalUpdateDoctor" data-id-doctor="<?= $this->idDoctor ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                        <input type="hidden" name="action" value="deleteDoctor">
                        <input type="hidden" name="idDoctor" value="<?= $this->idDoctor ?>">
                        <button class="btn btn-primary"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

}