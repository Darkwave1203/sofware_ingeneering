<?php

// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$database = "schoolmanagement";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$email = $_POST['email'];
$password = $_POST['password'];

// Requête SQL pour vérifier les identifiants
$sql = "SELECT id, first_name, last_name FROM students WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

// Vérifier si la requête a réussi
if ($result === false) {
    die("Erreur lors de l'exécution de la requête : " . $conn->error);
}

// Vérifier si des résultats ont été trouvés
if ($result->num_rows > 0) {
    // Authentification réussie
    $row = $result->fetch_assoc();
    $student_id = $row['id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];

    // Démarrer la session et stocker l'ID, prénom et nom de l'élève
    session_start();
    $_SESSION['student_id'] = $student_id;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;

    // Rediriger vers la page d'accueil de l'élève (ou une autre page de votre choix)
    header("Location: acc-student.php");
    exit();
} else {
    // Authentification échouée
    echo "false";
}

// Fermer la connexion à la base de données
$conn->close();

?>
