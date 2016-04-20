<?php

include 'db_connect.php';
include 'functions.php';

if($_GET['username'] != "" && $_GET['hash'] != "") {
	$check_stmt = $pdo->prepare("SELECT email_sha512 FROM members WHERE username = ? AND verifyemail = '0';");
	$check_stmt->execute(array($_GET['username']));
	$hash = $check_stmt->fetchColumn();
	$count = $check_stmt->rowCount();
	if($count == "1" && $hash == $_GET['hash']){
		$update_stmt = $pdo->prepare("UPDATE members SET verifyemail = '1' WHERE username = ?");
		$update_stmt->execute(array($_GET['username']));
		$count = $update_stmt->rowCount();
		if($count == "1"){
			echo "Email verified successfully!";
		} else echo "An error occurred (3)!";
	} else echo "An error occurred (2)!";
} else echo "An error occurred (1)!";
?>
