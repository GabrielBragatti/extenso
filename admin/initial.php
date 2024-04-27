<?php include_once("../includes-admin/header.php"); ?>

<title>SGV - Vícios</title>

<?php
require("../config/connection.php");
$connection = new Database();
?>

<div class="modal fade" id="modal_create_vice" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="create_vice" class="create_vice_class" method="POST">
                <div id="header_add">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createLabel">NOVO VÍCIO</h5>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="mb-2">Nome: <span class="label-required">*</span></label>
                            <input type="text" name="name" autocomplete="off" required placeholder="Ex: Drogas" minlength="3" maxlength="100" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <?php
                            $queryType = $connection->connection()->query("SELECT * FROM `type` ORDER BY `name` ASC");
                            $types = $queryType->fetchAll(PDO::FETCH_ASSOC);
                            ?>
                            <label for="type_id" class="mb-2 mt-3">Tipo de vicio: <span class="label-required">*</span></label>
                            <select name="type_id" id="new_vice" class="form-control select_type_id">
                                <option value="">SELECIONE...</option>
                                <?php foreach ($types as $type) { ?>
                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-12 label-required mt-3"> * Campo obrigatório! </div>
                    </div>
                </div>

                <div class="row p-3">
                    <div class="col-md-12 d-flex align-items-center justify-content-between">
                        <button type="reset" class="btn btn-danger darkmode-ignore" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> CANCELAR </button>

                        <button type="submit" class="btn btn-success darkmode-ignore" id="button-save-vice"><i class="fa-solid fa-check"></i> CADASTRAR </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_delete_vice" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="header_delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">EXCLUIR VÍCIO</h5>
                </div>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" id="delete_vice_id">
                <h5> Tem certeza que deseja excluir esse vício? </h5>
            </div>
            <div class="row p-3">
                <div class="col-md-12 d-flex align-items-center justify-content-between">
                    <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal"> CANCELAR </button>

                    <a class="btn btn-danger darkmode-ignore" id="delete_vice"><i class="fa-solid fa-trash"></i> EXCLUIR</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_vice" tabindex="-1" aria-labelledby="editViceLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="header_edit">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel"> EDITAR VÍCIO </h5>
                </div>
            </div>
            <div class="modal-body">
                <form id="edit_vice" method="POST">
                    <input type="hidden" name="id" id="edit_vice_id">

                    <div class="row">

                        <div class="col-md-12">
                            <label> Nome: <span class="label-required">*</span></label>
                            <input type="text" name="name" class="form-control" id="edit_vice_name" required maxlength="100">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label for="edit_vice_type_id" class="mb-2 mt-3">Tipo de vício: <span class="label-required">*</span></label>
                            <select name="type_id" id="edit_vice_type_id" class="form-control">
                                <option value="">SELECIONE...</option>
                                <?php foreach ($types as $type) { ?>
                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-12 label-required mt-2 mb-4"> * Campo obrigatório! </div>

                        <div class="col-md-12 d-flex align-items-center justify-content-between">
                            <button type="reset" class="btn btn-danger darkmode-ignore" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i>  CANCELAR </button>

                            <button type="submit" class="btn btn-success darkmode-ignore" id="button-save-vice"><i class="fa-solid fa-check" id="icon-check-vice"></i> <span class="spinner-border spinner-border-sm" id="spinner-vice" style="display: none;" role="status" aria-hidden="true"></span> SALVAR </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container border rounded p-5 mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>VÍCIOS</h1>
        </div>
        <div class="col-md-6 mt-2 mb-3 text-end">
            <button type="button" class="btn btn-success darkmode-ignore" data-bs-toggle="modal" data-bs-target="#modal_create_vice">
                <i class="fa-solid fa-plus"></i> CADASTRAR VÍCIO
            </button>
        </div>

        <?php

        $search = NULL;
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

        $max_linhas = 10;
        $inicio = ($max_linhas * $pagina) - $max_linhas;

        $sqlSub = ("SELECT * FROM `vices` WHERE 3=3");

        if ($search) {
            $sqlSub .= (" AND `vices`.`name` LIKE " . "'%" . $search . "%' ORDER BY `name` ASC");
        } else {
            $sqlSub .= (" ORDER BY `name` ASC");
        }

        $sqlSub .= (" LIMIT $inicio, $max_linhas");

        $vices = $connection->connection()->query($sqlSub)->fetchAll(PDO::FETCH_ASSOC);

        $contador = $connection->connection()->query("SELECT COUNT(*) AS `ROWS` FROM `vices` WHERE `name` LIKE " . "'%" . $search . "%'")->fetch(PDO::FETCH_ASSOC);

        $numero_paginas = ceil($contador['ROWS'] / $max_linhas);

        ?>

        <form method="get">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Pesquisar por nome" autocomplete="off">
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
                        <th scope="col">NOME</th>
                        <th scope="col">TIPO</th>
                        <th scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody class="table-vices">
                    <?php foreach ($vices as $vice) { ?>
                        <tr>
                            <td class="admin-vice-name"><strong><?php $texto = $vice['name'];
                                                                $tamanho = strlen($texto);
                                                                $max = 30;

                                                                    if ($tamanho > $max) {
                                                                    echo mb_substr($texto, 0, $max) . "...";
                                                                } else {
                                                                    echo $texto;
                                                                }
                                                                ?></strong></td>
                            <td>
                                <?php foreach ($types as $type) {
                                    if ($type['id'] == $vice['type_id']) {
                                        $texto = $type['name'];
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
                                <button type="button" class="btn btn-primary darkmode-ignore btn-sm btn_edit_vice" data-id="<?php echo $vice['id']; ?>" data-name="<?php echo $vice['name']; ?>" data-type_id="<?php echo $vice['type_id']; ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    EDITAR
                                </button>
                                <button type="button" class="btn btn-danger darkmode-ignore btn-sm get_vice" data-id="<?php echo $vice['id']; ?>">
                                    <i class="fa-solid fa-trash"></i> EXCLUIR
                                </button>   
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php if (count($vices) == 0) { ?>

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