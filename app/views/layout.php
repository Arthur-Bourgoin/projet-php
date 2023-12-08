<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <?php 
    if(isset($bsIcons) && $bsIcons === true) {
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">';
    }
    ?>
    <?= isset($scripts) ? $scripts : "" ?>
    <title><?= isset($title) ? $title : "Titre" ?></title>
</head>
<body class="vh-100 d-flex flex-column">
    <header class="">
        <div class="container">
            <div class="row bg-secondary">
                <h1 class="text-center">HEADER</h1>
            </div>
        </div>
    </header>
    <main>
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