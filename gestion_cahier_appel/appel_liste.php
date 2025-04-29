<?php
require 'db.php';
include('header.php');
session_start();

// if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'enseignant') {
//     header("Location: connexion.php");
//     exit();
// }

$seance_id = $_GET['seance_id'] ?? null;
if (!$seance_id) {
    header("Location: appel.php");
    exit();
}

// Trouver la classe liée à la séance
$stmt = $pdo->prepare("SELECT classe_id FROM cahier_texte WHERE id = :id");
$stmt->execute(['id' => $seance_id]);
$classe_id = $stmt->fetchColumn();

$eleves = $pdo->prepare("SELECT * FROM users WHERE role = 'eleve' AND classe_id = :classe_id");
$eleves->execute(['classe_id' => $classe_id]);

// Traitement si formulaire soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['presence'] as $eleve_id => $valeur) {
        $present = $valeur === "1" ? 1 : 0;
        $stmt = $pdo->prepare("INSERT INTO presences (cahier_texte_id, eleve_id, present) 
                               VALUES (:cahier_texte_id, :eleve_id, :present)");
        $stmt->execute([
            'cahier_texte_id' => $seance_id,
            'eleve_id' => $eleve_id,
            'present' => $present
        ]);
    }

    echo "<br><br><div class='alert alert-success text-center m-4'>Appel enregistré avec succès !</div>";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste de présence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <br>
    <div class="container mt-4">
        <div class="col-md-6">
            <a href="appel.php"> <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAjoutClasse">
                    <- Retour
                        </button>
            </a>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <h3 class="mb-4">Liste de présence</h3>
                <form method="POST">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom & Prénom</th>
                                <th>Présent</th>
                                <th>Absent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($eleve = $eleves->fetch()): ?>
                                <tr>
                                    <td><?= $eleve['nom'] . ' ' . $eleve['prenom'] ?></td>
                                    <td><input type="radio" name="presence[<?= $eleve['id'] ?>]" value="1" required></td>
                                    <td><input type="radio" name="presence[<?= $eleve['id'] ?>]" value="0" required></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Enregistrer l’appel</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>