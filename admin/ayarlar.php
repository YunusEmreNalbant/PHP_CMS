
<?php include 'include/header.php'; ?>
<section class="content-header">
    <h1>
        Dashboard
        <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>


<?php

$ayarlar=$db->prepare("select * from ayarlar where id=:id");
$ayarlar->execute(["id"=>1]);
$row = $ayarlar->fetch(PDO::FETCH_OBJ);


?>

<!-- Main content -->
<section class="content">
    <div class="col-md-12">
        <div class="row">

            <div class="box">
                <div class="box-header">
                    Site Ayarları
                </div>
                <div class="box-body">

                    <?php
                            if(@$_GET["durum"]=="ok"){?>
                                <div class="alert alert-success">
                                    Bilgileriniz başarıyla Güncellendi
                                </div>


                            <?php }

                            if(@$_GET["durum"]=="no"){
                                ?>

                                    <div class="alert alert-danger  ">
                                        Bir hata oluştu
                                     </div>
                                <?php
                                 } ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">

                            <label>Site Başlığı</label>
                            <input name="siteBaslik" class="form-control" value="<?= $row->site_baslik ?>"/>
                        </div>
                        <div class="form-group">

                            <label>Site Anahtar Kelime</label>
                            <input name="siteKey" class="form-control" value="<?= $row->site_keywords ?>"/>
                        </div>
                        <div class="form-group">

                            <label>Site Aciklama</label>
                            <input name="siteAciklama" class="form-control" value="<?= $row->site_description ?>"/>
                        </div>
                        <div class="form-group">

                            <label>Facebook</label>
                            <input name="face" class="form-control" value="<?= $row->site_facebook ?>"/>
                        </div>
                        <div class="form-group">

                            <label>Twitter</label>
                            <input name="twit" class="form-control" value="<?= $row->site_twitter ?>"/>
                        </div>
                        <div class="form-group">

                            <label>E-Mail</label>
                            <input name="mail" class="form-control" value="<?= $row->site_email ?>"/>
                        </div>
                        <div class="form-group col-md-6">

                            <label>Kullanıcı Adı</label>
                            <input name="kad" class="form-control" value="<?= $row->site_kad ?>"/>
                        </div>
                        <div class="form-group col-md-6">

                            <label>Sifre</label>
                            <input name="pass" class="form-control" value="<?= $row->site_pass ?>"/>
                        </div>
                        <div class="form-group col-md-6">

                            <label>Ad Soyad</label>
                            <input name="adSoyad" class="form-control" value="<?= $row->site_adSoyad ?>"/>
                        </div>
                        <div class="form-group col-md-6">

                            <label>Meslek</label>
                            <input name="meslek" class="form-control" value="<?= $row->site_meslek ?>"/>
                        </div>
                        <div class="form-group">

                            <label>Resim</label>
                            <input name="resim" type="file"/>
                        </div>
                        <div class="form-group">
                            <label>Site Durum</label>
                            <select class="form-control" name="durum">
                                <option value="1" <?= $row->site_durum == 1 ?"selected": "" ?>>Açık</option>
                                <option value="0" <?= $row->site_durum == 0 ?"selected": "" ?>>Kapalı</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</section>

<?php

    if($_POST){

        if($_FILES["resim"]["name"]) {
            $resimAdi = $_FILES["resim"]["name"];
            $resimYolu = "../assets/upload/".$resimAdi;

            if(move_uploaded_file($_FILES["resim"]["tmp_name"],$resimYolu)) {
                $guncelle= $db->prepare("UPDATE ayarlar SET 
                                            site_baslik=:baslik,
                                            site_keywords=:keywords,
                                            site_description=:description, 
                                            site_durum=:durum, 
                                            site_facebook=:facebook, 
                                            site_twitter=:twitter, 
                                            site_email=:email, 
                                            site_kad=:kad, 
                                            site_pass=:pass, 
                                            site_adSoyad=:adSoyad,
                                            site_meslek=:meslek,
                                            site_resim=:resim
                                           WHERE id=:id");
                $guncelle->execute([
                    "baslik" =>$_POST["siteBaslik"],
                    "keywords" =>$_POST["siteKey"],
                    "description" =>$_POST["siteAciklama"],
                    "durum" =>$_POST["durum"],
                    "facebook" =>$_POST["face"],
                    "twitter" =>$_POST["twit"],
                    "email" =>$_POST["mail"],
                    "kad" =>$_POST["kad"],
                    "pass" =>$_POST["pass"],
                    "adSoyad" =>$_POST["adSoyad"],
                    "meslek" =>$_POST["meslek"],
                    "resim" =>$resimAdi,
                    "id" =>1


                ]);

                if($guncelle){
                    header("location:ayarlar.php?durum=ok");


                }else {
                    header("location:ayarlar.php?durum=no");
                }
            }
        }else{
            $guncelle= $db->prepare("UPDATE ayarlar SET 
                                            site_baslik=:baslik,
                                            site_keywords=:keywords,
                                            site_description=:description, 
                                            site_durum=:durum, 
                                            site_facebook=:facebook, 
                                            site_twitter=:twitter, 
                                            site_email=:email, 
                                            site_kad=:kad, 
                                            site_pass=:pass, 
                                            site_adSoyad=:adSoyad,
                                            site_meslek=:meslek
                                          
                                           WHERE id=:id");
            $guncelle->execute([
                "baslik" =>$_POST["siteBaslik"],
                "keywords" =>$_POST["siteKey"],
                "description" =>$_POST["siteAciklama"],
                "durum" =>$_POST["durum"],
                "facebook" =>$_POST["face"],
                "twitter" =>$_POST["twit"],
                "email" =>$_POST["mail"],
                "kad" =>$_POST["kad"],
                "pass" =>$_POST["pass"],
                "adSoyad" =>$_POST["adSoyad"],
                "meslek" =>$_POST["meslek"],
                "id" =>1


            ]);

            if($guncelle){
                header("location:ayarlar.php?durum=ok");


            }else {
                header("location:ayarlar.php?durum=no");
            }
        }

    }


?>
<!-- /.content -->
<?php include 'include/footer.php'; ?>
