<?php
    //  or die(print_r($stm->errorInfo(), true));

    // require_once "conf/db_conn.php";
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
    
          return $stm->rowCount() > 0;
        } 
        
        return False;
      
    }

    function select_user($username, $password){
        $sql = "SELECT * FROM credenziali WHERE `username` = :username";
        $stm = Database::conn()->prepare($sql);
        $stm->bindValue(':username', $username, PDO::PARAM_STR);
        $stm->execute();

        if($res = $stm->fetch(PDO::FETCH_ASSOC)) {
            $salt = $res["salt"];
            $hash_pass =  hash("sha512", $password.$salt);
            if ($res["password"] == $hash_pass)
                return true;
        }
        return False;
    }

    function insert_user($mail, $tel, $username, $password, $tipo="U"){
        $sql = "INSERT INTO utente(mail, num_telefono, tipo) VALUES(:mail, :tel, :tipo); SELECT LAST_INSERT_ID();";
        $stm = Database::conn()->prepare($sql);
        $stm->bindValue(':mail', $mail, PDO::PARAM_STR);
        $stm->bindValue(':tel', $tel, PDO::PARAM_INT);
        $stm->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        echo "<br>";
        $stm->execute() or die(print_r($stm->errorInfo(), true));
        $stm->nextRowset();
      
        $id = $stm->fetch(PDO::FETCH_ASSOC)["LAST_INSERT_ID()"];
        echo "id: ".$id;

        $salt = base64_encode(random_bytes(45));
        $hash_pass = hash("sha512", $password.$salt);
        echo strlen($hash_pass)."<br>";

        $sql = "INSERT INTO credenziali(id, username, `password`, salt) VALUES(:id, :username, :pssw, :salt)";
        $stm = Database::conn()->prepare($sql);
        $stm->bindValue(':id', $id, PDO::PARAM_INT);
        $stm->bindValue(':username', $username, PDO::PARAM_STR);
        $stm->bindValue(':pssw', $hash_pass, PDO::PARAM_STR);
        $stm->bindValue(':salt', $salt, PDO::PARAM_STR);
        $stm->execute() or die(print_r($stm->errorInfo(), true));

        return true;
    }

    function get_id($username) {
        $sql = "SELECT `id` FROM `credenziali` WHERE `username` = :_username LIMIT 0, 1";
        $sth = Database::conn()->prepare($sql);
        $sth->bindParam(':_username', $username);
        $sth->execute();
    
        return $sth->fetch(PDO::FETCH_ASSOC)['id'];
      }
?>