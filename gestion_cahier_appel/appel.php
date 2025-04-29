<?php
require 'db.php';

session_start();
include('header.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'enseignant') {
    header("Location: connexion.php");
    exit();
}

$enseignant_id = $_SESSION['user_id'];

$seances = $pdo->prepare("
    SELECT s.id, c.nom AS classe_nom, s.titre_lecon 
    FROM cahier_texte s 
    JOIN classes c ON s.classe_id = c.id
    WHERE s.enseignant_id = :id
    ORDER BY s.id DESC
");
$seances->execute(['id' => $enseignant_id]);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Faire l’appel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-banner {
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)),
                url('img/appel.jpg') no-repeat center center/cover;
            color: white;
            height: 250px;
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
        <h1>Faire l’appel</h1>
    </div>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4">Sélectionnez une séance</h3>

                <form method="GET" action="appel_liste.php">
                    <div class="mb-3">
                        <label class="form-label">Choisir une séance</label>
                        <select name="seance_id" class="form-select" required>
                            <option value="">-- Sélectionner une séance --</option>
                            <?php while ($s = $seances->fetch()): ?>
                                <option value="<?= $s['id'] ?>">
                                    <?= htmlspecialchars($s['classe_nom']) ?> - <?= htmlspecialchars($s['titre_lecon']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Continuer</button>
                </form>
            </div>
        </div>
    </div>
    <br>
    <br>
    <?php include('footer.php'); ?>
</body>

</html>