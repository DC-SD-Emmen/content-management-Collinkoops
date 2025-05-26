<?php
$host = "mysql"; 
$dbname = "database";  
$charset = "utf8mb4";
$username = "root";
$password = "root";
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO user_login (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        echo "Registratie succesvol!";
    } else {
        echo "Er is een fout opgetreden bij de registratie.";
    }
}
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registratie</title>
</head>
<body>

<h2>voer een Gebruikersnaam en Wachtwoord in</h2>

<form action="register.php" method="POST">
    <label for="username">Gebruikersnaam:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Wachtwoord:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Registreren">
</form>

</body>
</html>