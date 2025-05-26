<?php
echo "Hello world!<br>";
$host = "mysql"; // Le host est le nom du service, présent dans le docker-compose.yml
$dbname = "user_login";
$charset = "utf8";
$port = "3306";
?>

<html>
<head>
    <title>Drenthe College docker web server</title>
</head>
<body>
<a href="register.php">Registreren</a>
<a href="login.php">Inloggen</a>
</body>
</html>
