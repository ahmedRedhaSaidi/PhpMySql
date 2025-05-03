<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $is_favorite = isset($_POST['is_favorite']) ? 1 : 0;

    // Modifier la carte
    $stmt = $pdo->prepare("UPDATE characters SET name = :name, is_favorite = :is_favorite WHERE id = :id");
    $stmt->execute(['id' => $id, 'name' => $name, 'is_favorite' => $is_favorite]);

    header("Location: index.php");
    exit;
}

// Récupérer l'id du personnage à modifier
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM characters WHERE id = :id");
$stmt->execute(['id' => $id]);
$character = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un personnage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Modifier le personnage</h1>
    <div class="container">
    <form method="POST">
        <input type="hidden" name="id" value="<?= $character['id'] ?>">
        <label for="name">Nom du personnage :</label>
        <input type="text" id="name" name="name" value="<?= $character['name'] ?>" required>
        <label for="is_favorite">Favori :</label>
        <input type="checkbox" name="is_favorite" <?= $character['is_favorite'] ? 'checked' : '' ?>>
        <button type="submit">Modifier</button>
    </form>
    </div>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>
