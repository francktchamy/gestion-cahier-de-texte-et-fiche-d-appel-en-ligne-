<?php
require 'db.php';
session_start();
include('header.php');
// Vérification si l'utilisateur est connecté et a le rôle autorisé
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['censeur', 'enseignant'])) {
    header("Location: connexion.php");
    exit();
}

// Traitement du formulaire
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_classe = trim($_POST['nom_classe']);
    if (!empty($nom_classe)) {
        $stmt = $pdo->prepare("INSERT INTO classes (nom) VALUES (:nom)");
        $stmt->execute(['nom' => $nom_classe]);
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une classe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-banner {
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)),
                url('img/photo.jpg') no-repeat center center/cover;
            color: white;
            height: 280px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        .hero-banner h1 {
            font-size: 2.5rem;
            font-weight: bold;
            animation: zoomIn 1.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="bg-light">

    <!-- Bannière animée -->
    <div class="hero-banner">
        <h1>Créer une nouvelle classe</h1>
    </div>

    <div class="container mt-5">
        <a href="censeur_approuve.php" class="btn btn-link">
            <button class="btn btn-success mb-3">
                ← Retour
            </button>
        </a>
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4">Ajouter une classe</h3>

                <?php if ($success): ?>
                    <div class="alert alert-success">Classe ajoutée avec succès !</div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Nom de la classe</label>
                        <input type="text" name="nom_classe" class="form-control" required placeholder="Ex: 6ème A, Terminale C">
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>

    <br>
    <br>
    <?php
    include('footer.php');
    ?>

</body>

</html>