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
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM user_login WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        echo "Inloggen succesvol!";
    } else {
        echo "Ongeldige gebruikersnaam of wachtwoord.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <h2>Inloggen</h2>

<form action="login.php" method="POST">
    <label for="username">Gebruikersnaam:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Wachtwoord:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Inloggen">
</form>   
</body>
</html>