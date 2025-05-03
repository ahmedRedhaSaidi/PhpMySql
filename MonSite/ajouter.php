<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    
    // Ajouter le personnage
    $stmt = $pdo->prepare("INSERT INTO characters (name, is_favorite) VALUES (:name, 0)");
    $stmt->execute(['name' => $name]);
    
    header("Location: index.php"); // Redirige vers la page d'accueil
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un personnage</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Ajouter un personnage</h1>
    <div class="container">
    <form method="POST">
        <label for="name">Nom du personnage :</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Ajouter</button>
    </form>
    </div>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>
