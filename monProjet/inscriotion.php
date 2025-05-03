<?php
require_once("connexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $motDePasse = trim($_POST["mot_de_passe"]);

    if ($email && $motDePasse) {
        $hash = password_hash($motDePasse, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (email, mot_de_passe) VALUES (:email, :mot_de_passe)");

        try {
            $stmt->execute(["email" => $email, "mot_de_passe" => $hash]);
            echo "Utilisateur ajouté avec succès !";
        } catch (PDOException $e) {
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