<?php
require("../../../config/connection.php");

$connection = new Database();

$sql = $connection->connection()->query("SELECT * FROM `vices` ORDER BY `name` ASC");
$sqlType = $connection->connection()->query("SELECT * FROM `type`");
$types = $sqlType->fetchAll(PDO::FETCH_ASSOC);

if ($sql->rowCount() > 0) {
    foreach ($sql->fetchAll() as $vice) {
?>

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

<?php
    }
}
?>

<script src="../js/admin/vices/create.js"></script>
<script src="../js/admin/vices/delete.js"></script>
<script src="../js/admin/vices/edit.js"></script>