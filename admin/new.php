<?php include_once("../includes-admin/header.php"); ?>

<title>SGV - Notícias / Dicas</title>

<?php
require("../config/connection.php");
$connection = new Database();

$id = isset($_GET['id']) ? $_GET['id'] : null;
?>

<?php if (!$id) { ?>

    <div class="container mt-5 text-center">
        <h3 class="alert alert-danger text-uppercase">Dica não encontrada!</h3>
        <a href="news.php" class="btn btn-primary darkmode-ignore">VOLTAR</a>
    </div>

<?php } else { ?>

    <?php

    $query = $connection->connection()->prepare("
            SELECT
                `news`.*,
                `vices`.`name` AS `vices_name`
            FROM
                `news`
            INNER JOIN `vices` ON `vices`.`id` = `news`.`vices_id`
            WHERE `news`.`id` = :id");
    $query->execute(array(':id' => $id));

    $news = $query->fetch(PDO::FETCH_ASSOC);
    ?>

    <?php if (!$news) { ?>

        <div class="container mt-5 text-center">
            <h3 class="alert alert-danger text-uppercase">Dica não encontrada!</h3>
            <a href="news.php" class="btn btn-primary darkmode-ignore">VOLTAR</a>
        </div>

    <?php } else { ?>
        <div class="container border p-5 mt-5">
            <div class="text-start mb-4">
                <a href="news.php" class="btn btn-primary darkmode-ignore"><i class="fa-solid fa-arrow-left"></i> VOLTAR</a>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <form id="update_news_img" method="POST">
                        <div class="row">
                            <?php if ($news['img']) { ?>
                                <div class="col-md-12">
                                    <img id="edit-news-img" src="../news/<?php echo $news['img']; ?>" alt="">
                                </div>
                                <div class="col-md-12 mt-2 d-grid gap-2">
                                    <button id="delete_news_img" type="button" class="btn btn-danger darkmode-ignore btn-block"><i class="fa-solid fa-trash"></i> EXCLUIR </button>
                                </div>
                            <?php } ?>
                            <div class="col-md-12 mt-2">
                                <div align="justify" class="alert alert-info">
                                    Recomendamos uma imagem de 1000x1000 pixels. Caso contrário não será bem apresentado na listagem de dicas.
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label>Imagem:</label>
                                <input class="form-control" type="file" name="img">
                                <input type="hidden" value="<?php echo $news['id']; ?>" name="id" id="news_id" class="form-control">
                            </div>
                            <div class="col-md-12 mt-2 d-grid gap-2">
                                <button type="submit" class="btn btn-success darkmode-ignore btn-block"><i class="fa-solid fa-floppy-disk"></i> SALVAR </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-9">
                    <form id="update_news" method="POST">
                        <div class="row">
                            <input type="hidden" value="<?php echo $news['id']; ?>" name="id" class="form-control">

                            <div class="col-md-12">
                                <label>Título: <span class="label-required">*</span></label>
                                <input type="text" value="<?php echo $news['title']; ?>" name="title" autocomplete="off" required minlength="3" maxlength="100" class="form-control">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label> Data inicial da dica: </label>
                                <input type="date" name="init_date" value="<?php if ($news['init_date'] != NULL) {
                                                                                echo date('Y-m-d', strtotime($news['init_date']));
                                                                            } else {
                                                                                echo '';
                                                                            } ?>" class="form-control">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label> Data final da dica: </label>
                                <input type="date" name="end_date" value="<?php if ($news['end_date'] != NULL) {
                                                                                echo date('Y-m-d', strtotime($news['end_date']));
                                                                            } else {
                                                                                echo '';
                                                                            } ?>" class="form-control">
                            </div>

                            <div class="col-md-12 mt-4 d-flex justify-content-center">
                                Fixar dica no topo?
                                <input class="form-check-input me-1 ms-3" type="radio" <?php if ($news['fixed'] == 0) { echo "checked"; } ?> value="0" name="fixed" id="checkN">
                                <label class="form-check-label me-3" for="checkN">
                                    NÃO
                                </label>
                                <input class="form-check-input me-1" type="radio" <?php if ($news['fixed'] != 0) { echo "checked"; } ?> value="1" name="fixed" id="checkS">
                                <label class="form-check-label me-3" for="checkS">
                                    SIM
                                </label>
                            </div>

                            <div class="col-md-12 mt-3">
                                <label>Descrição: <span class="label-required">*</span></label>
                                <textarea type="text" name="text" autocomplete="off" required rows="7" maxlength="2000" class="form-control"><?php echo $news['text']; ?></textarea>
                            </div>
                            <div class="col-md-12 mt-3">
                                <?php
                                $queryVices = $connection->connection()->query("SELECT * FROM `vices` ORDER BY `name` ASC");
                                $vices = $queryVices->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <label for="vices_id">Vício: <span class="label-required">*</span></label>
                                <select name="vices_id" id="vices_id" class="form-select select-input select_vices_id">
                                    <?php foreach ($vices as $vice) { ?>
                                        <?php if ($news['vices_id'] == $vice['id']) { ?>
                                            <option value="<?php echo $vice['id']; ?>" selected><?php echo $vice['name']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $vice['id']; ?>"><?php echo $vice['name']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-12 label-required mt-3"> * Campo obrigatório! </div>
                            <div class="col-md-12 mt-5 text-end">
                                <button type="reset" class="btn btn-secondary darkmode-ignore mb-2"><i class="fa-solid fa-delete-left"></i> LIMPAR </button>
                                <button type="submit" class="btn btn-success darkmode-ignore mb-2" id="button-save"><i class="fa-solid fa-check" id="icon-check"></i> <span class="spinner-border spinner-border-sm" id="spinner" style="display: none;" role="status" aria-hidden="true"></span> SALVAR ALTERAÇÕES </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    <?php }  ?>
<?php } ?>

<?php include_once("../includes-admin/footer.php"); ?>