<?php

require_once "config.php";
try {
    $connection = new PDO(DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT,
        DB_USER, DB_PASSWORD,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".DB_CHARSET));
    //seedAuto($dbh);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

?>