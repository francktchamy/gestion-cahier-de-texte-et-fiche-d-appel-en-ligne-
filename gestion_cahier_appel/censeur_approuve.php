<?php
require 'db.php';
session_start();
include('header.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'censeur') {
    header("Location: connexion.php");
    exit();
}

// Approuver une séance si requête POST reçue
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cahier_texte_id'])) {
    $stmt = $pdo->prepare("UPDATE cahier_texte SET approuve = 1 WHERE id = :id");
    $stmt->execute(['id' => $_POST['cahier_texte_id']]);
}

// Récupération de toutes les séances
$seances = $pdo->query("
    SELECT s.*, c.nom AS classe_nom, u.nom AS enseignant_nom, u.prenom AS enseignant_prenom 
    FROM cahier_texte s
    JOIN classes c ON s.classe_id = c.id
    JOIN users u ON s.enseignant_id = u.id
    ORDER BY s.date_seance DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Validation des séances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>



<body class="bg-light">
    <br>
    <br>
    <div class="container mt-5">
        <a href="ajouter_classe.php"> <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAjoutClasse">
                + Ajouter une classe
            </button>
            <a href="presence_par_classe.php"> <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAjoutClasse">
                    |_| Liste presence
                </button>
            </a>
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="mb-4">Liste des séances à valider</h3>

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Classe</th>
                                <th>Enseignant</th>
                                <th>Leçon</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($seances as $s): ?>
                                <tr>
                                    <td><?= htmlspecialchars($s['classe_nom']) ?></td>
                                    <td><?= htmlspecialchars($s['enseignant_nom'] . ' ' . $s['enseignant_prenom']) ?></td>
                                    <td><?= htmlspecialchars($s['titre_lecon']) ?></td>
                                    <td><?= htmlspecialchars($s['date_seance']) ?></td>
                                    <td>
                                        <?php if ($s['approuve']): ?>
                                            <span class="badge bg-success">Approuvé</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">En attente</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!$s['approuve']): ?>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="cahier_texte_id" value="<?= $s['id'] ?>">
                                                <button type="submit" class="btn btn-sm btn-primary">Approuver</button>
                                            </form>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-secondary" disabled>Déjà approuvé</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
    </div>

</body>

</html>