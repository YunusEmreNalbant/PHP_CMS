
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

$hakkimda = $db->prepare("SELECT * FROM hakkimda WHERE id=:id");
$hakkimda->execute(["id"=>1]);
$row=$hakkimda->fetch(PDO::FETCH_OBJ);

?>




<!-- Main content -->
<section class="content">
    <div class="col-md-12">
        <div class="row">

            <div class="box">
                <div class="box-header">
                    Hakkımda Bilgisi
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

                            <label>Resim</label>
                            <input  type="file" name="resim" />
                        </div>
                        <div class="form-group">

                            <label>Açıklama</label>
                            <textarea name="aciklama" class="form-control"><?= $row->yazi; ?></textarea>
                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </div>

                    </form>

                    <img src="../assets/upload/<?= $row->resim?>" alt="" height="200">
                </div>
            </div>

        </div>
    </div>

</section>

<?php

if($_POST){

    if($_FILES["resim"]["name"]){

        $resimAdi = $_FILES["resim"]["name"];
        $resimYolu="../assets/upload/".$resimAdi;

        if(move_uploaded_file($_FILES["resim"]["tmp_name"],$resimYolu)) {
            $guncelle = $db->prepare("UPDATE hakkimda SET resim=:resim, yazi=:yazi WHERE id=:id");
            $guncelle->execute([
                "resim" => $resimAdi,
                "yazi" => $_POST["aciklama"],
                "id" =>1
            ]);


            if($guncelle){
                header("location:hakkimda.php?durum=ok");

            }else{
                header("location:hakkimda.php?durum=no");

            }
        }


        }else{


                $guncelle = $db->prepare("UPDATE hakkimda SET yazi=:yazi WHERE id=:id");
                $guncelle->execute([
                    "yazi" => $_POST["aciklama"],
                    "id" =>1
                ]);


                if($guncelle){
                    header("location:hakkimda.php?durum=ok");

                }else{
                    header("location:hakkimda.php?durum=no");

                }


        }

}



?>
<!-- /.content -->
<?php include 'include/footer.php'; ?>
