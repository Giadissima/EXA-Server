<?php
    
    // controlla se esiste un utente con tale username e password e lo restituisce
    function check_user($username, $password) {
        $sql = "SELECT `salt` FROM `credenziali` WHERE `username` = :username";
        $stm = Database::conn()->prepare($sql);
        $stm->bindValue(':username', $username);
        $stm->execute() or die(print_r($stm->errorInfo(), true));
    
        if($res = $stm->fetch(PDO::FETCH_ASSOC)) {
          $salt = $res["salt"];
          $hash_pass =  hash("sha512", $password.$salt);
    
          $sql = "SELECT * FROM `credenziali` WHERE `username` = :username AND `password` = :pass";
          $stm = Database::conn()->prepare($sql);
          $stm->bindValue(':username', $username);
          $stm->bindValue(':pass', $hash_pass);
          $stm->execute();
    
          return $stm->rowCount() == 0;
        } 
        
        return False;
      
    }

    // inserisce un utente nel database
    function insert_user($mail,  $username, $password, $tipo="U", $tel=""){
        $sql = "INSERT INTO utente(mail, num_telefono, tipo) VALUES(:mail, :tel, :tipo); SELECT LAST_INSERT_ID();";
        $stm = Database::conn()->prepare($sql);
        $stm->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stm->bindValue(':tel', $tel, PDO::PARAM_INT);
        $stm->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        // esegue la query o restituisce errore
        $stm->execute() or die("error");
        // prende la riga successiva
        $stm->nextRowset();
      
        $id = $stm->fetch(PDO::FETCH_ASSOC)["LAST_INSERT_ID()"];

        // il salt viene codificato in base 64 per un totale di 60 caratteri
        $salt = base64_encode(random_bytes(45));
        $hash_pass = hash("sha512", $password.$salt);

        $sql = "INSERT INTO credenziali(id, username, `password`, salt) VALUES(:id, :username, :pssw, :salt)";
        $stm = Database::conn()->prepare($sql);
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->bindValue(':username', $username, PDO::PARAM_STR);
        $stm->bindValue(':pssw', $hash_pass, PDO::PARAM_STR);
        $stm->bindValue(':salt', $salt, PDO::PARAM_STR);
        $stm->execute() or die("error");

        return true;
    }
?>