<?php
$title = "Statistiques";
$scripts = "<script src='https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js'></script>
            <script src='/assets/js/statistics.js' type='module'></script>";
ob_start();
?>

<?= \app\class\Feedback::getMessage() ?>
<div class="border rounded p-2">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-graph1" type="button" role="tab" aria-selected="false">
                <i class="bi bi-bar-chart-line me-2"></i>Graphique
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link " data-bs-toggle="tab" data-bs-target="#tab-tab1" type="button" role="tab" aria-selected="true">
                <i class="bi bi-table me-2"></i>Tableau
            </button>
        </li>
    </ul>
    <div class="tab-content d-flex justify-content-center pt-2">
        <div class="tab-pane fade show active w-75" id="tab-graph1" role="tabpanel">
            <canvas id="chartAge"></canvas>
        </div>
        <div class="tab-pane fade w-100" id="tab-tab1" role="tabpanel">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre d'hommes<i class="ms-2 bi bi-gender-male"></i></th>
                        <th scope="col">Nombre de femmes<i class="ms-2 bi bi-gender-female"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Moins de 25 ans</th>
                        <td><?= $tab["M"][0] ?></td>
                        <td><?= $tab["F"][0] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Entre 25 et 50 ans</th>
                        <td><?= $tab["M"][1] ?></td>
                        <td><?= $tab["F"][1] ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Plus de 50 ans</th>
                        <td><?= $tab["M"][2] ?></td>
                        <td><?= $tab["F"][2] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="border rounded p-2 mt-5">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-graph2" type="button" role="tab" aria-selected="false">
                <i class="bi bi-bar-chart-line me-2"></i>Graphique
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-tab2" type="button" role="tab" aria-selected="true">
                <i class="bi bi-table me-2"></i>Tableau
            </button>
        </li>
    </ul>
    <div class="tab-content d-flex justify-content-center pt-2">
        <div class="tab-pane fade show active w-75" id="tab-graph2" role="tabpanel">
            <canvas id="chartDoctor"></canvas>
        </div>
        <div class="tab-pane fade w-100" id="tab-tab2" role="tabpanel">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Médecin</th>
                        <th scope="col">Durée totale des consultations effectuées<i class="bi bi-clock ms-2"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($doctors as $doctor) {
                            echo $doctor->getLineTabStats();
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const tabStats = <?= json_encode($tab) ?>;
    console.log(tabStats);
    let doctorsPHP = <?= json_encode($doctors) ?>;
</script>

<?php
$content = ob_get_clean();
require("layout.php");