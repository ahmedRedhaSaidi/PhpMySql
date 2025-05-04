<?php
// On inclut le fichier de connexion à la base de données
require_once("connexion.php");

// On vérifie si le formulaire a été soumis via la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // On récupère les données du formulaire en supprimant les espaces inutiles
    $email = trim($_POST["email"]);
    $motDePasse = trim($_POST["mot_de_passe"]);

    // On vérifie que les deux champs ont été remplis
    if ($email && $motDePasse) {

        // On chiffre le mot de passe avec l'algorithme par défaut
        $hash = password_hash($motDePasse, PASSWORD_DEFAULT);

        // On prépare la requête SQL pour insérer un nouvel utilisateur dans la base de données
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (email, mot_de_passe) VALUES (:email, :mot_de_passe)");

        try {
            // On exécute la requête avec les valeurs sécurisées 
            $stmt->execute([
                "email" => $email,
                "mot_de_passe" => $hash
            ]);

            // Si tout se passe bien, on affiche un message de confirmation
            echo "Utilisateur ajouté avec succès !";

        } catch (PDOException $e) {
            // Si une erreur survient, on l'affiche
            echo "Erreur : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
    <body>
        <div class="container" >
            <form method="POST">
                <label>Email :</label>
                <input type="email" name="email" required><br>

                <label>Mot de passe :</label>
                <input type="password" name="mot_de_passe" required><br>

                <input type="submit" value="S'inscrire">
            </form>
        </div>
    </body>
</html>