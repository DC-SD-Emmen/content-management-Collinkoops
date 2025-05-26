<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Beveiligde pagina</title>
</head>
<body>

<h2>Welkom, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<p>Je bent ingelogd. Dit is een beveiligde pagina.</p>

<a href="logout.php">Uitloggen</a>

</body>
</html>