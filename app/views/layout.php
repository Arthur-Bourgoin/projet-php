<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <?= isset($scripts) ? $scripts : "" ?>
    <title><?= isset($title) ? $title : "Titre" ?></title>
</head>
<body class="vh-100 d-flex flex-column">
    <header class="mb-4">
        <div class="container">
            <div class="row bg-secondary p-0">
                <img src="/assets/images/baniere.png" class="p-0">
            </div>
            <div class="row">
                <nav class="navbar navbar-expand bg-body-tertiary">
                    <div class="container-fluid">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/usagers"><i class="bi bi-person me-2"></i>Usagers</a>
                            </li>
                            <div class="vr mx-3"></div>
                            <li class="nav-item">
                                <a class="nav-link" href="/medecins"><i class="bi bi-heart-pulse me-2"></i>Médecins</a>
                            </li>
                            <div class="vr mx-3"></div>
                            <li class="nav-item">
                                <a class="nav-link" href="/consultations"><i class="bi bi-calendar me-2"></i>Consultations</a>
                            </li>
                            <div class="vr mx-3"></div>
                            <li class="nav-item">
                                <a class="nav-link" href="/statistiques"><i class="bi bi-graph-up me-2"></i>Statistiques</a>
                            </li>
                        </ul>
                        <div>
                            <button id="btn-theme" class="btn btn-primary me-2"></button>
                            <a href="/disconnect">
                                <button class="btn btn-danger">
                                    <i class="bi bi-power me-2"></i>Se déconnecter
                                </button>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <main class="mb-4">
        <div class="container p-0">
            <?= isset($content) ? $content : "Contenu de la page." ?>
        </div>
    </main>
    <footer class="mt-auto">
        <div class="container">
            <div class="row bg-secondary">
                <h1 class="text-center">FOOTER</h1>
            </div>
        </div>
    </footer>    
</body>
</html>