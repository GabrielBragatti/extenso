<?php include_once("../includes-admin/header.php"); ?>

<title>SGV - Usuários</title>

<?php
require("../config/connection.php");
$connection = new Database();

$queryVice = $connection->connection()->query("SELECT * FROM `vices` ORDER BY `name` ASC");
$vices = $queryVice->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="modal fade" id="modal_create_client" tabindex="-1" aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="create_client" class="create_client_class" method="POST">
                <div id="header_add">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createLabel">NOVO CLIENTE</h5>
                    </div>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9">
                            <label class="mb-2">Nome: <span class="label-required">*</span></label>
                            <input type="text" name="name" autocomplete="off" required placeholder="Ex: João da Silva" minlength="3" maxlength="100" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="mb-2">Data de cadastro: </label>
                            <input type="date" name="date" value="<?php echo date("Y-m-d"); ?>" autocomplete="off" disabled class="form-control">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="mb-2">E-mail: <span class="label-required">*</span></label>
                            <input type="email" name="email" autocomplete="off" required placeholder="Ex: joao.silva@email.com" minlength="3" maxlength="100" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="mb-2">Dias limpo iniciais: <span class="label-required">*</span></label>
                            <input type="number" name="clean_days" autocomplete="off" required placeholder="Ex: 5" minlength="1" maxlength="1000" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="vice_id" class="mb-2 mt-3">Vício: <span class="label-required">*</span></label>
                            <select name="vice_id" id="new_client" class="form-control select_vice_id">
                                <option value="">SELECIONE...</option>
                                <?php foreach ($vices as $vice) { ?>
                                    <option value="<?php echo $vice['id']; ?>"><?php echo $vice['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="mb-2">Senha: <span class="label-required">*</span></label>
                            <input type="password" name="password" autocomplete="off" required placeholder="Ex: ********" minlength="3" maxlength="100" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label class="mb-2">Confirme a senha: <span class="label-required">*</span></label>
                            <input type="password" name="password_confirm" autocomplete="off" required placeholder="Ex: ********" minlength="3" maxlength="100" class="form-control">
                        </div>

                        <div class="col-md-12 label-required mt-3"> * Campo obrigatório! </div>
                    </div>
                </div>

                <div class="row p-3">
                    <div class="col-md-12 d-flex align-items-center justify-content-between">
                        <button type="reset" class="btn btn-danger darkmode-ignore" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> CANCELAR </button>

                        <button type="submit" class="btn btn-success darkmode-ignore"><i class="fa-solid fa-check"></i> CADASTRAR </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_delete_client" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="header_delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">EXCLUIR CLIENTE</h5>
                </div>
            </div>
            <form id="delete_client" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" id="delete_client_id">

                    <h5> Tem certeza que deseja excluir esse cliente? </h5>

                    <div class="col-md-12 mt-3">
                        <label>Digite a senha do cliente: <span class="label-required">*</span></label>

                        <input type="password" name="passwordConfirmDelete" id="passwordConfirmDelete" autocomplete="off" required class="form-control" placeholder="**********">

                    </div>

                    <div class="col-md-12 label-required mt-3"> * Campo obrigatório! </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-12 d-flex align-items-center justify-content-between">
                        <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal"> CANCELAR </button>

                        <button type="submit" class="btn btn-danger darkmode-ignore" id="button-client-delete"><i class="fa-solid fa-trash"></i> EXCLUIR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_client" tabindex="-1" aria-labelledby="editClientLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="header_edit">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel"> EDITAR CLIENTE </h5>
                </div>
            </div>
            <div class="modal-body">
                <form id="edit_client" method="POST">
                    <input type="hidden" name="id" id="edit_client_id">

                    <div class="row">

                        <div class="col-md-12">
                            <label> Nome: <span class="label-required">*</span></label>
                            <input type="text" name="name" class="form-control" id="edit_client_name" required maxlength="100">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label> E-mail: <span class="label-required">*</span></label>
                            <input type="email" name="email" class="form-control" id="edit_client_email" required maxlength="100">
                        </div>

                        <div class="col-md-6 ">
                            <label for="vice_id" class="mt-3">Vício: <span class="label-required">*</span></label>
                            <select name="vice_id" id="edit_vice_id" class="form-control select_vice_id">
                                <?php foreach ($vices as $vice) { ?>
                                    <option value="<?php echo $vice['id']; ?>"><?php echo $vice['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label> Dias limpo: <span class="label-required">*</span></label>
                            <input type="number" name="clean" class="form-control" id="edit_client_clean" required maxlength="100">
                        </div>

                        <div class="col-md-12 mt-3 mb-2">
                            <label> Senha do usuário: <span class="label-required">*</span></label>
                            <input type="password" name="password_confirm" class="form-control" required maxlength="100">
                        </div>

                        <div class="col-md-12 label-required mt-2 mb-4"> * Campo obrigatório! </div>

                        <div class="col-md-12 d-flex align-items-center justify-content-between">
                            <button type="reset" class="btn btn-danger darkmode-ignore" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i>  CANCELAR </button>

                            <button type="submit" class="btn btn-success darkmode-ignore" id="button-save-client"><i class="fa-solid fa-check" id="icon-check-client"></i> <span class="spinner-border spinner-border-sm" id="spinner-client" style="display: none;" role="status" aria-hidden="true"></span> SALVAR </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_edit_pass" tabindex="-1" aria-labelledby="editPassLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="header_pass">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel"> EDITAR SENHA</h5>
                </div>
            </div>
            <div class="modal-body">
                <form id="edit_pass" method="POST">
                    <input type="hidden" name="id" id="edit_pass_id">

                    <div class="row">

                        <div class="col-md-12">
                            <label>Nova senha: <span class="label-required">*</span></label>
                            <input type="password" name="newPassword" id="newPassword" autocomplete="off" required class="form-control" placeholder="**********">
                        </div>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>Confirmar nova senha: <span class="label-required">*</span></label>
                        <input type="password" name="newPasswordConfirm" id="newPasswordConfirm" autocomplete="off" required class="form-control" placeholder="**********">
                    </div>

                    <div class="col-md-12 mt-4 mb-2">
                        <label>Senha atual do usuário: <span class="label-required">*</span></label>
                        <input type="password" name="passwordConfirm2" id="newPasswordEditConfirm" autocomplete="off" required class="form-control" placeholder="**********">
                    </div>

                    <div class="col-md-12 label-required mt-2 mb-4"> * Campo obrigatório! </div>
                    <div class="col-md-12 d-flex align-items-center justify-content-between">
                        <button type="reset" class="btn btn-danger darkmode-ignore" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> CANCELAR </button>

                        <button type="submit" class="btn btn-success darkmode-ignore" id="button-pass-edit"><i class="fa-solid fa-check" id="check-pass-edit"></i><span class="spinner-border spinner-border-sm" id="spinner-pass" style="display: none;" role="status" aria-hidden="true"></span> SALVAR </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container border rounded p-5 mt-5">
    <div class="row">
        <div class="col-md-6">
            <h1>USUÁRIOS</h1>
        </div>
        <div class="col-md-6 mt-2 mb-3 text-end">
            <button type="button" class="btn btn-success darkmode-ignore" data-bs-toggle="modal" data-bs-target="#modal_create_client">
                <i class="fa-solid fa-plus"></i> CADASTRAR USUÁRIO
            </button>
        </div>

        <?php

        $search = NULL;
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

        $max_linhas = 10;
        $inicio = ($max_linhas * $pagina) - $max_linhas;

        $sqlSub = ("SELECT * FROM `client` WHERE 3=3");

        if ($search) {
            $sqlSub .= (" AND `client`.`name` LIKE " . "'%" . $search . "%' ORDER BY `name` ASC");
        } else {
            $sqlSub .= (" ORDER BY `name` ASC");
        }

        $sqlSub .= (" LIMIT $inicio, $max_linhas");

        $clients = $connection->connection()->query($sqlSub)->fetchAll(PDO::FETCH_ASSOC);

        $contador = $connection->connection()->query("SELECT COUNT(*) AS `ROWS` FROM `client` WHERE `name` LIKE " . "'%" . $search . "%'")->fetch(PDO::FETCH_ASSOC);

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
                        <th scope="col">VÍCIO</th>
                        <th scope="col">DIAS LIMPO</th>
                        <th scope="col">CADASTRO</th>
                        <th scope="col">AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client) { ?>
                        <tr>
                            <td class="admin-client-name"><strong><?php $texto = $client['name'];
                                                                    $tamanho = strlen($texto);
                                                                    $max = 30;

                                                                    if ($tamanho > $max) {
                                                                        echo mb_substr($texto, 0, $max) . "...";
                                                                    } else {
                                                                        echo $texto;
                                                                    }
                                                                    ?></strong></td>
                            <td>
                                <?php foreach ($vices as $vice) {
                                    if ($vice['id'] == $client['vices_id']) {
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
                            <td class="text-center"><strong><?php $texto = $client['clean_days'];
                                                            $tamanho = strlen($texto);
                                                            $max = 30;

                                                            if ($tamanho > $max) {
                                                                echo mb_substr($texto, 0, $max) . "...";
                                                            } else {
                                                                echo $texto;
                                                            }
                                                            ?></strong></td>
                            <td><?php echo date('d/m/Y', strtotime($client['register_day'])); ?></td>
                            <td>
                                <button type="button" class="btn btn-primary darkmode-ignore btn-sm btn_edit_client" data-id="<?php echo $client['id']; ?>" data-name="<?php echo $client['name']; ?>" data-clean="<?php echo $client['clean_days']; ?>" data-email="<?php echo $client['email']; ?>" data-vice_id="<?php echo $client['vices_id']; ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    EDITAR
                                </button>
                                <button type="button" class="btn btn-secondary darkmode-ignore btn-sm btn_edit_pass" data-id="<?php echo $client['id']; ?>">
                                    <i class="fa-solid fa-key"></i>
                                    EDITAR SENHA
                                </button>
                                <button type="button" class="btn btn-danger darkmode-ignore btn-sm get_client" data-id="<?php echo $client['id']; ?>">
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