<?php require 'db.php';
include('header_login.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
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

        .form-control,
        .form-select {
            padding-left: 2.5rem;
        }

        .card {
            border: none;
        }

        .card-body {
            padding: 2rem;
        }
    </style>
</head>
</br>
</br>
</br>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow rounded-4">
            <div class="card-body">
                <h2 class="text-center mb-4"><i class="bi bi-person-plus-fill me-2"></i>Inscription</h2>

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">Inscription réussie !</div>
                <?php endif; ?>

                <form method="POST" action="register.php">
                    <div class="row">
                        <div class="col-md-6 mb-3 position-relative">
                            <i class="bi bi-person form-icon"></i>
                            <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                        </div>

                        <div class="col-md-6 mb-3 position-relative">
                            <i class="bi bi-person form-icon"></i>
                            <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
                        </div>

                        <div class="col-md-6 mb-3 position-relative">
                            <i class="bi bi-envelope form-icon"></i>
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>

                        <div class="col-md-6 mb-3 position-relative">
                            <i class="bi bi-lock form-icon"></i>
                            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                        </div>

                        <div class="col-md-6 mb-3 position-relative">
                            <i class="bi bi-person-gear form-icon"></i>
                            <select name="role" class="form-select" required onchange="toggleClasse(this.value)">
                                <option value="">-- Rôle --</option>
                                <option value="enseignant">Enseignant</option>
                                <option value="eleve">Élève</option>
                                <option value="parent">Parent</option>
                                <option value="censeur">Censeur</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3 position-relative" id="classeDiv" style="display: none;">
                            <i class="bi bi-book form-icon"></i>
                            <select name="classe_id" class="form-select">
                                <option value="">-- Classe --</option>
                                <?php
                                $classes = $pdo->query("SELECT id, nom FROM classes");
                                while ($classe = $classes->fetch()) {
                                    echo "<option value='{$classe['id']}'>{$classe['nom']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        <i class="bi bi-check-circle me-1"></i>S'inscrire
                    </button>
                    <a href="connexion.php" class="btn btn-link mt-2">
                        <i class="bi bi-arrow-left-circle me-1"></i>j'ai déjà un compte
                    </a>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleClasse(role) {
            const classeDiv = document.getElementById('classeDiv');
            if (role === 'eleve' || role === 'enseignant') {
                classeDiv.style.display = 'block';
            } else {
                classeDiv.style.display = 'none';
            }
        }
    </script>
    <br>
    <br>
    <?php
    include('footer.php');
    ?>
</body>

</html>