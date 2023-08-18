const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');

const app = express();
const port = 3000;

// MySQL-Konfiguration 
const dbConfig = {
  host: .'',
  user: '',
  password: '',
  database: '',
  port: ''
};

// Verbindung zur MySQL-Datenbank herstellen
const connection = mysql.createConnection(dbConfig);

// Verbindung zur Datenbank herstellen
connection.connect((err) => {
  if (err) {
    console.error('Fehler beim Verbinden zur Datenbank: ' + err.stack);
    return;
  }
  console.log('Verbindung zur Datenbank erfolgreich.');
});

// Middleware für die Verarbeitung von JSON-Daten
app.use(bodyParser.json());

// API-Endpunkt zum Überprüfen der Wallet-Anmeldedaten
app.post('/api/login', (req, res) => {
  const { walletAddress, secretPhrase } = req.body;

  // Überprüfen Sie die Anmeldedaten in der Datenbank
  const query = 'SELECT * FROM users WHERE wallet_address = ? AND secret_phrase = ?';
  connection.query(query, [walletAddress, secretPhrase], (err, results) => {
    if (err) {
      console.error('Fehler beim Abrufen der Daten aus der Datenbank: ' + err.stack);
      return res.status(500).json({ success: false, message: 'Ein Serverfehler ist aufgetreten.' });
    }

    if (results.length === 0) {
      return res.json({ success: false, message: 'Ungültige Wallet-Adresse oder Secret Phrase.' });
    }

    return res.json({ success: true, message: 'Anmeldung erfolgreich.' });
  });
});

// Server starten
app.listen(port, () => {
  console.log('Server läuft auf http://localhost:' + port);
});
