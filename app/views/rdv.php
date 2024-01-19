<?php
$title = "Consultations";
$scripts = "<script src='/assets/js/rdv.js' type='module'></script>";
ob_start();
?>

<?= \App\Class\Feedback::getMessage() ?>

<div class="div-top">
    <h1 class="mb-4">Liste des consultations</h1>
    <div class="d-flex justify-content-between my-3">
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
            <input type="hidden" name="action" value="filterTable">
            <div class="d-flex">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-heart-pulse"></i></span>
                    <select name="doctor" class="form-select">
                        <option value="0">Tous</option>
                        <?php
                        if(is_array($doctors)) {
                            foreach($doctors as $doctor) {
                                echo $doctor->getOption($doctor->idDoctor == $idDoctor);
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group ms-4">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <select name="user" class="form-select">
                        <option value="0">Tous</option>
                        <?php
                        if(is_array($users)) {
                            foreach($users as $user) {
                                echo $user->getOption($user->idUser == $idUser);
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </form>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRdv">
            <i class="bi bi-person-plus-fill me-2"></i>nouveau
        </button>
    </div>
</div>
<div>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Médecin</th>
            <th scope="col">Usager</th>
            <th scope="col">Date et heure</th>
            <th scope="col">Durée</th>
            <th scope="col" class="text-end">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(is_array($rdvs)) {
            foreach($rdvs as $rdv) {
                    echo $rdv->getLineTab();
            }
        }
        ?>
    </tbody>
</table>
</div>

<div class="modal fade" id="addRdv" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
        <input type="hidden" name="action" value="addRdv">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Nouvelle consultation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-heart-pulse"></i></span>
                    <select class="form-select select-doctor" name="idDoctor" required>
                        <option value='0'>-- médecin --</option>
                        <?php
                        if(is_array($doctors)) {
                            foreach($doctors as $doctor) {
                                echo $doctor->getOption(false);
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <select class="form-select select-user" name="idUser" required>
                        <option value='0'>-- usager --</option>
                        <?php
                            if(is_array($users)) {
                                foreach($users as $user) {
                                    echo $user->getOption(false);
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                    <input type="datetime-local" class="form-control" name="dateTime" required>
                </div> 
                <div class="input-group mt-3">
                    <span class="input-group-text"><i class="bi bi-clock"></i></span>
                    <select class="form-select" name="duration" required>
                        <?php
                            for($i=15; $i <= 90; $i += 15) {
                                if($i == 30)
                                    echo "<option value='$i' selected>$i min</option>";
                                else
                                    echo "<option value='$i'>$i min</option>";
                            }
                        ?>
                    </select>
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

<div class="modal fade" id="updateRdv" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
        <input type="hidden" name="action" value="updateRdv">
        <input class="idRdv" type="hidden" name="idRdv">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modifier la consultation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-heart-pulse"></i></span>
                    <select class="form-select select-doctor" name="idDoctor" required>
                        <?php
                        if(is_array($doctors)) {
                            foreach($doctors as $doctor) {
                                echo $doctor->getOption(false);
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <select class="form-select select-user" name="idUser" required>
                        <?php
                            if(is_array($users)) {
                                foreach($users as $user) {
                                    echo $user->getOption(false);
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                    <input type="datetime-local" class="form-control dateTimeBegin" name="dateTime" required>
                </div> 
                <div class="input-group mt-3">
                    <span class="input-group-text"><i class="bi bi-clock"></i></span>
                    <select class="form-select duration" name="duration" required>
                        <?php
                            for($i=15; $i <= 90; $i += 15) {
                                echo "<option value='$i'>$i min</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="me-3 btn btn-danger" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-2"></i>Annuler
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-2"></i>Valider
                </button>
            </div>
        </div>
    </form>
    </div>
</div>


<script>
    const rdvsPHP = <?= json_encode($rdvs) ?>;
    const usersPHP = <?= json_encode($users) ?>;
</script>

<?php
$content = ob_get_clean();
require("layout.php");