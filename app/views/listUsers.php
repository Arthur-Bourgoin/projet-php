<?php
$title = "Usagers";
$scripts = "<script src='/assets/js/users.js' type='module'></script>";
ob_start();
?>
<style>
    .divUser {
        transition: transform .1s;
    }
    .divUser:hover{
        transform: scale(1.01);
    }
</style>
<?= \app\class\Feedback::getMessage() ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Liste des usagers</h1>
    <div>
        <button id="btn-newUser" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
            <i class="bi bi-person-plus-fill me-2"></i>nouveau
        </button>
    </div>
</div>
<?php

if(is_array($users)) {
    echo '<div class="row g-3">';
    foreach($users as $user) {
        echo $user->getCard();
    }
    echo '</div>';
}
?>

<!-- Modal modif -->
<div class="modal fade" id="modal-modif" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
    <input type="hidden" name="action" value="updateUser">
    <input id="idUser" name="idUser" type="hidden">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modification de l'usager</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-3 d-flex justify-content-center" style="height: 100px;">
                <label for="pictureUpdate" class="h-100 d-flex align-items-center pe-none">
                    <img class="object-fit-contain mw-100 mh-100" style="cursor: pointer;" alt="photo de profil">
                </label>
                <input id="pictureUpdate" name="picture" type="file" class="d-none">
            </div>
            <div class="col-9 d-flex flex-column justify-content-evenly">
                <div id="mbody-name" class="row gx-1">
                    <div class="col-2"><input type="text" name="civility" class="form-control form-control-sm" readonly style="cursor: pointer;" onmousedown="return false;"></div>
                    <div class="col-5"><input type="text" name="lastName" class="form-control form-control-sm" required></div>
                    <div class="col-5"><input type="text" name="firstName" class="form-control form-control-sm" required></div>
                </div>
                <div id="mbody-birth" class="row gx-1">
                    <div class="col-2 d-flex align-items-center">Né le</div>
                    <div class="col-5"><input type="date" name="birthDate" class="form-control form-control-sm" required></div>
                    <div class="col-1 d-flex align-items-center justify-content-center">à</div>
                    <div class="col-4"><input type="text" name="birthPlace" class="form-control form-control-sm" required></div>
                </div>
            </div>
            <div id="mbody-nir" class="col-12 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                    <input type="text" name="secuNumber" class="form-control" required>
                </div>
            </div>
            <div id="mbody-pcode" class="col-6 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" name="postalCode" class="form-control" required>
                </div>
            </div>
            <div id="mbody-city" class="col-6 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-buildings"></i></span>
                    <input type="text" name="city" class="form-control" required>
                </div>
            </div>
            <div id="mbody-address" class="col-12 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-house"></i></span>
                    <input type="text" name="address" class="form-control" required>
                </div>
            </div>
            <div id="mbody-doctor" class="col-12 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-heart-pulse"></i></span>
                    <select name="idDoctor" class="form-select">
                        <option value="0">Aucun médecin référent</option>
                        <?php
                        if(is_array($doctors)) {
                            foreach($doctors as $doctor) {
                                echo $doctor->getOption(false);
                            }
                        }
                        ?>
                    </select>
                </div>
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

<!-- Modal add -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="action" value="addUser">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajout d'un usager</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4 py-3">
        <div class="row">
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
            <div class="col-12 mt-3">
                <div class="row">
                    <div class="col-6 d-flex">
                        <label for="secuNumber" class="form-label my-auto">Numéro de sécurité sociale</label>
                    </div>
                    <div class="col-6">
                        <input id="secuNumber" name="secuNumber" type="text" class="form-control" required>
                    </div>
                </div>
            </div>
            <fieldset class="border form-group mt-2">
                <legend class="float-none w-auto px-2 fs-5">Naissance</legend>
                <div class="row px-3 mb-3">
                    <div class="col-1 d-flex align-items-center p-0">Le</div>
                    <div class="col-5 px-0">
                        <input type="date" name="birthDate" class="form-control" required>
                    </div>
                    <div class="col-1 d-flex align-items-center justify-content-center p-0">à</div>
                    <div class="col-5 px-0">
                        <input type="text" name="birthPlace" class="form-control" required>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border form-group mt-2">
                <legend class="float-none w-auto px-2 fs-5">Adresse</legend>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="postalCode" class="form-control" required>
                        </div>
                    </div>
                   <div class="col-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-buildings"></i></span>
                            <input type="text" name="city" class="form-control" required>
                        </div>
                   </div>
                    <div class="col-12 my-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-house"></i></span>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="col-12 mt-3 p-0">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-heart-pulse"></i></span>
                    <select name="idDoctor" class="form-select">
                        <option value="0">Aucun médecin référent</option>
                        <?php
                        if(is_array($doctors)) {
                            foreach($doctors as $doctor) {
                                echo $doctor->getOption(false);
                            }
                        }
                        ?>
                    </select>
                </div>
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
    const usersPHP = <?= json_encode($users) ?>;
</script>

<?php
$content = ob_get_clean();
require("layout.php");