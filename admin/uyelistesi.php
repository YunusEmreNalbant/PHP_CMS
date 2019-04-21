<?php include 'include/header.php'; ?>
<?php

$anasayfa=$db->prepare("select * from uyeler");
$anasayfa->execute();
$rows = $anasayfa->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="assets/css/skin-green.min.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">

</head>
<body>

<div class="container">
    <div class="box-body">
        <h3 class="text-center"> Üyeler </h3>
        <hr>
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <th>#ID</th>
                <th>Üye Kullanıcı Adı</th>
                <th>Üye Şifresi</th>
                <th>İşlem</th>
            </thead>

            <tbody>
                <?php foreach ($rows as $row){ ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["uyekad"] ?></td>
                    <td><?= $row["uyepass"] ?></td>
                    <td>
                        <a class="btn-danger btn-sm" href="?id=<?= $row["id"] ?>">Sil</a>
                        <?php
                        if(@$_GET["id"]){
                            $sil  = $db->prepare("DELETE FROM uyeler WHERE id=:id");
                            $sil->execute(["id" => $_GET["id"]]);

                            if($sil){
                                header("Location:uyelistesi.php");
                            }
                        }




                        ?>

                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>