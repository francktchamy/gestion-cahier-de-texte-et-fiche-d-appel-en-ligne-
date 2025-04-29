<?php
require 'db.php';
session_start();
include 'header.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'parent') {
    header("Location: connexion.php");
    exit();
}

$infos = [];
$recherche = $_GET['recherche'] ?? '';
$eleve = null;
if ($recherche) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE role = 'eleve' AND (nom LIKE :term OR prenom LIKE :term)");
    $stmt->execute(['term' => "%$recherche%"]);
    $eleve = $stmt->fetch();

    if ($eleve) {
        $classe_id = $eleve['classe_id'];
        $eleve_id = $eleve['id'];

        $stmt = $pdo->prepare("
           SELECT s.titre_lecon, s.date_seance, s.heure_debut, s.heure_fin, p.present
            FROM cahier_texte s
            LEFT JOIN presences p ON s.id = p.cahier_texte_id AND p.eleve_id = :eleve_id
            WHERE s.classe_id = :classe_id
            ORDER BY s.date_seance DESC
        ");
        $stmt->execute([
            'eleve_id' => $eleve_id,
            'classe_id' => $classe_id
        ]);
        $infos = $stmt->fetchAll();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Suivi de présence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero-banner {
            position: relative;
            background: linear-gradient(rgba(85, 103, 123, 0.4), rgba(112, 131, 152, 0.6)),
                url('img/parentStation.jpeg') no-repeat center center/cover;
            color: white;
            height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            animation: fadeIn 1.5s ease-in-out;
        }

        .hero-banner h1 {
            font-size: 2.8rem;
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
        <h1>Suivi de la présence de votre enfant</h1>
    </div>

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4">Vérifier la présence de votre enfant</h3>

                <form method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="recherche" class="form-control" placeholder="Nom ou prénom de l’élève" value="<?= htmlspecialchars($recherche) ?>" required>
                        <button class="btn btn-primary">Rechercher</button>
                    </div>
                </form>

                <?php if ($recherche && !$eleve): ?>
                    <div class="alert alert-danger">Aucun élève trouvé avec ce nom.</div>
                <?php elseif ($eleve): ?>
                    <h5 class="mb-3">Résultats pour <strong><?= $eleve['nom'] . ' ' . $eleve['prenom'] ?></strong> (Classe ID: <?= $eleve['classe_id'] ?>)</h5>
                    <table class="table table-bordered">
                        <thead>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Heure Début</th>
                                    <th>Heure Fin</th>
                                    <th>Leçon</th>
                                    <th>Présence</th>
                                </tr>
                            </thead>

                        </thead>
                        <tbody>
                            <?php foreach ($infos as $ligne): ?>
                                <tr>
                                    <td><?= $ligne['date_seance'] ?></td>
                                    <td><?= $ligne['heure_debut'] ?></td>
                                    <td><?= $ligne['heure_fin'] ?></td>
                                    <td><?= $ligne['titre_lecon'] ?></td>
                                    <td>
                                        <?php
                                        if (is_null($ligne['present'])) {
                                            echo "<span class='text-warning'>Non renseigné</span>";
                                        } elseif ($ligne['present']) {
                                            echo "<span class='text-success fw-bold'>Présent</span>";
                                        } else {
                                            echo "<span class='text-danger fw-bold'>Absent</span>";
                                        }
                                        ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
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