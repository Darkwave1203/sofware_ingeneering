<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['student_id'], $_SESSION['first_name'], $_SESSION['last_name'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php"); // Adjust the login page URL as needed
    exit();
}

// Access the session variables
$student_id = $_SESSION['student_id'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Étudiant - School Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>School Management</h1>
        </div>
        <nav>
            <ul>
                <li><a href="acc-student.php">Accueil</a></li>
                <li><a href="emploi-temps.html">Emploi du temps</a></li>
                <li><a href="notes.html">Notes</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        
        <section class="welcome-section">
            <h2>Bienvenue, <?php echo $first_name . ' ' . $last_name; ?></h2>
            <p>Accédez à toutes vos informations scolaires en un clic.</p>
        </section>


        <section class="dashboard">
            <div class="dashboard-item">
                <h3>Prochains cours</h3>
                <!-- Insérez des informations sur les prochains cours ici -->
            </div>
            <div class="dashboard-item">
                <h3>Notifications</h3>
                <!-- Insérez des notifications récentes ici -->
            </div>
        </section>
    </main>

    <footer>
        <p>© 2023 School Management. Tous droits réservés</p>
    </footer>

    
</body>
</html>
