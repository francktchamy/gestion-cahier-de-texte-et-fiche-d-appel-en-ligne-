<?php
require 'db.php';
session_start();
include 'header.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'censeur') {
    header("Location: connexion.php");
    exit();
}

$classes = $pdo->query("SELECT * FROM classes")->fetchAll();
$classe_id = $_GET['classe_id'] ?? null;
$eleves = [];
$presences = [];

if ($classe_id) {
    // Récupérer les élèves de cette classe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE role = 'eleve' AND classe_id = ?");
    $stmt->execute([$classe_id]);
    $eleves = $stmt->fetchAll();

    // Récupérer toutes les séances de cette classe
    $stmt = $pdo->prepare("
        SELECT ct.id as seance_id, ct.titre_lecon, ct.date_seance, ct.heure_debut, ct.heure_fin
        FROM cahier_texte ct
        WHERE ct.classe_id = ?
        ORDER BY ct.date_seance DESC
    ");
    $stmt->execute([$classe_id]);
    $seances = $stmt->fetchAll();

    // Récupérer les présences pour chaque élève et chaque séance
    foreach ($eleves as $eleve) {
        foreach ($seances as $seance) {
            $stmt = $pdo->prepare("SELECT present FROM presences WHERE eleve_id = ? AND cahier_texte_id = ?");
            $stmt->execute([$eleve['id'], $seance['seance_id']]);
            $presence = $stmt->fetchColumn();
            $presences[$eleve['id']][$seance['seance_id']] = $presence;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste de présence par classe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<br>
<br>

<body class="bg-light">

    <div class="container mt-5">
        <div class="container mt-5">
            <a href="censeur_approuve.php"> <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAjoutClasse">
                    <- Retour
                        </button>
            </a>
            <h2>Liste des présences par classe</h2>
            <form method="GET" class="mb-3">
                <select name="classe_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Choisir une classe</option>
                    <?php foreach ($classes as $classe): ?>
                        <option value="<?= $classe['id'] ?>" <?= ($classe['id'] == $classe_id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($classe['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <?php if ($classe_id): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Élève</th>
                            <?php foreach ($seances as $seance): ?>
                                <th><?= date('d/m/y', strtotime($seance['date_seance'])) ?><br><?= htmlspecialchars($seance['titre_lecon']) ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eleves as $eleve): ?>
                            <tr>
                                <td><?= htmlspecialchars($eleve['nom'] . ' ' . $eleve['prenom']) ?></td>
                                <?php foreach ($seances as $seance): ?>
                                    <td>
                                        <?php
                                        $p = $presences[$eleve['id']][$seance['seance_id']] ?? null;
                                        if (is_null($p)) echo '<span class="text-warning">N/R</span>';
                                        elseif ($p) echo '<span class="text-success">✔</span>';
                                        else echo '<span class="text-danger">✘</span>';
                                        ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>


</body>

</html>