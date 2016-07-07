<?php

ini_set('log_errors', 1);
error_log('Hello, errors (3)!');

include 'db_connect.php';
include 'functions.php';

$action = $_POST['action'];
$username = $_POST['username'];
$password = $_POST['p'];
$type = $_POST['type'];
sec_session_start();

error_log("action is $action and username is $username");
if (login_check($pdo) == true) {
    if ($action == 'del' && $username != '') {
        if ($insert_stmt = $pdo->prepare('DELETE from members WHERE id=?')) {
            $insert_stmt->execute([$username]);
        // Esegui la query ottenuta.
        if ($insert_stmt->rowCount() != '0') {
            exit('ok');
        } else {
            exit('false');
        }
        }
    }

    if ($action == 'pass' && $username != '' && $password != '') {

     // Crea una chiave casuale
     $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
     // Crea una password usando la chiave appena creata.
     $password = hash('sha512', $password.$random_salt);
     // Inserisci a questo punto il codice SQL per eseguire la INSERT nel tuo database
     // Assicurati di usare statement SQL 'prepared'.
     if ($insert_stmt = $pdo->prepare('UPDATE members set password=?, salt=? WHERE id=?')) {
         $insert_stmt->execute([$password, $random_salt, $username]);
        // Esegui la query ottenuta.
        if ($insert_stmt->rowCount() != '0') {
            exit('ok');
        } else {
            exit('false');
        }
     }
    }

    if ($action == 'type' && $username != '' && $type != '') {
        // Inserisci a questo punto il codice SQL per eseguire la INSERT nel tuo database
     // Assicurati di usare statement SQL 'prepared'.
     if ($insert_stmt = $pdo->prepare('UPDATE members set usertype=? WHERE id=?')) {
         $insert_stmt->execute([$type, $username]);
        // Esegui la query ottenuta.
        if ($insert_stmt->rowCount() != '0') {
            exit('ok');
        } else {
            exit('false');
        }
     }
    }
    header('Location: https://controllo.autocontrollo.ch/');
} else {
    exit('false');
}
?>    
