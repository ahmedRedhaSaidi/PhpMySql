<?php
include 'config.php';
// verifie si la variable existe 
if (isset($_GET['id'])) {
    //atribution
    $id = $_GET['id'];

    // Supprimer le personnage
    $stmt = $pdo->prepare("DELETE FROM characters WHERE id = :id"); //commande sql
    $stmt->execute(['id' => $id]); // execution

    header("Location: index.php");  // affichage 
    exit; // fin d'execution
}
?>
