<?php  require 'include/database.php';

    if(@$_SESSION["oturum"]){
        header("location:index.php");
    }
?>

<form action="" method="post">
    <input type="text" name="kad"/>
    <input type="password" name="pass"/>
    <input type="submit" value="Giriş Yap"/>
</form>


<?php

if($_POST){
    $kontrol = $db->prepare("select * from ayarlar where site_kad=:kad and site_pass=:pass");
    $kontrol->execute(["kad"=>$_POST["kad"], "pass" => $_POST["pass"]]);
    if($kontrol->rowCount()){
        $row=$kontrol->fetch(PDO::FETCH_OBJ);
        echo 'Basarıyla yönlendiriliyorsunuz';
        $_SESSION["oturum"] = true;
        header("Refresh:3; url=index.php");
    }else{
        echo 'kullanıcı adı veya şifre yanlıs';
    }
}

?>