<?php

ini_set('log_errors', 1);
error_log('Hello, errors logout!');
include 'db_connect.php';
include 'functions.php';
sec_session_start();
// Elimina tutti i valori della sessione.
$username = $_SESSION['username'];
$pdo->query("UPDATE `members` SET `loggedin` = '0' where `members`.`username` = '$username'");
$_SESSION = [];
// Recupera i parametri di sessione.
$params = session_get_cookie_params();
// Cancella i cookie attuali.
setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
// Cancella la sessione.
session_destroy();
header('Location: https://autocontrollo.ch');
