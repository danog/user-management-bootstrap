<?php

ini_set("log_errors", 1);
error_reporting(E_ALL);
include 'db_connect.php';
include 'functions.php';
include 'pages.php';

// Inserisci in questo punto il codice per la connessione al DB e l'utilizzo delle varie funzioni.
sec_session_start();
echo $head;
if(login_check($pdo) == true) {
 $curuser = $_SESSION['username'];
 $usertype = $_SESSION['usertype'];
 $curpage = $_GET['p'];
 if($curpage == "") { $curpage = "none"; };

 switch ($usertype) {
    // Admin
    case 1:
        $pages = [
    ["Autocontrollo", "none"],
    ["Manage users", "usermgmt"]
];
        break;
    default:
        $pages = [
    ["Autocontrollo", "none"],
];
 };
 
 declarenav($pages);
 foreach ($pages as list($name, $page)) {
  if($page == $curpage){
   $func = "declare".$page."();";
   eval ("$func");
   $done = "y";
  };
 };
 if($done != "y") { $error = "y"; declarenone(); };
} else {
 declarenavbase();
 if($_GET['p'] == "signup") {
  declaresignup();
 } else {
  declarelogin();
 };
};
echo $footer;
?>
