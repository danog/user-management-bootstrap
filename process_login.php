<?php

error_log('Hello, errors login!');
include 'db_connect.php';
include 'functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if (isset($_POST['username'], $_POST['p'])) {
    $username = $_POST['username'];
    $password = $_POST['p']; // Recupero la password criptata.
   error_log("$username $password");
    if (login($username, $password, $pdo) == true) {
        // Login eseguito
      header('Location: https://controllo.autocontrollo.ch/');
        $log = $pdo->prepare("UPDATE members SET loggedin = '1' where members.username = ?");
        $log->execute(["$username"]);
    } else {
        header('Location: https://controllo.autocontrollo.ch/?error=1');
    }
} else {
    // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
   echo 'Invalid Request';
}
