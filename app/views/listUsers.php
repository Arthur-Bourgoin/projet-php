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
    <?php
    if(isset($error)) {
        switch($error) {
            case 0: ?>
                <div class="alert alert-danger my-3" role="alert">
                    Erreur lors de l'initialisation de la page.
                </div>
                <?php
                break;
            case 1: ?>
                <div class="alert alert-danger my-3" role="alert">
                    A simple danger alert—check it out!
                </div>
                <?php
                break;
            case 2: ?>
                <div class="alert alert-danger my-3" role="alert">
                    A simple danger alert—check it out!
                </div>
                <?php
                break;
        }
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
                <div class="row gx-1">
                    <div class="col-2"><input type="text" class="form-control form-control-sm" value="Mr." readonly></div>
                    <div class="col-5"><input type="text" class="form-control form-control-sm" value="nomTest"></div>
                    <div class="col-5"><input type="text" class="form-control form-control-sm" value="prenom"></div>
                </div>
                <div class="row gx-1">
                    <div class="col-2 d-flex align-items-center">Né le</div>
                    <div class="col-5"><input type="date" class="form-control form-control-sm"></div>
                    <div class="col-1 d-flex align-items-center justify-content-center">à</div>
                    <div class="col-4"><input type="text" class="form-control form-control-sm" value="Paris"></div>
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
            </div>
            <div class="col-6 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-buildings"></i></span>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
            </div>
            <div class="col-12 mt-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-house"></i></span>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<script>
    const usersPHP = <?= json_encode($users) ?>;
</script>

<?php
$content = ob_get_clean();
require("layout.php");