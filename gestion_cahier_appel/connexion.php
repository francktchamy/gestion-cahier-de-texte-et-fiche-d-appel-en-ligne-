<?php session_start();
include('header_login.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .form-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .form-control {
            padding-left: 2.5rem;
        }

        .card {
            border: none;
        }

        .card-body {
            padding: 2rem;
        }

        body {
            padding-top: 80px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow rounded-4">
            <div class="card-body">
                <h2 class="text-center mb-4"><i class="bi bi-box-arrow-in-right me-2"></i>Connexion</h2>

                <?php if (isset($_GET['erreur'])): ?>
                    <div class="alert alert-danger">Identifiants incorrects !</div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <div class="mb-3 position-relative">
                        <i class="bi bi-envelope form-icon"></i>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="mb-3 position-relative">
                        <i class="bi bi-lock form-icon"></i>
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 ">
                        <i class="bi bi-check2-circle me-1"></i>Se connecter
                    </button>
                </form>

                <p class="mt-3 text-center">
                    <i class="bi bi-person-plus"></i> Pas encore de compte ?
                    <a href="inscription.php">S'inscrire</a>
                </p>
            </div>
        </div>
    </div>
    <br>

</body>


</html>