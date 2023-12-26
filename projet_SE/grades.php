<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter des Notes</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>School Management</h1>
        </div>
        <nav>
            <ul>
                <li><a href="acc-teacher.html">Accueil</a></li>
                <li><a href="grades.php">Ajouter des Notes</a></li>
                <!-- Ajoutez d'autres liens de navigation ici -->
            </ul>
        </nav>
    </header>

    <main>
        <section class="add-grades-section">
            <h2>Ajouter une Note</h2>
            <form action="add_grade_teacher.php" method="post">
                <label for="student_id">Étudiant:</label>
                <select id="student_id" name="student_id" required>
                    <!-- Remplacez ceci par la liste des étudiants depuis la base de données -->
                    <?php
                    // Incluez ici le code pour récupérer la liste des étudiants depuis la base de données
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";
                    $database = "schoolmanagement";

                    $conn = new mysqli($servername, $username, $password, $database);

                    if ($conn->connect_error) {
                        die("Échec de la connexion à la base de données : " . $conn->connect_error);
                    }

                    $sqlStudents = "SELECT id, first_name, last_name FROM students";
                    $resultStudents = $conn->query($sqlStudents);

                    if ($resultStudents->num_rows > 0) {
                        while ($row = $resultStudents->fetch_assoc()) {
                            $studentId = $row['id'];
                            $studentName = $row['first_name'] . ' ' . $row['last_name'];
                            echo "<option value='$studentId'>$studentName</option>";
                        }
                    } else {
                        echo "<option value=''>Aucun étudiant trouvé</option>";
                    }

                    // Fermez la connexion à la base de données
                    $conn->close();
                    ?>
                </select>

                <label for="subject">Matière:</label>
                <select id="subject" name="subject" required>
                    <option value="Math">Mathématiques</option>
                    <option value="English">Anglais</option>
                    <option value="Cybersecurity">Cybersécurité</option>
                    <option value="Mechanic">Mechanic</option>
                    <!-- Ajoutez d'autres matières ici -->
                </select>

                <label for="grade">Note:</label>
                <input type="number" id="grade" name="grade" required>

                <input type="submit" value="Ajouter la Note">
            </form>
        </section>
    </main>

    <footer>
        <p>© 2023 School Management. Tous droits réservés</p>
    </footer>
</body>
</html>
