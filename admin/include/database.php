<?php

    ob_start();
    session_start();

    try{
        $db = new PDO("mysql:host=localhost;dbname=yunusunsitesi;charset=utf8;","root","");
    }catch (PDOException $e){
        echo $e->getMessage();
    }


$ayarlar=$db->prepare("select * from ayarlar where id=:id");
$ayarlar->execute(["id"=>1]);
$ayar = $ayarlar->fetch(PDO::FETCH_OBJ);


?>