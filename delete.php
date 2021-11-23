<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id= $_POST['id'];
    $image= $_POST['image'];
    include "connection_database.php";
    $sqlDelete = "DELETE FROM `news` WHERE id=?";

    $filePath = $_SERVER['DOCUMENT_ROOT'].'/images/'.$image;
    if(file_exists($filePath)) {
        unlink($filePath);
    }

    $connection->prepare($sqlDelete)->execute([$id]);
}
?>