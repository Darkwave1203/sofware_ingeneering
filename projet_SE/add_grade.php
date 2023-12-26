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

// Récupérez les données du formulaire
$student_id = $_POST['student_id'];
$subject = $_POST['subject'];
$grade = $_POST['grade'];

// Assurez-vous de valider et de sécuriser les données avant de les insérer dans la base de données

// Ajoutez la note à la base de données
$sqlAddGrade = "INSERT INTO grades (student_id, subject, grade) VALUES ($student_id, '$subject', $grade)";

if ($conn->query($sqlAddGrade) === TRUE) {
    header("Location: teacher_dashboard.php?message=Note%20ajoutée%20avec%20succès");
    exit();
} else {
    echo "Erreur lors de l'ajout de la note : " . $conn->error;
}

// Fermez la connexion à la base de données
$conn->close();
?>
