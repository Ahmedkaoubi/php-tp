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

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $code = $_POST['code'];
    $motDePasse = $_POST['mot_de_passe'];

    // Requête SQL pour vérifier l'authentification
    $sql = "SELECT * FROM clients WHERE code = '$code' AND mot_de_passe = '$motDePasse'";
    $result = $conn->query($sql);

    // Vérification des résultats de la requête
    if ($result->num_rows > 0) {
        // Authentification réussie, redirigez vers la page de recherche
        header("Location: search.php");
        exit();
    } else {
        // Authentification échouée, affichez un message d'erreur
        echo "Code ou mot de passe incorrect.";
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
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    
    <!-- Formulaire de connexion -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="code">Code:</label>
        <input type="text" name="code" required>

        <label for="mot_de_passe">Mot de passe:</label>
        <input type="password" name="mot_de_passe" required>

        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
