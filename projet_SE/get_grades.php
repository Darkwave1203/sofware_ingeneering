<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['student_id'])) {
    die("User not logged in");
}

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "root";
$database = "schoolmanagement";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Get the student ID from the session
$student_id = $_SESSION['student_id'];

// SQL query to retrieve the grades
$sql = "SELECT * FROM grades WHERE student_id = $student_id";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error executing query: " . $conn->error);
}

// Build the HTML for grades
$output = "";
if ($result->num_rows > 0) {
    $subjectGrades = array();

    while ($row = $result->fetch_assoc()) {
        // Store grades for each subject in an array
        $subjectGrades['Mathématiques'][] = $row["math_grade"];
        $subjectGrades['Anglais'][] = $row["english_grade"];
        $subjectGrades['Cybersécurité'][] = $row["cybersecurity_grade"];
        $subjectGrades['Mécanique'][] = $row["mechanic_grade"];
        // Add more subjects as needed
    }

    // Display each subject and its corresponding grades
    foreach ($subjectGrades as $subject => $grades) {
        $output .= "<div class='subject-container'>";
        $output .= "<p class='subject-name'><strong>Matière:</strong> $subject</p>";
        $output .= "<p class='grades-label'><strong>Notes:</strong></p>";
        $output .= "<ul class='grades-list'>";

        foreach ($grades as $grade) {
            $output .= "<li>$grade</li>";
        }

        $output .= "</ul>";
        $output .= "</div>";
    }
} else {
    $output = "Aucune note trouvée.";
}

// Close the database connection
$conn->close();

// Return the HTML content of the grades
echo $output;
?>


