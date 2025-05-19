<?php
$host = 'localhost'; // Datenbank-Host
$user = 'root';      // MySQL-Benutzername
$password = '';      // Passwort
$dbname = 'itdp';    // Name der Datenbank

// Verbindung erstellen
$conn = new mysqli($host, $user, $password, $dbname);

// Verbindung prüfen
if ($conn->connect_error) {
    die("Verbindungsfehler: " . $conn->connect_error);
} else {
    echo "Erfolgreiche Verbindung zur Datenbank!";
}

// Testabfrage
$query = "SHOW TABLES";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<br> Erfolgreich diese Tabellen sind verfügbar:";
    while ($row = $result->fetch_array()) {
        echo "<br>" . $row[0];
    }
} else {
    echo "<br> Fehler!Keine Tabellen gefunden!";
}
$conn->close();
?>
