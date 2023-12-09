<?php
$title = "Usagers";
$bsIcons = true;
$scripts = "<script src='/assets/js/app.js' type='module'></script>";
ob_start();
?>
<style>
    .divUser:hover {
        background-color: #ececec;
    }
</style>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Liste des usagers</h1>
    <div>
        <button class="btn btn-primary"><i class="bi bi-person-plus-fill me-2"></i>ajouter usager</button>
    </div>
</div>
<?php
switch($error) {
    case 1:
        echo '<div class="alert alert-danger my-3" role="alert">Erreur lors de l\'initialisation de la page.</div>'; break;
    case 2:
        echo '<div class="alert alert-danger my-3" role="alert">Mise à jour impossible, les données ne sont pas valides.</div>'; break;
    case 3:
        echo '<div class="alert alert-danger my-3" role="alert">Une erreur s\'est produite lors de la modification de l\'usager.</div>'; break;
    case 4:
        echo '<div class="alert alert-danger my-3" role="alert">Une erreur s\'est produite lors de la suppression de l\'usager.</div>'; break;
}
switch($success) {
    case 1:
        echo '<div class="alert alert-success my-3" role="alert">Modifications enregistrées.</div>'; break;
    case 2:
        echo '<div class="alert alert-success my-3" role="alert">Suppression enregistrée.</div>'; break;
    case 3:
        echo '<div class="alert alert-success my-3" role="alert">azerty2</div>'; break;
}
if(is_array($users)) {
    echo '<div class="row g-3">';
    foreach($users as $user) {
        echo $user->getCard();
    }
    echo '</div>';
}
?>

<!-- Modal -->
<div class="modal fade" id="modal-modif" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
    <input type="hidden" name="action" value="update">
    <input id="idUser" name="idUser" type="hidden">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modification de l'usager</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-3">
                <img src="" class="rounded-circle w-100" alt="Photo de profil">
            </div>
            <div class="col-9 d-flex flex-column justify-content-evenly">
                <div id="mbody-name" class="row gx-1">
                    <div class="col-2"><input type="text" name="civility" class="form-control form-control-sm" readonly style="cursor: pointer;" onmousedown="return false;"></div>
                    <div class="col-5"><input type="text" name="lastName" class="form-control form-control-sm"></div>
                    <div class="col-5"><input type="text" name="firstName" class="form-control form-control-sm"></div>
                </div>
                <div id="mbody-birth" class="row gx-1">
                    <div class="col-2 d-flex align-items-center">Né le</div>
                    <div class="col-5"><input type="date" name="birthDate" class="form-control form-control-sm"></div>
                    <div class="col-1 d-flex align-items-center justify-content-center">à</div>
                    <div class="col-4"><input type="text" name="birthPlace" class="form-control form-control-sm" value="Paris"></div>
                </div>
            </div>
            <div id="mbody-nir" class="col-12 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                    <input type="text" name="secuNumber" class="form-control">
                </div>
            </div>
            <div id="mbody-pcode" class="col-6 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" name="postalCode" class="form-control">
                </div>
            </div>
            <div id="mbody-city" class="col-6 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-buildings"></i></span>
                    <input type="text" name="city" class="form-control">
                </div>
            </div>
            <div id="mbody-address" class="col-12 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-house"></i></span>
                    <input type="text" name="address" class="form-control">
                </div>
            </div>
            <div id="mbody-doctor" class="col-12 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><svg height="16" width="14" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-96 55.2C54 332.9 0 401.3 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7c0-81-54-149.4-128-171.1V362c27.6 7.1 48 32.2 48 62v40c0 8.8-7.2 16-16 16H336c-8.8 0-16-7.2-16-16s7.2-16 16-16V424c0-17.7-14.3-32-32-32s-32 14.3-32 32v24c8.8 0 16 7.2 16 16s-7.2 16-16 16H256c-8.8 0-16-7.2-16-16V424c0-29.8 20.4-54.9 48-62V304.9c-6-.6-12.1-.9-18.3-.9H178.3c-6.2 0-12.3 .3-18.3 .9v65.4c23.1 6.9 40 28.3 40 53.7c0 30.9-25.1 56-56 56s-56-25.1-56-56c0-25.4 16.9-46.8 40-53.7V311.2zM144 448a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/></svg></span>
                    <select name="idDoctor" class="form-select">
                        <option value="0">--Médecin référent--</option>
                        <?php
                        if(is_array($doctors)) {
                            foreach($doctors as $doctor) {
                                echo $doctor->getOption();
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
            Annuler
            <i class="bi bi-x-circle"></i>
        </button>
        <button type="submit" id="btn-tts-confirm" class="btn btn-success">
            Valider
            <i class="bi bi-check-circle"></i>
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