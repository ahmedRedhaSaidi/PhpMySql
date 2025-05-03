<?php
// On importe le fichier contenant la connexion à la base de données ($pdo) et on démarre la session
require_once("connexion.php");

// Vérifie si l'utilisateur est déjà connecté
// Si une session avec un identifiant utilisateur existe, on le redirige directement vers la page de profil
if (isset($_SESSION["id"])) {
    header("Location: profil.php"); // Redirection vers la page profil
    exit; // Arrêt du script après redirection
}

// Variable pour stocker les éventuels messages d’erreur ou de validation
$message = "";

// On vérifie si le formulaire a été soumis (c’est-à-dire si la requête est de type POST)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // On récupère et nettoie les champs email et mot de passe envoyés par l'utilisateur
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Si les deux champs sont remplis
    if ($email && $password) {
        // Préparation d'une requête SQL pour récupérer l'utilisateur correspondant à l'email donné
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        
        // Exécution de la requête avec l'email fourni par l'utilisateur
        $stmt->execute(["email" => $email]);
        
        // On récupère le résultat sous forme de tableau associatif
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si un utilisateur est trouvé et que le mot de passe correspond (après vérification avec password_verify)
        if ($user && password_verify($password, $user["mot_de_passe"])) {
            // On crée une session avec les informations importantes (id et email)
            $_SESSION["id"] = $user["id"];
            $_SESSION["email"] = $user["email"];
            
            // Redirection vers la page profil après connexion réussie
            header("Location: profil.php");
            exit;
        } else {
            // Si l’email ou le mot de passe est incorrect, on affiche un message d’erreur
            $message = "Email ou mot de passe incorrect.";
        }
    } else {
        // Si au moins un champ est vide, on demande à l’utilisateur de les remplir
        $message = "Veuillez remplir tous les champs.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Connexion</h1>

    <?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>
    <div class="container" >
        <form method="POST">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="Email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>

            <input type="submit" value="Connexion">
        </form>
    <a href="inscriotion.php">s'inscrire</a>
    </div>
</body>
</html>
