<?php
  require_once '../dao/conf/db_config.php';
  require_once '../dao/conf/db_conn.php';
  require_once '../dao/user.php';
  require_once '../dao/utils/response.php';
  require_once '../dao/utils/checkPost.php';

  // Login - User DAO
  session_start();

  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo new Response("Invalid request", 400);
  } else {
    // Controllo dei parametri
    if (isPostValid("username", "password")) {
      echo new Response("Please fill in all fields", 400);
      die();
    }

    // Controllo se l'utente è già loggato
    if (isset($_SESSION['logged']) && $_SESSION['logged'])
      echo new Response("Session resumed", 200);
    else {
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      // Faccio il login
      $_SESSION['logged'] = check_user($username, $password);
      if ($_SESSION['logged']) {
        $_SESSION['username'] = $username;
        
        echo new Response("Logged", 200);
      } else {
        echo new Response("Wrong username or password", 400);
      }
    }
  }
?>