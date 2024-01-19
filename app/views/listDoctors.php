<?php
$title = "Médecins";
$scripts = "<script src='/assets/js/doctors.js' type='module'></script>";
ob_start();
?>

<?= \app\class\Feedback::getMessage() ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Liste des médecins</h1>
    <div>
        <button id="btn-newDoctor" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddDoctor">
            <i class="bi bi-person-plus-fill me-2"></i>nouveau
        </button>
    </div>
</div>
<?php
if(is_array($doctors)) {
    echo '<div class="row g-3">';
    foreach($doctors as $doctor) {
        echo $doctor->getCard();
    }
    echo '</div>';
}
?>

<div class="modal fade" id="modalAddDoctor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="addDoctor">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ajout d'un médecin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-3 d-flex justify-content-center" style="height: 120px;">
                    <label for="pictureAdd" class="h-100 d-flex align-items-center">
                        <img src="/assets/images/users/user0.png" class="object-fit-contain mw-100 mh-100" style="cursor: pointer;" alt="photo de profil">
                    </label>
                    <input id="pictureAdd" name="picture" type="file" class="d-none">
                </div>
                <div class="col-7 d-flex flex-column justify-content-evenly">
                    <div class="row">
                        <div class="col-3 d-flex"><label for="inputLastName" class="form-label my-auto">Nom</label></div>
                        <div class="col-9"><input id="inputLastName" name="lastName" type="text" class="form-control" required></div>
                    </div>
                    <div class="row">
                        <div class="col-3 d-flex"><label for="inputFirstName" class="form-label my-auto">Prénom</label></div>
                        <div class="col-9"><input id="inputFirstName" name="firstName" type="text" class="form-control" required></div>
                    </div>
                </div>
                <div class="col-2 d-flex flex-column justify-content-evenly">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inputM">M</label>
                        <input class="form-check-input" type="radio" id="inputM" name="civility" value="M" required>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inputF" name="civility" value="F">
                        <label class="form-check-label" for="inputF">F</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="me-3 btn btn-danger" data-bs-dismiss="modal">
                    Annuler<i class="bi bi-x-circle ms-1"></i>
                </button>
                <button type="submit" id="btn-tts-confirm" class="btn btn-success">
                    Valider<i class="bi bi-check-circle ms-1"></i>
                </button>
            </div>
        </div> 
    </form>
    </div>
</div>

<div class="modal fade" id="modalUpdateDoctor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="updateDoctor">
        <input id="idDoctor" type="hidden" name="idDoctor">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modification d'un médecin</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-3 d-flex justify-content-center" style="height: 120px;">
                    <label for="pictureUpdate" class="h-100 d-flex align-items-center pe-none">
                        <img class="object-fit-contain mw-100 mh-100" style="cursor: pointer;" alt="photo de profil">
                    </label>
                    <input id="pictureUpdate" name="picture" type="file" class="d-none">
                </div>
                <div class="col-7 d-flex flex-column justify-content-evenly">
                    <div class="row">
                        <div class="col-3 d-flex"><label for="inputLastNameU" class="form-label my-auto">Nom</label></div>
                        <div class="col-9"><input id="inputLastNameU" name="lastName" type="text" class="form-control" required></div>
                    </div>
                    <div class="row">
                        <div class="col-3 d-flex"><label for="inputFirstNameU" class="form-label my-auto">Prénom</label></div>
                        <div class="col-9"><input id="inputFirstNameU" name="firstName" type="text" class="form-control" required></div>
                    </div>
                </div>
                <div class="col-2 d-flex flex-column justify-content-evenly">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inputMU">M</label>
                        <input class="form-check-input" type="radio" id="inputMU" name="civility" value="M" required>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inputFU" name="civility" value="F">
                        <label class="form-check-label" for="inputFU">F</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="me-3 btn btn-danger" data-bs-dismiss="modal">
                    Annuler<i class="bi bi-x-circle ms-1"></i>
                </button>
                <button type="submit" id="btn-tts-confirm" class="btn btn-success">
                    Valider<i class="bi bi-check-circle ms-1"></i>
                </button>
            </div>
        </div>
    </form>
    </div>
</div>

<script>
    const doctorsPHP = <?= json_encode($doctors) ?>;
</script>

<?php
$content = ob_get_clean();
require("layout.php");
