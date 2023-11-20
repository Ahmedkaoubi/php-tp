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

// Traitement de la recherche de plats
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $ingredient = $_POST['ingredient'];
    $nomPlat = $_POST['nom_plat'];
    $prixMin = $_POST['prix_min'];
    $prixMax = $_POST['prix_max'];
    $paysOrigine = $_POST['pays_origine'];

    // Construction de la requête SQL en fonction des critères de recherche
    $sql = "SELECT * FROM plats WHERE ";

    if (!empty($ingredient)) {
        $sql .= "ingredient LIKE '%$ingredient%' AND ";
    }

    if (!empty($nomPlat)) {
        $sql .= "nom_plat LIKE '%$nomPlat%' AND ";
    }

    if (!empty($prixMin)) {
        $sql .= "prix >= $prixMin AND ";
    }

    if (!empty($prixMax)) {
        $sql .= "prix <= $prixMax AND ";
    }

    if (!empty($paysOrigine)) {
        $sql .= "pays_origine = '$paysOrigine' AND ";
    }

    // Supprimer le "AND" final de la requête
    $sql = rtrim($sql, " AND ");

    // Exécuter la requête SQL
    $result = $conn->query($sql);

    // Affichage des résultats
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Nom du plat: " . $row["nom_plat"] . " - Prix: " . $row["prix"] . "<br>";
            // Ajoutez d'autres détails du plat selon vos besoins
        }
    } else {
        echo "Aucun résultat trouvé.";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de plats</title>
</head>
<body>
    <h2>Recherche de plats</h2>
    
    <!-- Formulaire de recherche -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="ingredient">Ingrédient:</label>
        <input type="text" name="ingredient">

        <label for="nom_plat">Nom du plat:</label>
        <input type="text" name="nom_plat">

        <label for="prix_min">Prix minimum:</label>
        <input type="number" name="prix_min">

        <label for="prix_max">Prix maximum:</label>
        <input type="number" name="prix_max">

        <label for="pays_origine">Pays d'origine:</label>
        <input type="text" name="pays_origine">

        <input type="submit" value="Rechercher">
    </form>
</body>
</html>
