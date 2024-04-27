<?php include_once("../includes-client/header.php"); ?>

<title>SGV - Dicas / Notícias</title>

<?php
require("../config/connection.php");
$connection = new Database();

$queryClient = $connection->connection()->query("SELECT * FROM `client` WHERE `id` = " . $_SESSION['user_id']);
$client = $queryClient->fetch(PDO::FETCH_ASSOC);

$queryNews = $connection->connection()->query("SELECT * FROM `news` WHERE `vices_id` = " . $client['vices_id'] . " AND `fixed` != 1 ORDER BY `title` ASC");
$news = $queryNews->fetchAll(PDO::FETCH_ASSOC);

$queryNewsF = $connection->connection()->query("SELECT * FROM `news` WHERE `vices_id` = " . $client['vices_id'] . " AND `fixed` = 1 ORDER BY `title` ASC");
$newsFixed = $queryNewsF->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">

    <div class="row">

        <?php foreach ($newsFixed as $newFixed) { ?>
            <?php if ($newFixed['init_date'] == NULL || $newFixed['init_date'] == date('Y-m-d') || $newFixed['init_date'] < date('Y-m-d')) { ?>
                <?php if ($newFixed['end_date'] == NULL || $newFixed['end_date'] == date('Y-m-d') || $newFixed['end_date'] > date('Y-m-d')) { ?>
                    <div class="col-md-4 mb-5">
                        <a href="./new.php?id=<?php echo $newFixed['id']; ?>" class="no-style">
                            <div class="card" style="width: 20rem;">
                                <div class="img-container">
                                    <i class="fa-solid fa-thumbtack icon-fixed"></i>
                                    <img src="../news/<?php if ($newFixed['img'] == null) {
                                                            echo "no-img.jpg";
                                                        } else {
                                                            echo $newFixed['img'];
                                                        } ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php $texto = $newFixed['title'];
                                                            $tamanho = strlen($texto);
                                                            $max = 30;

                                                            if ($tamanho > $max) {
                                                                echo mb_substr($texto, 0, $max) . "...";
                                                            } else {
                                                                echo $texto;
                                                            }
                                                            ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>

        <?php foreach ($news as $new) { ?>
            <?php if ($new['init_date'] == NULL || $new['init_date'] == date('Y-m-d') || $new['init_date'] < date('Y-m-d')) { ?>
                <?php if ($new['end_date'] == NULL || $new['end_date'] == date('Y-m-d') || $new['end_date'] > date('Y-m-d')) { ?>
                    <div class="col-md-4 mb-5">
                        <a href="./new.php?id=<?php echo $new['id']; ?>" class="no-style">
                            <div class="card" style="width: 20rem;">
                                <div class="img-container"> <img src="../news/<?php if ($new['img'] == null) {
                                                                                    echo "no-img.jpg";
                                                                                } else {
                                                                                    echo $new['img'];
                                                                                } ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php $texto = $new['title'];
                                                            $tamanho = strlen($texto);
                                                            $max = 30;

                                                            if ($tamanho > $max) {
                                                                echo mb_substr($texto, 0, $max) . "...";
                                                            } else {
                                                                echo $texto;
                                                            }
                                                            ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<?php include_once("../includes-client/footer.php"); ?>