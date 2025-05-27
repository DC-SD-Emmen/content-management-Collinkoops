<?php //verbind met de database
$host = 'mysql'; 
$db   = 'oefenopdracht2';  
$user = 'root';
$pass = 'root';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   //join query om gebruikers en hun spellen op te halen
    $stmt = $pdo->query("
        SELECT users.naam AS gebruiker, games.title AS game
        FROM user_games
        JOIN users ON user_games.user_id = users.id
        JOIN games ON user_games.game_id = games.id
        ORDER BY gebruiker;
    ");
    // Haal de resultaten op en toon ze in een lijst
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<ul>";
        foreach ($results as $row) {
            echo "<li><strong>" . htmlspecialchars($row['gebruiker']) . "</strong> speelt <em>" . htmlspecialchars($row['game']) . "</em></li>";
        }
        echo "</ul>";
    } else { // Als er geen resultaten zijn, geef foutmelding
        echo "Geen koppelingen gevonden.";
    }
} catch (PDOException $e) {
    echo "Fout bij verbinden of query: " . $e->getMessage();
}
// toon een lijst met alle gebruikers
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT id, naam FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($users) {
        echo "<ul>";
        foreach ($users as $user) {
            echo "<li>" . htmlspecialchars($user['naam']) . " (ID: " . $user['id'] . ")</li>";
        }
        echo "</ul>";
    } else {
        echo "Geen gebruikers gevonden.";
    }
} catch (PDOException $e) {
    echo "Fout bij verbinden of query: " . $e->getMessage();
}


?>