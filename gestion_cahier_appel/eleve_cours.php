<?php
require 'db.php';
session_start();
include 'header.php';

// Vérifier que l'utilisateur est bien un élève
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'eleve') {
    header("Location: connexion.php");
    exit();
}

// Initialisation des variables
$classe_id = null;
$cours = [];

// Recherche des cours en fonction de la classe
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['classe_id'])) {
    $classe_id = $_POST['classe_id'];

    // Requête pour récupérer les cours associés à la classe de l'élève
    $stmt = $pdo->prepare("
        SELECT c.*, u.nom AS enseignant_nom, u.prenom AS enseignant_prenom, cl.nom AS classe_nom 
        FROM cahier_texte c
        JOIN users u ON c.enseignant_id = u.id
        JOIN classes cl ON c.classe_id = cl.id
        WHERE c.classe_id = :classe_id
    ");
    $stmt->execute(['classe_id' => $classe_id]);
    $cours = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours de l'élève</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-banner {
            position: relative;
            background: linear-gradient(rgba(80, 108, 114, 0.5), rgba(78, 89, 101, 0.7)),
                url('img/photoSpaceEleve.jpeg') no-repeat center center/cover;
            color: white;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        .hero-banner h1 {
            font-size: 3rem;
            animation: zoomIn 1.5s ease;
            font-weight: bold;
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
        <h1>Bienvenue dans votre espace élève</h1>
    </div>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4">Rechercher vos cours</h3>

                <!-- Formulaire pour rechercher la classe -->
                <form method="POST">
                    <div class="mb-3">
                        <label for="classe_id" class="form-label">Choisir une classe</label>
                        <select name="classe_id" id="classe_id" class="form-select" required>
                            <option value="">Sélectionnez une classe</option>
                            <?php
                            // Récupérer les classes de l'élève
                            $stmt = $pdo->prepare("SELECT id, nom FROM classes");
                            $stmt->execute();
                            $classes = $stmt->fetchAll();
                            foreach ($classes as $classe) {
                                echo "<option value='{$classe['id']}'>{$classe['nom']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>

                <?php if ($classe_id && !empty($cours)): ?>
                    <h3 class="mt-5">Cours de la classe : <?= htmlspecialchars($cours[0]['classe_nom']) ?></h3>

                    <!-- Affichage des cours -->
                    <table class="table table-striped table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Titre de la leçon</th>
                                <th>Enseignant</th>
                                <th>Date</th>
                                <th>Compétences</th>
                                <th>Support de cours</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cours as $cours_item): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cours_item['titre_lecon']) ?></td>
                                    <td><?= htmlspecialchars($cours_item['enseignant_nom'] . ' ' . $cours_item['enseignant_prenom']) ?></td>
                                    <td><?= htmlspecialchars($cours_item['date_seance']) ?></td>
                                    <td><?= htmlspecialchars($cours_item['competences']) ?></td>
                                    <td>
                                        <?php if ($cours_item['support_path']): ?>
                                            <a href="<?= htmlspecialchars($cours_item['support_path']) ?>" class="btn btn-sm btn-success" download>Télécharger</a>
                                        <?php else: ?>
                                            <span class="text-muted">Aucun support</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php elseif ($classe_id): ?>
                    <p>Aucun cours trouvé pour cette classe.</p>
                <?php endif; ?>

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