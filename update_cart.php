<?php
session_start();

$servername = "localhost";
$username = "votre_nom_utilisateur";
$password = "votre_mot_de_passe";
$dbname = "votre_base_de_donnees";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if (!isset($_SESSION['code'])) {
    header("Location: login.php");
    $conn->close();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        
        switch ($action) {
            case 'ajout':
              
                if (isset($_POST['plat_id']) && isset($_POST['quantite'])) {
                    $platId = $_POST['plat_id'];
                    $quantite = $_POST['quantite'];
                    
                }
                break;
            case 'suppression':
                
                if (isset($_POST['plat_id'])) {
                    $platId = $_POST['plat_id'];
                    $deleteSql = "DELETE FROM panier WHERE plat_id = $platId AND code = " . $_SESSION['code'];
                    $conn->query($deleteSql);
                }
                break;
            
        }
    }
}


$conn->close();


header("Location: cart.php");
exit();
?>
