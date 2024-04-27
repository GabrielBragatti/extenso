<?php include_once("../includes-client/header.php"); ?>

<title>SGV - Conta</title>

<?php
require("../config/connection.php");
$connection = new Database();

$id = isset($_GET['id']) ? $_GET['id'] : null;
?>

<?php

$query = $connection->connection()->prepare("
            SELECT * FROM `client` WHERE `id` = :id");
$query->execute(array(':id' => $_SESSION['user_id']));

$client = $query->fetch(PDO::FETCH_ASSOC);
?>

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

<div class="container p-5">
    <div class="row">
        <div class="col-md-12">
            <form id="update_client_account" method="POST">
                <div class="row">
                    <input type="hidden" value="<?php echo $client['id']; ?>" name="id" class="form-control">

                    <div class="col-md-12">
                        <label>Nome: <span class="label-required darkmode-ignore">*</span></label>
                        <input type="text" value="<?php echo $client['name']; ?>" name="name" autocomplete="off" required minlength="3" maxlength="100" class="form-control">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>E-mail: <span class="label-required darkmode-ignore">*</span></label>
                        <input type="email" value="<?php echo $client['email']; ?>" name="email" autocomplete="off" required minlength="3" maxlength="100" class="form-control">
                    </div>

                    <div class="col-md-12 mt-3">
                        <?php
                        $queryVices = $connection->connection()->query("SELECT * FROM `vices` ORDER BY `name` ASC");
                        $vices = $queryVices->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <label for="vices_id">Vício: <span class="label-required darkmode-ignore">*</span></label>
                        <select name="vice_id" id="vices_id" class="form-select select-input select_vices_id">
                            <?php foreach ($vices as $vice) { ?>
                                <?php if ($client['vices_id'] == $vice['id']) { ?>
                                    <option value="<?php echo $vice['id']; ?>" selected><?php echo $vice['name']; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $vice['id']; ?>"><?php echo $vice['name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-12 mt-3">
                        <label>Digite a senha do usuário para salvar: <span class="label-required darkmode-ignore">*</span></label>
                        <input type="password" name="password_confirm" autocomplete="off" required minlength="3" maxlength="100" class="form-control">
                    </div>

                    <div class="col-md-12 label-required mt-3 darkmode-ignore"> * Campo obrigatório! </div>
                    <div class="col-md-12 mt-5 text-end">
                        <button type="reset" class="btn btn-secondary darkmode-ignore mb-2"><i class="fa-solid fa-delete-left"></i> LIMPAR </button>
                        <button type="button" class="btn btn-secondary darkmode-ignore btn_edit_pass mb-2" data-id="<?php echo $client['id']; ?>">
                            <i class="fa-solid fa-key"></i>
                            EDITAR SENHA
                        </button>
                        <button type="submit" class="btn btn-success darkmode-ignore mb-2" id="button-save"><i class="fa-solid fa-check" id="icon-check"></i> <span class="spinner-border spinner-border-sm" id="spinner" style="display: none;" role="status" aria-hidden="true"></span> SALVAR ALTERAÇÕES </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once("../includes-client/footer.php"); ?>