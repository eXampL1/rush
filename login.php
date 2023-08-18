<?php
$servername = "localhost";
$username = "";
$password = " " ;
$database = "";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . mysqli_connect_error());
}

$walletAddress = $_POST['walletAddress'];
$secretPhrase = $_POST['secretPhrase'];

$checkQuery = "SELECT * FROM wallet_addresses WHERE address = '$walletAddress'";
$result = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($result) > 0) {
    
    $row = mysqli_fetch_assoc($result);
    if ($row['secret_phrase'] === $secretPhrase) {
      
        header("Location: wallet-send.html");
        exit(); 
    } else {
        
        header("Location: wallet-login.html");
        exit(); 
    }
} else {
   
    $newSecretPhrase = generateSecretPhrase(); // Hier wird die generierte Secret Phrase eingefügt
    $insertQuery = "INSERT INTO wallet_addresses (address, secret_phrase) VALUES ('$walletAddress', '$newSecretPhrase')";
    if (mysqli_query($conn, $insertQuery)) {
        // Erfolgreich eingefügt, leite zur Wallet-Seite weiter
        header("Location: wallet-send.html");
        exit(); // Wichtig: Beenden Sie das Skript hier
    } else {
        // Fehler beim Einfügen
        header("Location: wallet-login.html");
        exit(); // Wichtig: Beenden Sie das Skript hier
    }
}

mysqli_close($conn);

// Funktion zur Generierung der Secret Phrase
function generateSecretPhrase() {
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $length = 24;
    $secretPhrase = "";

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($characters) - 1);
        $secretPhrase .= $characters[$randomIndex];
    }

    return $secretPhrase;
}
?>
