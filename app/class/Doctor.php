<?php
namespace app\class;
use app\models\DoctorModel;

class Doctor {

    const PATH = "/assets/images/users/";

    public $idDoctor;
    public $civility;
    public $lastName;
    public $picture;
    public $firstName;
    public $duration;

    public function __construct(object $obj) {
        $this->idDoctor = $obj->idMedecin;
        $this->civility = $obj->civilite;
        $this->lastName = $obj->nom;
        $this->firstName = $obj->prenom;
        $this->picture = self::PATH . $obj->photo;
        $this->duration = null;
    }

    public function getOption(bool $selected) {
        $text = ($this->civility === "M" ? "Mr." : "Mme") . " " . $this->lastName . " " . $this->firstName;
        return "<option value='$this->idDoctor' " . ($selected ? "selected>" : ">") . $text . "</option>";
    }

    public function getCellTabRdv() {
        ob_start();
        ?>
        <div class="d-flex align-items-center">
            <div class="me-2" style="height: 40px;">
                <img src="<?= $this->picture ?>" class="object-fit-contain mw-100 mh-100" alt="Photo de profil">
            </div>
            <div>
                <?= ($this->civility === "M" ? "Mr. " : "Mme. ") . $this->lastName . " " . $this->firstName ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public function getLineTabStats() {
        $this->duration = DoctorModel::getDurationRdv($this->idDoctor);
        $formattedDuration = rtrim(rtrim($this->duration, '0'), '.');
        ob_start();
        ?>
        <tr>
            <td>
                <div class="d-flex align-items-center">
                    <div class="m-1 me-3" style="height: 40px;">
                        <img src="<?= $this->picture ?>" class="object-fit-contain mw-100 mh-100">
                    </div>
                    <?= ($this->civility === "M" ? "Mr. " : "Mme. ") . $this->lastName . " " . $this->firstName ?>
                </div>
            </td>
            <td class="align-middle"><?= (empty($formattedDuration) ? "0" : $formattedDuration) . ($this->duration <=1 ? " heure" : " heures") ?></td>
        </tr>
        <?php
        return ob_get_clean();
    }

    public function getCard() {
        ob_start();
        ?>
        <div class="col-3">
            <div class="d-flex flex-column align-items-center border rounded p-3">
                <div class="d-flex justify-content-center w-50" style="height: 150px;">
                    <img src="<?= $this->picture ?>" class="object-fit-contain mw-100 mh-100" alt="Photo de profil">
                </div>
                <div class="my-3">
                    <?= ($this->civility === "M" ? "Mr. " : "Mme. ") . $this->lastName . " " . $this->firstName ?> 
                </div>
                <div class="d-flex">
                    <form action="/consultations" method="POST">
                        <input type="hidden" name="action" value="filterTable">
                        <input type="hidden" name="doctor" value="<?= $this->idDoctor ?>">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-calendar-week"></i></button>
                    </form>
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