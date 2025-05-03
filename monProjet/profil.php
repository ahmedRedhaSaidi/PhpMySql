
<?php
// On importe le fichier qui contient la connexion à la base de données et démarre la session si ce n’est pas déjà fait
require_once("connexion.php");

// Vérifie si l'utilisateur est connecté en regardant si une session avec l'identifiant "id" existe
// Si ce n'est pas le cas, on le redirige vers la page de connexion
if (!isset($_SESSION["id"])) {
    header("Location: login.php"); // Redirige l'utilisateur vers login.php
    exit; // Arrête l'exécution du script
}

// Vérifie si l'utilisateur a cliqué sur le lien de déconnexion
// Cela se fait en vérifiant si l'URL contient ?action=deconnexion
if (isset($_GET["action"]) && $_GET["action"] === "deconnexion") {
    session_unset(); // Supprime toutes les variables de session en cours
    session_destroy(); // Détruit complètement la session
    header("Location: login.php"); // Redirige vers la page de connexion après déconnexion
    exit; // Arrête l'exécution du script
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css"> <!-- On lie le fichier CSS pour le style -->
</head>
<body>
    <h1>Bienvenue !</h1>

    <!-- On affiche l'adresse email de l'utilisateur connectée de manière sécurisée -->
    <p>Vous êtes connecté avec l'adresse email : <strong><?php echo htmlspecialchars($_SESSION["email"]); ?></strong></p>

    <!-- Lien pour se déconnecter (envoie "action=deconnexion" dans l'URL) -->
    <a href="?action=deconnexion">Se déconnecter</a>
</body>
</html>

