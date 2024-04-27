<?php include_once("../includes-admin/header.php"); ?>

<title>SGV - Notícias / Dicas</title>

<?php
require("../config/connection.php");
$connection = new Database();
?>

<div class="modal fade" id="modal_create_news" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="create_news" class="create_news_class" method="POST">
                <div id="header_add">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createLabel">NOVA DICA / NOTÍCIA</h5>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12">
                            <label>Título: <span class="label-required">*</span></label>
                            <input type="text" name="title" autocomplete="off" required placeholder="Ex: Malefícios do álcool" minlength="3" maxlength="100" class="form-control">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>Data inicial da dica: </label>
                            <input type="date" name="init_date" class="form-control">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label>Data final da dica: </label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                        <div class="col-md-12 mt-4 d-flex justify-content-center">
                            Fixar dica no topo?
                            <input class="form-check-input me-1 ms-3" type="radio" checked value="0" name="fixed" id="checkN">
                            <label class="form-check-label me-3" for="checkN">
                                NÃO
                            </label>
                            <input class="form-check-input me-1" type="radio" value="1" name="fixed" id="checkS">
                            <label class="form-check-label me-3" for="checkS">
                                SIM
                            </label>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label>Texto: <span class="label-required">*</span></label>
                            <textarea class="form-control" name="text" placeholder="Ex: O álcool tem X e Y malefícios por ter na sua composição Z!" rows="3" maxlength="2000"></textarea>
                        </div>

                        <div class="col-md-12">
                            <?php
                            $queryVices = $connection->connection()->query("SELECT * FROM `vices` ORDER BY `name` ASC");
                            $vices = $queryVices->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <label for="vice_id" class="mb-2 mt-3">Vício: <span class="label-required">*</span></label>
                            <select name="vice_id" id="new_vice" class="form-control select_vice_id">
                                <option value="">SELECIONE...</option>
                                <?php foreach ($vices as $vice) { ?>
                                    <option value="<?php echo $vice['id']; ?>"><?php echo $vice['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-12 label-required mt-3"> * Campo obrigatório! </div>
                    </div>
                </div>

                <div class="row p-3">
                    <div class="col-md-12 d-flex align-items-center justify-content-between">
                        <button type="reset" class="btn btn-danger darkmode-ignore" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> CANCELAR </button>

                        <button type="submit" class="btn btn-success darkmode-ignore" id="button-save-news"><i class="fa-solid fa-check"></i> CADASTRAR </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_delete_news" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="header_delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">EXCLUIR DICA / NOTÍCIA</h5>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="delete_news_id">
                <h5> Tem certeza que deseja excluir essa notícia / dica? </h5>
            </div>
            <div class="row p-3">
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal"> CANCELAR </button>

                    <a class="btn btn-danger darkmode-ignore" id="delete_news"><i class="fa-solid fa-trash"></i> EXCLUIR</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container border rounded p-5 mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>NOTÍCIAS / DICAS</h1>
        </div>
        <div class="col-md-6 mt-2 mb-3 text-end">
            <button type="button" class="btn btn-success darkmode-ignore" data-bs-toggle="modal" data-bs-target="#modal_create_news">
                <i class="fa-solid fa-plus"></i> CADASTRAR DICA
            </button>
        </div>

        <?php

        $search = NULL;
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

        $max_linhas = 10;
        $inicio = ($max_linhas * $pagina) - $max_linhas;

        $sqlSub = ("SELECT * FROM `news` WHERE 3=3");

        if ($search) {
            $sqlSub .= (" AND `news`.`title` LIKE " . "'%" . $search . "%' ORDER BY `title` ASC");
        } else {
            $sqlSub .= (" ORDER BY `title` ASC");
        }

        $sqlSub .= (" LIMIT $inicio, $max_linhas");

        $news = $connection->connection()->query($sqlSub)->fetchAll(PDO::FETCH_ASSOC);

        $contador = $connection->connection()->query("SELECT COUNT(*) AS `ROWS` FROM `news` WHERE `title` LIKE " . "'%" . $search . "%'")->fetch(PDO::FETCH_ASSOC);

        $numero_paginas = ceil($contador['ROWS'] / $max_linhas);

        ?>

        <form method="get">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Pesquisar por título" autocomplete="off">
                        <div class="input-group-pprend">
                            <button class="btn btn-secondary darkmode-ignore"><i class="fa-solid fa-magnifying-glass"></i><?php if ($search) { ?> LIMPAR PESQUISA <?php  } else { ?> PESQUISAR <?php } ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-sm table-striped mt-3">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">IMAGEM</th>
                        <th scope="col">TÍTULO</th>
                        <th scope="col">DATA INICIAL</th>
                        <th scope="col">DATA FINAL</th>
                        <th scope="col">VÍCIO</th>
                        <th scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news as $new) { ?>
                        <tr>
                            <th><?php if ($new['end_date'] != null && date('Y-m-d') > $new['end_date']) { ?>
                                    <div class="text-center">
                                        <span data-tooltip="Dica desabilitada!"><i class="fa-solid fa-circle-exclamation atention"></i></span>
                                    </div>
                                <?php } ?>
                            </th>
                            <th class="img-center"><?php if ($new['img']) { ?>
                                    <img class="img-news-list" src="../news/<?php echo $new['img']; ?>" alt="">
                                <?php } else { ?>
                                    <img class="img-news-list" src="../news/no-img.png">
                                <?php } ?>
                            </th>
                            <td class="admin-new-title"><strong><?php $texto = $new['title'];
                                                                $tamanho = strlen($texto);
                                                                $max = 30;

                                                                if ($tamanho > $max) {
                                                                    echo mb_substr($texto, 0, $max) . "...";
                                                                } else {
                                                                    echo $texto;
                                                                }
                                                                ?></strong></td>
                            <td><?php if ($new['init_date'] != NULL) {
                                    echo date('d/m/Y', strtotime($new['init_date']));
                                } else {
                                    echo '';
                                } ?></td>
                            <td><?php if ($new['end_date'] != NULL) {
                                    echo date('d/m/Y', strtotime($new['end_date']));
                                } else {
                                    echo '';
                                } ?></td>
                            <td>
                                <?php foreach ($vices as $vice) {
                                    if ($vice['id'] == $new['vices_id']) {
                                        $texto = $vice['name'];
                                        $tamanho = strlen($texto);
                                        $max = 30;

                                        if ($tamanho > $max) {
                                            echo mb_substr($texto, 0, $max) . "...";
                                        } else {
                                            echo $texto;
                                        }
                                    }
                                } ?>
                            </td>
                            <td>
                                <a href="new.php?id=<?php echo $new['id']; ?>" class="btn btn-primary darkmode-ignore btn-sm"><i class="fa-solid fa-pen-to-square"></i> EDITAR</a>
                                <button type="button" class="btn btn-danger darkmode-ignore btn-sm get_news" data-id="<?php echo $new['id']; ?>">
                                    <i class="fa-solid fa-trash"></i> EXCLUIR
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if (count($news) == 0) { ?>

                <div id="no-results" class="border rounded p-4 row">
                    <div class="col-md-12 d-flex justify-content-center size-big">
                        <i class="fa-solid fa-magnifying-glass mt-2 me-2"></i> Nenhum resutado para sua pesquisa
                    </div>
                    <div class="col-md-12 d-flex justify-content-center mt-3">
                        <input type="hidden" name="search" value="">
                        <a class="btn btn-lg btn-secondary darkmode-ignore" href="?search="> <i class="fa-solid fa-broom"></i> LIMPAR FILTRO</a>
                    </div>
                </div>

            <?php } ?>

            <div class="table-responsive">

                <nav aria-label="navigation">
                    <ul class="pagination justify-content-center">
                        <?php
                        $lim = 5;
                        $inicio = ((($pagina - $lim) > 1) ? $pagina - $lim : 1);
                        $fim = ((($pagina + $lim) < $numero_paginas) ? $pagina + $lim : $numero_paginas);

                        if ($numero_paginas > 1 && $pagina <= $numero_paginas) {
                            for ($i = $inicio; $i <= $fim; $i++) {
                                if ($i == $pagina) { ?>
                                    <li class="nav-item">
                                        <a class="bg-primary page-link text-white"><?php echo $i; ?></a>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item">
                                        <a class="badge-secondary nav-color page-link" href="<?php echo '?pagina='; ?><?php echo $i ?>&search=<?php echo $search; ?>"><?php echo $i ?></a>
                                    </li>
                        <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php include_once("../includes-admin/footer.php"); ?>