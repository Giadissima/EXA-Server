<?php
    require_once '../dao/conf/defines.php';
    require_once '../dao/conf/db_conn.php';
    require_once '../dao/utils/response.php';
    require_once '../dao/utils/checkPost.php';
    require_once '../dao/microcontroller.php';
    
    if(isPostValid("model", "cpu", "price", "autonomy", "communication", "ram", "description")){
        $model = $_POST["model"];
        $cpu = $_POST["cpu"];
        $price = $_POST["price"];
        $autonomy = $_POST["autonomy"];
        $communication = $_POST["communication"];
        $ram = $_POST["ram"];
        $description = $_POST["description"];

        // utilizzo dell'operatore ternario
        $sale = isset($_POST['onsale']) ? $_POST['onsale'] : 0;
        $newprice = isset($_POST['newprice']) ? $_POST['newprice'] : 0;

        insert_microcontroller($model, $cpu, $price, $autonomy, $communication, $ram, $description);
        // se è stato passato nella richiesta un prezzo scontato, lo aggiunge facendo un update
        if($sale != 0 && $newprice != 0){
            setOnSale($newprice, $model);
        }
        echo new Response("Completed", 200);
        die();

    } 
    // $contratto = isset($_POST['contratto']) ? $_POST['contratto'] : 'no';
    echo new Response("Invalid request", 400);
    die();

?>