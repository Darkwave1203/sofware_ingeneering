<?php
$host = 'localhost';
$db   = 'schoolmanagement';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$username = $_POST['username'];
$password = $_POST['password'];

// Vérifiez d'abord si les identifiants sont 'root' et 'root'
if ($username === 'root' && $password === 'root') {
    // Si les identifiants sont corrects, redirigez directement vers la page de gestion des étudiants.
    header('Location: manage_students.php');
    exit();
}

// Si les identifiants ne sont pas 'root' et 'root', exécutez la requête SQL normale.
$query = "SELECT * FROM students WHERE email = ? AND password = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$username, $password]);
$user = $stmt->fetch();

if ($user) {
    // Si l'authentification réussit pour un autre utilisateur, redirigez vers la page de gestion des étudiants.
    header('Location: manage_students.php');
    exit();
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect.";
}
?>
