<?php
require_once("connexion.php");

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["action"]) && $_GET["action"] === "deconnexion") {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenue !</h1>
    <p>Vous êtes connecté avec l'adresse email : <strong><?php echo htmlspecialchars($_SESSION["email"]); ?></strong></p>

    <a href="?action=deconnexion">Se déconnecter</a>
</body>
</html>
