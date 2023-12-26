<?php
session_start();

// Vérifiez si l'enseignant est connecté
if (!isset($_SESSION['teacher_id'])) {
    header("Location: teacher_login.html");
    exit();
}

// Incluez le code de connexion à votre base de données ici
$servername = "localhost";
$username = "root";
$password = "root";
$database = "schoolmanagement";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Traitez le formulaire pour ajouter une note
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $subject = $_POST['subject']; // Récupérez la matière depuis le formulaire
    $grade = $_POST['grade'];

    // Assurez-vous de valider et de sécuriser les données avant de les insérer dans la base de données
    $column_name = strtolower(str_replace(' ', '_', $subject)) . "_grade"; // Génère le nom de colonne correct
    $sqlAddGrade = "UPDATE grades SET $column_name = $grade WHERE student_id = $student_id";

    if ($conn->query($sqlAddGrade) === TRUE) {
        header("Location:grades.php?message=Note%20ajoutée%20avec%20succès");
        exit();
    } else {
        echo "Erreur lors de l'ajout de la note : " . $conn->error;
    }
}

// Fermez la connexion à la base de données
$conn->close();
?>
