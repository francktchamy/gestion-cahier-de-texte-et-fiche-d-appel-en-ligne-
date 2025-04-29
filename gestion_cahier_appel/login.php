<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        // Connexion réussie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['role'] = $user['role'];

        // Redirection selon le rôle
        switch ($user['role']) {
            case 'enseignant':
                header("Location: ajouter_seance.php");
                break;
            case 'eleve':
                header("Location: eleve_cours.php");
                break;
            case 'parent':
                header("Location: presence_parent.php");
                break;
            case 'censeur':
                header("Location: censeur_approuve.php");
                break;
            default:
                header("Location: connexion.php?erreur=1");
        }
        exit();
    } else {
        header("Location: connexion.php?erreur=1");
        exit();
    }
}
