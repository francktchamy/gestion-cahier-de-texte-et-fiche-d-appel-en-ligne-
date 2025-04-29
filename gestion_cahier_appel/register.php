<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $classe_id = !empty($_POST['classe_id']) ? $_POST['classe_id'] : NULL;

    $sql = "INSERT INTO users (nom, prenom, email, mot_de_passe, role, classe_id)
            VALUES (:nom, :prenom, :email, :mot_de_passe, :role, :classe_id)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'mot_de_passe' => $password,
        'role' => $role,
        'classe_id' => $classe_id
    ]);

    header("Location: inscription.php?success=1");
    exit();
}
?>
