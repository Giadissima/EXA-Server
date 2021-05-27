<?php
    require_once '../dao/conf/defines.php';
    require_once '../dao/conf/db_conn.php';
    require_once '../dao/utils/response.php';
    require_once '../dao/utils/checkPost.php';
    require_once '../dao/user.php';
    //Il numero di telefono è opzionale
    if(isPostValid("password", "password2", "email", "username")){
        if($_POST["password"] != $_POST["password2"]){
            echo new Response("The passwords entered do not match", 400);
            die();
        } 
        $password = $_POST["password"];
        $email = $_POST["email"];
        $username = $_POST["username"];

        if (!isset($_POST["number"]))
            $tel = "";
        else
            $tel = $_POST["number"];
        insert_user($email, $username, $password, "U", $tel);
        echo new Response("Completed", 200);
        die();

    } 
    echo new Response("Invalid request", 400);
    die();

?>