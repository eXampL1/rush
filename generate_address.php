<!-- generate_address.php -->

<?php

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


//TODO GENERATE SECRETPHRASE

$numWordsInSecret = 12;

$wordList = array (
    $words
);

$walletAddress = 0x . bin2hex(random_bytes(32));
$secretPhrase = genereateSecretePhrase($wordList, $numWordsInSecret);

//TODO SAVE IN DATABASE
$sql = "INSERT INTO wallets (wallet_addreess, secret_phrase) VALUES ('$walletAddress', '$secretPhrase')";
if(mysqli)
?>