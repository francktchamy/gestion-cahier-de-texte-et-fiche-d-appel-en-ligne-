<?php

require 'db.php';
session_start();
include('header.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'enseignant') {
  header("Location: connexion.php");
  exit();
}

// Traitement du formulaire d'ajout de cours
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $enseignant_id = $_SESSION['user_id'];
  $classe_id = $_POST['classe_id'];
  $matiere = $_POST['matiere'];
  $heure_debut = $_POST['heure_debut'];
  $heure_fin = $_POST['heure_fin'];
  $module_cours = $_POST['module_cours'];
  $titre_lecon = $_POST['titre_lecon'];
  $competences = $_POST['competences'];

  if (isset($_FILES['support']) && $_FILES['support']['error'] === UPLOAD_ERR_OK) {
    $fichier = $_FILES['support'];
    $nom_fichier = basename($fichier['name']);
    $dossier_cible = 'uploads/';
    $chemin_fichier = $dossier_cible . $nom_fichier;

    if (move_uploaded_file($fichier['tmp_name'], $chemin_fichier)) {
      $stmt = $pdo->prepare("
        INSERT INTO cahier_texte (enseignant_id, classe_id, matiere, heure_debut, heure_fin, module_cours, titre_lecon, competences, support_path)
        VALUES (:enseignant_id, :classe_id, :matiere, :heure_debut, :heure_fin, :module_cours, :titre_lecon, :competences, :support_path)
      ");
      $stmt->execute([
        'enseignant_id' => $enseignant_id,
        'classe_id' => $classe_id,
        'matiere' => $matiere,
        'heure_debut' => $heure_debut,
        'heure_fin' => $heure_fin,
        'module_cours' => $module_cours,
        'titre_lecon' => $titre_lecon,
        'competences' => $competences,
        'support_path' => $chemin_fichier
      ]);

      echo "<div class='alert alert-success'>Cours ajouté avec succès !</div>";
    } else {
      echo "<div class='alert alert-danger'>Erreur lors du téléchargement du fichier.</div>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Ajouter un Cours</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <br>
  <br>
  <div class="container mt-5">
    <div class="col-md-6">
      <a href="appel.php"> <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAjoutClasse">
          -> Faire l'appel
        </button>
      </a>
    </div>
    <div class="card shadow">
      <div class="card-body">
        <h3 class="mb-4">Ajouter un Cours</h3>

        <form method="POST" enctype="multipart/form-data">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="classe_id" class="form-label">Classe</label>
              <select id="classe_id" name="classe_id" class="form-select" required>
                <option value="">Sélectionner une classe</option>
                <?php
                $stmt = $pdo->query("SELECT * FROM classes");
                while ($classe = $stmt->fetch()) {
                  echo "<option value='" . $classe['id'] . "'>" . htmlspecialchars($classe['nom']) . "</option>";
                }
                ?>
              </select>
            </div>

            <div class="col-md-6">
              <label for="matiere" class="form-label">Matière</label>
              <input type="text" id="matiere" name="matiere" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label for="heure_debut" class="form-label">Heure de début</label>
              <input type="time" id="heure_debut" name="heure_debut" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label for="heure_fin" class="form-label">Heure de fin</label>
              <input type="time" id="heure_fin" name="heure_fin" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label for="module_cours" class="form-label">Module du cours</label>
              <input type="text" id="module_cours" name="module_cours" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label for="titre_lecon" class="form-label">Titre de la leçon</label>
              <input type="text" id="titre_lecon" name="titre_lecon" class="form-control" required>
            </div>

            <div class="col-md-12">
              <label for="competences" class="form-label">Compétences visées</label>
              <textarea id="competences" name="competences" class="form-control" rows="3"></textarea>
            </div>

            <div class="col-md-12">
              <label for="support" class="form-label">Joindre un support de cours (PDF, DOCX, Image)</label>
              <input type="file" id="support" name="support" class="form-control" required>
            </div>
            <div class="col-md-6">
              <button type="submit" class="btn btn-primary">Ajouter le cours</button>
            </div>
            <!-- <div class="col-12 text-end">
              <button type="submit" class="btn btn-primary">Ajouter le cours</button>
            </div> -->
          </div>
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