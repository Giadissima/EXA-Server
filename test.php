<?php
    require_once "api/dao/conf/db_conn.php";
    require_once "api/dao/microcontroller.php";
    echo $res = setOnSale(2.14, "merrrrrrr");
    var_dump($res);
?>