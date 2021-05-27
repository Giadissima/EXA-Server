<?php

    // function insert_microcontroller(){
    //     $sql = "INSERT INTO utente(mail, num_telefono, tipo) VALUES(:mail, :tel, :tipo); SELECT LAST_INSERT_ID();";
    //     $stm = Database::conn()->prepare($sql);
    //     $stm->bindValue(':mail', $mail, PDO::PARAM_STR);
    //     $stm->bindValue(':tel', $tel, PDO::PARAM_INT);
    //     $stm->bindValue(':tipo', $tipo, PDO::PARAM_STR);
    //     echo "<br>";
    //     // esegue la query o restituisce errore
    //     $stm->execute() or die(print_r($stm->errorInfo(), true));
    //     // prende la riga successiva
    //     $stm->nextRowset();
      
    //     $id = $stm->fetch(PDO::FETCH_ASSOC)["LAST_INSERT_ID()"];

    //     // il salt viene codificato in base 64 per un totale di 60 caratteri
    //     $salt = base64_encode(random_bytes(45));
    //     $hash_pass = hash("sha512", $password.$salt);

    //     $sql = "INSERT INTO credenziali(id, username, `password`, salt) VALUES(:id, :username, :pssw, :salt)";
    //     $stm = Database::conn()->prepare($sql);
    //     $stm->bindValue(':id', $id, PDO::PARAM_INT);
    //     $stm->bindValue(':username', $username, PDO::PARAM_STR);
    //     $stm->bindValue(':pssw', $hash_pass, PDO::PARAM_STR);
    //     $stm->bindValue(':salt', $salt, PDO::PARAM_STR);
    //     $stm->execute() or die(print_r($stm->errorInfo(), true));

    //     return true;        
    // }

    //aggiorna il prezzo del microcontrollore
    updatePrice($newprice, $model){
        $sql = "UPDATE microcontrollore SET prezzo_scontato = :price";
        $stm = Database::conn()->prepare($sql);
        $stm->bindValue(':price', $mail, PDO::PARAM_STR);
        // esegue la query o restituisce errore
        $stm->execute() or die(print_r($stm->errorInfo(), true));
    }

?>