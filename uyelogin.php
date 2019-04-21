<?php require 'admin/include/database.php';?>




<form action="" method="post">
        <div class="form-group">
            <label>Kullanıcı Adı </label>
            <input type="text" class="form-control" name="uyekad" placeholder="Kullanıcı Adınızı Giriniz..."><br><br>
        </div>
        <div class="form-group">

            <label>Şifre</label>
            <input type="password" class="form-control" name="uyepass" placeholder="Şifre"><br><br>
        </div>
        <button type="submit" name="form1" class="btn btn-primary">Giriş Yap</button>
    <hr>

</form>
<h3> ÜYE DEĞİLSEN ÜYE OL</h3>

<form action="" method="post">

    <div class="form-group">
        <label>Kullanıcı Adı </label>
        <input type="text" class="form-control" name="uyekad" placeholder="Kullanıcı Adınızı Giriniz..."><br><br>
    </div>
    <div class="form-group">

        <label>Şifre</label>
        <input type="password" class="form-control" name="uyepass" placeholder="Şifre"><br><br>
    </div>
    <button type="submit" name="form2" href="uyeol.php" class="btn btn-primary">Üye Ol</button>

</form>


<?php

if(isset($_POST['form1'])){

    $kontrol = $db->prepare("Select * From uyeler WHERE uyekad=:uyekad and uyepass=:uyepass");
    $kontrol->execute([

        "uyekad" => $_POST["uyekad"],
        "uyepass" => $_POST["uyepass"]
    ]);

    if($kontrol->rowCount()){
        $row = $kontrol->fetch(PDO::FETCH_OBJ);

        $_SESSION["uye_oturum"] = true;


        echo 'Giriş Başarılı! Yönlendiriliyorsunuz...';
        header("Refresh:4;url=index.php");


    }else{
        echo 'kullanici adi veya sifre yanlış';
    }
}

else if(isset($_POST['form2'])){


        $kaydet = $db->prepare("insert into uyeler set uyekad=:uyekad, uyepass=:uyepass");
        $kaydet->execute([
            "uyekad" =>$_POST["uyekad"],
            "uyepass" =>$_POST["uyepass"]

        ]);


        if($kaydet){
            echo 'kayit başarılı';

        }else{
            echo 'kayit basarısız';
        }



}



?>

