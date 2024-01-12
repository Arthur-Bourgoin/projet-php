<?php
namespace App\Class;

class Rdv {

    public $dateTime;
    public $duration;
    public $user;
    public $doctor;

    public function __construct(object $rdv, object $user, object $doctor) {
        $this->dateTime = $rdv->dateHeureDebut;
        $this->duration = $rdv->duree;
        $this->user = $user;
        $this->doctor = $doctor;
    }

    public function getLineTab() {
        ob_start()
        ?>
        <tr>
            <td><?= $this->doctor->getCellTabRdv() ?></td>
            <td><?= $this->user->getCellTabRdv() ?></td>
            <td class="align-middle"><?= "Le " . (new \DateTime($this->dateTime))->format("d/m/Y") . " à " . (new \DateTime($this->dateTime))->format("H:i") ?></td>
            <td class="align-middle"><?= $this->duration . " min" ?></td>
            <td>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-primary ms-3">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </td>
        </tr>
        <?php
        return ob_get_clean();
    }

}