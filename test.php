<?php
    require_once "api/dao/conf/db_conn.php";
    require_once "api/dao/user.php";
    echo $res = login("ciaone", "lolhashedpassword");
    var_dump($res);
?>