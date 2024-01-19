<?php
namespace app\class;

class Rdv {

    public $idRdv;
    public $dateTime;
    public $duration;
    public $user;
    public $doctor;

    public function __construct(object $rdv, object $user, object $doctor) {
        $this->idRdv = $rdv->idRdv;
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
                    <button class="btn btn-primary btn-updateRdv" data-bs-toggle="modal" data-bs-target="#updateRdv" data-id-rdv="<?= $this->idRdv ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                        <input type="hidden" name="action" value="deleteRdv">
                        <input type="hidden" name="idRdv" value="<?= $this->idRdv ?>">
                        <button type="submit" class="btn btn-primary ms-3 btn-delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        <?php
        return ob_get_clean();
    }

}