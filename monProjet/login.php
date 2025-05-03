<?php
require_once("connexion.php");

if (isset($_SESSION["id"])) {
    header("Location: profil.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if ($email && $password) {
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute(["email" => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["mot_de_passe"])) {
            $_SESSION["id"] = $user["id"];
            $_SESSION["email"] = $user["email"];
            header("Location: profil.php");
            exit;
        } else {
            $message = "Email ou mot de passe incorrect.";
        }
    } else {
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
