<?php include 'include/header.php'; ?>

<?php

if($_GET["id"]) {

    $detay = $db->prepare("SELECT * FROM calismalar WHERE id=:gelenid");
    $detay->execute(["gelenid" => $_GET["id"]]);
    $row = $detay->fetch(PDO::FETCH_OBJ);
}

?>



<!-- About Me -->
<section id="about" class="three">
    <div class="container">

        <header>
            <h2><?= $row->baslik ?></h2>
        </header>

        <a href="#" class="image featured"><img src="assets/upload/<?= $row->resim ?>" alt="" height="400"/></a>

        <p><?php if(!empty($row->aciklama)){

            echo $row->aciklama;
            }else {
                echo 'aciklama eklenmedi';
            }?></p>

    </div>
</section>



<?php include 'include/footer.php'; ?>
