<?php
// Datenbankverbindung herstellen
$host = ''; // Ändern Sie dies, wenn Ihr MySQL-Hostname anders ist
$username = ''; // Benutzername für den Datenbankzugriff
$password = ''; // Passwort für den Datenbankzugriff
$database = ''; // Name Ihrer Datenbank

// Verbindung herstellen
$connection = mysqli_connect($host, $username, $password, $database);

// Überprüfen, ob die Verbindung erfolgreich war
if (!$connection) {
    die('Verbindung fehlgeschlagen: ' . mysqli_connect_error());
}

// Beispielabfrage
$sql = "SELECT * FROM users";
$result = mysqli_query($connection, $sql);

// Überprüfen, ob die Abfrage erfolgreich war
if (mysqli_num_rows($result) > 0) {
    // Daten ausgeben
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["id"] . ", Name: " . $row["name"] . ", Email: " . $row["email"] . "<br>";
    }
} else {
    echo "Keine Daten gefunden.";
}

// Verbindung schließen
mysqli_close($connection);
?>
