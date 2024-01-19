<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="/assets/js/connexion.js" type="module"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Connexion</title>
    <style>
        body {
            background-image: url(/assets/images/bg.jpg);
            background-position: center;
            background-size: cover;
        }

        input::placeholder {
            color: white !important;
        }

        .divInput input, .divInput span {
            background: rgba(255, 255, 255, 0.25);
            color: white !important;
        }

        .divInput:hover input, .divInput:hover span {
            background: rgba(255, 255, 255, 0);
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0);
        }

        button {
            background-color: #fbceb5 !important;
        }
    </style>
</head>
<body>
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 d-flex justify-content-center">
            <div class="col-5">
                <h1 class="text-white text-center mb-5">Connectez vous</h1>
                <?= \app\class\Feedback::getMessage() ?>
                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="POST">
                    <div class="divInput mb-4">
                        <input id="login" type="text" class="form-control form-control-lg rounded-pill" placeholder="Identifiant" name="login">
                    </div>
                    <div class="divInput input-group mb-5">
                        <input id="pwd" type="password" class="form-control form-control-lg rounded-start-pill" placeholder="Mot de passe" name="pwd">
                        <span class="input-group-text rounded-end-pill" role="button"><i class="bi bi-eye"></i></span>
                    </div>
                    <button class="btn rounded-pill w-100 py-2">
                        SE CONNECTER
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>