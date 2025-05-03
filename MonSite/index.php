<?php
include 'config.php';

// Récupérer tous les personnages
$stmt = $pdo->query("SELECT * FROM characters");
$characters = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des cartes</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>Gestion des cartes</h1>

    <a href="ajouter.php">Ajouter un personnage</a>

    <div class="cards-container">
        <?php foreach ($characters as $character): ?>
            <div class="card">
                <h2><?= htmlspecialchars($character['name']) ?></h2>
                <p>Status : <?= $character['is_favorite'] ? 'Favori' : 'Non Favori' ?></p>
                <a href="modifier.php?id=<?= $character['id'] ?>">Modifier</a>
                <a href="supprimer.php?id=<?= $character['id'] ?>">Supprimer</a>
                <form method="POST" action="index.php">
                    <input type="hidden" name="id" value="<?= $character['id'] ?>">
                    <button type="submit" name="favorite">Marquer comme favori</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    if (isset($_POST['favorite'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("UPDATE characters SET is_favorite = NOT is_favorite WHERE id = :id");
        $stmt->execute(['id' => $id]);

        header("Location: index.php");

        exit;
    }
    ?>
</body>
</html>
