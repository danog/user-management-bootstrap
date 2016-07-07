<?php

function sec_session_start()
{
    $session_name = 'sec_session_id'; // Imposta un nome di sessione
        $secure = true; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
        $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
        ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
        $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
        session_set_cookie_params($cookieParams['lifetime'], $cookieParams['path'], $cookieParams['domain'], $secure, $httponly);
    session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
        session_start(); // Avvia la sessione php.
        session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}

function login($username, $password, $pdo)
{
    if ($stmt = $pdo->prepare('SELECT id, password, salt, usertype, sid FROM members WHERE username = ?')) {
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $row['id'];
        $usertype = $row['usertype'];
        $sid = $row['sid'];
        $db_password = $row['password'];
        $salt = $row['salt'];
        $count = $stmt->rowCount();
        $password = hash('sha512', $password.$salt); // codifica la password usando una chiave univoca.
      if ($count == 1) {
          if (checkbrute($user_id, $pdo) == true) {
              return false;
          } else {
              if ($db_password == $password) {
                  $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.
               $user_id = preg_replace('/[^0-9]+/', '', $user_id); // ci proteggiamo da un attacco XSS
               $_SESSION['user_id'] = $user_id;
                  $username = preg_replace("/[^a-zA-Z0-9_\-]+/", '', $username); // ci proteggiamo da un attacco XSS
               $_SESSION['username'] = $username;
                  $_SESSION['usertype'] = $usertype;
                  $_SESSION['sid'] = $sid;
                  $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
               // Login eseguito con successo.
               return true;
              } else {
                  // Password incorretta.
               // Registriamo il tentativo fallito nel database.
               $now = time();
                  $pdo->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");

                  return false;
              }
          }
      } else {
          // L'utente inserito non esiste.
         return false;
      }
    }
}

function checkbrute($user_id, $pdo)
{
    // Recupero il timestamp
   $now = time();
    $valid_attempts = $now - (2 * 60 * 60);
    if ($stmt = $pdo->prepare('SELECT time FROM login_attempts WHERE user_id = ? AND time > ?')) {
        $stmt->execute([$user_id, $valid_attempts]);
        if ($stmt->rowCount() > 20) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($pdo)
{
    // Verifica che tutte le variabili di sessione siano impostate correttamente
   if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
       $user_id = $_SESSION['user_id'];
       $login_string = $_SESSION['login_string'];
       $username = $_SESSION['username'];
       $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
     if ($stmt = $pdo->prepare('SELECT password FROM members WHERE id = ? LIMIT 1')) {
         $stmt->execute([$user_id]); // esegue il bind del parametro '$user_id'.
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
         $count = $stmt->rowCount();
         if ($count == 1) {
             $password = $row['password'];
             $login_check = hash('sha512', $password.$user_browser);
             if ($login_check == $login_string) {
                 // Login eseguito!!!!
              return true;
             } else {
                 error_log("Wrong login string for $username");

                 return false;
             }
         } else {
             error_log("Couldnt find $username");

             return false;
         }
     } else {
         error_log("Couldnt select pass $username");

         return false;
     }
   } else {
       error_log("Vars not set 4 $username");

       return false;
   }
}
