<?php
// Connexion à la base de données (assurez-vous de configurer correctement vos paramètres de base de données)
$servername = "localhost";
$username = "votre_nom_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "votre_base_de_donnees";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Traitement des actions sur le panier (ajout, suppression, etc.)
// Vous devez implémenter la logique appropriée ici

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>
<body>
    <h2>Panier</h2>

    <!-- Affichage du contenu du panier -->
    <?php
    // Exemple d'affichage des éléments du panier
    $sql = "SELECT * FROM panier";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Nom du plat: " . $row["nom_plat"] . " - Quantité: " . $row["quantite"] . " - Prix unitaire: " . $row["prix_unitaire"] . " - Total: " . $row["prix_total"] . "<br>";
            // Ajoutez d'autres détails du panier selon vos besoins
        }
    } else {
        echo "Le panier est vide.";
    }
    ?>

    <!-- Formulaire pour modifier ou supprimer des éléments du panier -->
    <form method="post" action="update_cart.php">
        <!-- Ajoutez des champs pour la modification ou la suppression des articles du panier -->
        <input type="submit" value="Mettre à jour le panier">
    </form>

    <?php
    // Fermer la connexion à la base de données
    $conn->close();
    ?>
</body>
</html>
