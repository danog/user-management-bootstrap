<?php

error_log( "Hello, errors (2)!" );

include 'db_connect.php';
include 'functions.php';
include '../mail.php';

$name = $_POST['name'];
$sid = $_POST['sid'];
$email = $_POST['email'];
$username = $_POST['username'];
$response = $_POST['response'];
$password = $_POST['password'];

$fields = array(
    'secret' => '6LfVZRITAAAAALN5A_Uq7E-cIraDyOtOazYJd9av',
    'response' => "$response"
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$gresponse = curl_exec ($ch);

curl_close ($ch);

$obj = json_decode($gresponse);
$result = $obj->{'success'};

// Check for empty fields
if($result != "true" || empty($_POST['name']) || empty($_POST['response']) || empty($_POST['sid']) || empty($_POST['email']) || empty($_POST['username'])|| !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) || empty($_POST['password'])){
   exit("false");
};

$check_stmt = $pdotwo->prepare("SELECT Email, username FROM Strutture WHERE IdStruttura = ?;");
$check_stmt->execute(array($sid));
$count = $check_stmt->rowCount();
$adminemail = $check_stmt->fetchColumn();
$adminusername = $check_stmt->fetchColumn(1);

$checktwo_stmt = $pdo->prepare("SELECT * FROM members WHERE username = ?;");
$checktwo_stmt->execute(array($username));
$counttwo = $checktwo_stmt->rowCount();

if($count == "1" && $counttwo == "0") {
  // Crea una chiave casuale
  $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
  // Crea una password usando la chiave appena creata.
  $password = hash('sha512', $password.$random_salt);
  $email_sha512 = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
  $insert_stmt = $pdo->prepare("INSERT INTO members (name, sid, email, username, password, salt, email_sha512, usertype, verifyemail) VALUES (?, ?, ?, ?, ?, ?, ?, '0', '0');");
  $insert_stmt->execute(array($name, $sid, $email, $username, $password, $random_salt, $email_sha512));
  $count = $insert_stmt->rowCount();
  if($count == "1") {
    include 'emailtext.php';
    sendmail($email, $usversubject, $usverbody, $usverhtmlbody, "");
    sendmail($adminemail, $adversubject, $adverbody, $adverhtmlbody, "");

    exit("ok");
  } else exit("false");
} else {
  exit("false");
}

?>
