<?php
    $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
    $db=new PDO('mysql:host=127.0.0.1;dbname=sst_db','root','',$pdo_options);
    $db ->exec("SET NAMES 'utf8'");
?>