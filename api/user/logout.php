<?php
  require_once '../dao/response/response.php';

  // inizializza la sessione nella pagina, altrimenti non si può utilizzare la destroy()
  session_start();

  // se la richiesta è di tipo post effettua la disconnessione, altrimenti dà errore
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      // effettua il logout
      session_destroy();
      echo new Response("Logged out successfully", 200);
  } else{
    echo new Response("Error", 400);
  }
?>