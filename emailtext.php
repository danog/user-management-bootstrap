<?php
$usversubject = "Email verification for autocontrollo.ch";
$usverbody = "Hello $username!
You just signed up to autocontrollo.ch with this email: you should verify it so that we know that you're not a bot.
To do that, simply click on the following url or copy and paste it in your address bar:
====================
https://controllo.autocontrollo.ch/verify.php?username=$username&hash=$email_sha512
====================

If you didn't sign up to autocontrollo.ch, simply ignore this email.
Bye!
";
$usverhttpbody = "Hello $username!
You just signed up to <a href=\"https://autocontrollo.ch\" target=\"_blank\">autocontrollo.ch</a> with this email: you should verify it so that we know that you're not a bot.<br>
To do that, simply click <a href=\"https://controllo.autocontrollo.ch/verify.php?username=$username&amp;hash=$email_sha512\" target=\"_blank\">here</a> or copy and paste the following URL in your address bar:<br><br>
====================
<a href=\"https://controllo.autocontrollo.ch/verify.php?username=$username&amp;hash=$email_sha512\" target=\"_blank\">https://controllo.autocontrollo.ch/verify.php?username=$username&amp;hash=$email_sha512</a>
====================<br><br>
If you didn't sign up to autocontrollo.ch, simply ignore this email.<br>
Bye!
";

$adversubject = "$username signed up";
$adverbody = "Hello $adminusername!
$name ($username) just signed up to autocontrollo.ch using your structure's id.
Please navigate to controllo.autocontrollo.ch and activate the user.
If you don't know this $username, you should delete him/her from the user list.
Bye!
";
$adverhttpbody = "Hello $adminusername!<br>$name ($username) just signed up to autocontrollo.ch using your structure&apos;s id.<br>Please navigate to controllo.autocontrollo.ch and activate the user.<br>If you don&apos;t know this $username, you should delete him/her from the user list.<br>Bye!
";

?>
