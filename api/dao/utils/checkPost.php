<?php
    function isPostValid(...$args){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST')
            return false;

        foreach ($args as $arg) {
            if (!isset($_POST[$arg]) || empty(trim($_POST[$arg])))
                return false;
        }

        return true;
    }
?>