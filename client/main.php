<?php include_once("../includes-client/header.php"); ?>

<title>SGV - Início</title>

<?php
require("../config/connection.php");
$connection = new Database();

$queryClients = $connection->connection()->query("SELECT * FROM `client` WHERE `id` = " . $_SESSION['user_id']);
$client = $queryClients->fetch(PDO::FETCH_ASSOC);
?>

<div class="modal fade" id="modal_delete_count" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="header_delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">REINICIAR CONTADOR</h5>
                </div>
            </div>
            <form id="delete_count" method="POST">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id" id="delete_count_id">

                    <h5> Tem certeza que deseja reiniciar seu contador de dias limpo? </h5>

                </div>
                <div class="row p-3">
                    <div class="col-md-12 d-flex align-items-center justify-content-between">
                        <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal"> CANCELAR </button>

                        <button type="submit" class="btn btn-danger darkmode-ignore" id="button-count-delete"><i class="fa-solid fa-rotate-left"></i> REINICIAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center text-all">
    <div class="col-md-12 d-flex justify-content-center">
        <h1 class="text-clean">Você está a</h1>
    </div>
    <div class="col-md-12 d-flex justify-content-center">
        <h1 id="clean-days">
            <?php
            $date_start = new DateTime(date("Y-m-d"));

            $date_today = new DateTime($client['register_day']);

            $interval = $date_today->diff($date_start);

            echo $interval->days + $client['clean_days']; ?>
        </h1>
    </div>
    <div class="col-md-12 d-flex justify-content-center">
        <h1 class="text-clean">Dia<?php if ($interval->days + $client['clean_days'] != 1) { ?>s<?php } ?> limpo!</h1>
    </div>

    <div class="col-md-12 d-flex justify-content-center mt-4">
        <button type="button" class="btn btn-danger darkmode-ignore get_client_clean" data-id="<?php echo $client['id']; ?>"><i class="fa-solid fa-rotate-left"></i> Reiniciar contador</button>
    </div>
</div>


<?php include_once("../includes-client/footer.php"); ?>