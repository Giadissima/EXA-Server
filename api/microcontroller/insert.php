<?php
    require_once '../dao/conf/defines.php';
    require_once '../dao/conf/db_conn.php';
    require_once '../dao/utils/response.php';
    require_once '../dao/utils/checkPost.php';
    require_once '../dao/microcontroller.php';
    
    if(isPostValid("model", "cpu", "price", "autonomy", "communication", "ram", "description")){
        if($_POST["password"] != $_POST["password2"]){
            echo new Response("The passwords entered do not match", 400);
            die();
        } 
        $model = $_POST["model"];
        $cpu = $_POST["cpu"];
        $price = $_POST["price"];
        $autonomy = $_POST["autonomy"];
        $communication = $_POST["price"];
        $ram = $_POST["ram"];
        $description = $_POST["description"];

        // utilizzo dell'operatore ternario
        $sale = isset($_POST['onsale']) ? $_POST['onsale'] : 0;
        $newprice = isset($_POST['newprice']) ? $_POST['newprice'] : 0;

        insert_microcontroller($model, $cpu, $price, $autonomy, $communication, $ram, $description, $sale, $new);
        echo new Response("Completed", 200);
        die();

    } 
    // $contratto = isset($_POST['contratto']) ? $_POST['contratto'] : 'no';
    echo new Response("Invalid request", 400);
    die();

?>