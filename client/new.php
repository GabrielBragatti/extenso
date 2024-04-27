<?php include_once("../includes-client/header.php"); ?>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;

require("../config/connection.php");
$connection = new Database();

$queryclient = $connection->connection()->query("SELECT * FROM `client` WHERE `id` = " . $_SESSION['user_id']);
$client = $queryclient->fetch(PDO::FETCH_ASSOC);
?>


<?php if (!$id) { ?>

    <div class="container mt-5 text-center">
        <h3 class="alert alert-danger text-uppercase">Dica não encontrada!</h3>
        <a href="news.php" class="btn btn-primary darkmode-ignore">VOLTAR</a>
    </div>

<?php } else { ?>

    <?php
    $queryNews = $connection->connection()->query("SELECT * FROM `news` WHERE `id` = " . $id);
    $new = $queryNews->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="big-img">
        <i class="fa-solid fa-x icon-close"></i>
        <?php if ($new['img']) { ?>
            <img id="img-big" src="../news/<?php echo $new['img']; ?>" alt="Imagem dica">
        <?php } else { ?>
            <img id="img-big" src="../news/no-img.png" alt="Imagem dica">
        <?php } ?>
    </div>

    <?php if (!$new) { ?>

        <div class="container mt-5 text-center default-margin-top">
            <h3 class="alert alert-danger text-uppercase">Dica não encontrada!</h3>
            <a href="news.php" class="btn btn-primary darkmode-ignore">VOLTAR</a>
        </div>

    <?php } else { ?>

        
        <div class="container border rounded default-margin-top mb-5">
            <div id="new-details">
                <div class="row">
                    <center>
                        <div class="col-md-12 " id="content-new-img">
                            <?php if ($new['img']) { ?>
                                <img id="new-img" src="../news/<?php echo $new['img']; ?>" alt="">
                            <?php } else { ?>
                                <img id="new-img" src="../news/no-img.png">
                            <?php } ?>
                        </div>
                    </center>
                    <div class="col-md-12 p-5 pt-4">
                        <div id="new-name" class="new-name-uppercase overpass"> <b> <?php echo $new['title']; ?> </b> </div>

                        <div id="description" class="pt-3">
                            <p style="white-space: pre-wrap;"><?= $new['text']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $queryNewsVices = $connection->connection()->query("SELECT * FROM `news` WHERE `vices_id` = " . $client['vices_id'] . " AND `id` != " . $id);
        $newsVices = $queryNewsVices->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php if (count($newsVices) > 0) { ?>
            <div class="container mt-5 mb-5 ps-3 border rounded">
                <div class="row mb-3 mt-3">
                    <div class="col-md-12">
                        <h3> MAIS DICAS: </h3>
                    </div>
                </div>
                <div class="row pb-2">
                    <?php foreach ($newsVices as $newVices) { ?>
                        <?php if ($newVices['id'] != $id) { ?>
                            <?php if ($newVices['init_date'] == NULL || $newVices['init_date'] == date('Y-m-d') || $newVices['init_date'] < date('Y-m-d')) { ?>
                                <?php if ($newVices['end_date'] == NULL || $newVices['end_date'] == date('Y-m-d') || $newVices['end_date'] > date('Y-m-d')) { ?>
                                    <div class="col-md-2 mb-2">
                                        <div class="card">
                                            <div class="img-container">
                                                <a href="./new.php?id=<?php echo $newVices['id']; ?>">
                                                    <?php if ($newVices['img']) { ?>
                                                        <img src="../news/<?php echo $newVices['img']; ?>" class="card-img-top-new" alt="">
                                                    <?php } else { ?>
                                                        <img src="../news/no-img.png" class="card-img-top-new">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <div class="card-body-new">
                                                <center class="card-informations">
                                                    <h5 class="card-title new-name-uppercase mb-2">
                                                        <?php
                                                        $texto = $newVices['title'];
                                                        $tamanho = strlen($texto);
                                                        $max = 20;

                                                        if ($tamanho > $max) {
                                                            echo mb_substr($texto, 0, $max) . "...";
                                                        } else {
                                                            echo $texto;
                                                        }
                                                        ?>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                    if ($i == 6) {
                                        break;
                                    }
                                    ?>
                    <?php }
                            }
                        }
                    } ?>
                </div>
            </div>
        <?php }  ?>
    <?php }  ?>
<?php }  ?>

<?php include_once("../includes-client/footer.php"); ?>