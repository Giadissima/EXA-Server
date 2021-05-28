<?php

    function insert_microcontroller($model, $cpu, $price, $autonomy, $communication, $ram, $description){
        $sql = "INSERT INTO microcontrollore(
                    `modello`, 
                    `comunicazione`, 
                    `RAM`, 
                    `autonomia`, 
                    `prezzo`, 
                    `CPU`, 
                    `descrizione`) 
                VALUES(
                    :modello, 
                    :comunicazione, 
                    :ram,
                    :autonomia,
                    :prezzo,
                    :cpu,
                    :descrizione);";

        $stm = Database::conn()->prepare($sql);
        $stm->bindValue(':modello', $model, PDO::PARAM_STR);
        $stm->bindValue(':comunicazione', $communication, PDO::PARAM_STR);
        $stm->bindValue(':ram', $ram, PDO::PARAM_INT);
        $stm->bindValue(':autonomia', $autonomy, PDO::PARAM_INT);
        $stm->bindValue(':prezzo', $price, PDO::PARAM_STR);
        $stm->bindValue(':cpu', $cpu, PDO::PARAM_STR);
        $stm->bindValue(':descrizione', $description, PDO::PARAM_STR);

        // esegue la query o restituisce errore
        $stm->execute() or die(print_r($stm->errorInfo(), true));

        return true;        
    }

    //aggiorna il prezzo del microcontrollore
    function setOnSale($newprice, $model){
        $sql = "UPDATE microcontrollore SET prezzo_scontato = :price WHERE modello = :model";
        $stm = Database::conn()->prepare($sql);
        $stm->bindValue(':price', $newprice, PDO::PARAM_STR);
        $stm->bindValue(':model', $model, PDO::PARAM_STR);
        // esegue la query o restituisce errore
        $stm->execute() or die(print_r($stm->errorInfo(), true));
    }
