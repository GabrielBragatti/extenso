<?php
session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != "" && $_SESSION['user_permission'] == "2") {
    header("Location: ./main.php");
    return;
}

require("../config/connection.php");
$connection = new Database();

$queryVice = $connection->connection()->query("SELECT * FROM `vices` ORDER BY `name` ASC");
$vices = $queryVice->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="icon" type="image/png" href="../images/icon.png"> -->
    <link rel="stylesheet" href="../Framework/Bootstrap/style.css">
    <link rel="stylesheet" href="../Framework/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
  <script>
    function addDarkmodeWidget() {
      const options = {
        mixColor: '#fff', // default: '#fff'
        backgroundColor: '#fff', // default: '#fff'
        buttonColorDark: '#100f2c', // default: '#100f2c'
        buttonColorLight: '#fff', // default: '#fff'
        saveInCookies: true, // default: true,
        label: '💡', // default: ''
        autoMatchOsTheme: true // default: true
      }
      
      const darkmode = new Darkmode(options).showWidget();
    }
    window.addEventListener('load', addDarkmodeWidget);
  </script>
    <title>SGV - Login</title>

</head>

<body>
    <div class="content-login border p-5" style="margin: 25vh auto;">
        <div id="content-login-user">
            <form id="user-login" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" name="email" autofocus placeholder="exemplo@email.com" autocomplete="off">
                        <span class="error error-email"></span>
                    </div>

                    <div class="col-md-12 pt-3">
                        <label for="password">Senha:</label>
                        <input type="password" class="form-control" name="password" placeholder="********" autocomplete="off">
                        <span class="error error-password"></span>
                    </div>

                    <div class="col-md-12 mt-2 d-grid gap-2">
                        <span class="error error-msg"></span>
                        <button class="btn btn-success darkmode-ignore" id="button-login">ENTRAR</button>
                    </div>
                </div>
            </form>
            <div class="row mt-3">
                <div class="d-flex justify-content-end col-md-7 mt-1" id="text-account">
                    <!-- <div class=""> -->
                    Não tem uma conta?
                </div>
                <div class="col-md-5">
                    <button class="btn btn-sm btn-primary darkmode-ignore" id="button-register">CADASTRE-SE</button>
                </div>
            </div>
        </div>
        <div id="content-register-user" style="display: none;">
            <form id="user-register" method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <label for="name">Nome: <span class="label-required darkmode-ignore">*</span></label>
                        <input type="text" class="form-control" name="name" autofocus placeholder="João da silva" autocomplete="off">
                        <span class="error error-name"></span>
                    </div>

                    <div class="col-md-12 pt-3">
                        <label for="email">E-mail: <span class="label-required darkmode-ignore">*</span></label>
                        <input type="email" class="form-control" name="email" placeholder="exemplo@email.com" autocomplete="off">
                        <span class="error error-email"></span>
                    </div>

                    <div class="col-md-12 pt-3">
                        <label for="password">Senha: <span class="label-required darkmode-ignore">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="********" autocomplete="off">
                        <span class="error error-password"></span>
                    </div>

                    <div class="col-md-12 pt-3">
                        <label for="passwordConfirm">Confirme sua senha: <span class="label-required darkmode-ignore">*</span></label>
                        <input type="password" class="form-control" name="passwordConfirm" placeholder="********" autocomplete="off">
                        <span class="error error-password-confirm"></span>
                    </div>

                    <div class="col-md-12 pt-3">
                        <label for="vice_id">Selecione seu vício: <span class="label-required darkmode-ignore">*</span></label>
                        <select name="vice_id" id="new_user" class="form-control">
                            <option value="">SELECIONE...</option>
                            <?php foreach ($vices as $vice) { ?>
                                <option value="<?php echo $vice['id']; ?>"><?php echo $vice['name']; ?></option>
                            <?php } ?>
                        </select>
                        <span class="error error-vice"></span>
                    </div>

                    <div class="col-md-12 label-required mt-2 mb-4 darkmode-ignore"> * Campo obrigatório! </div>

                    <div class="col-md-12 mt-2 d-grid gap-2">
                        <span class="error error-msg"></span>
                        <button class="btn btn-success darkmode-ignore" id="btn-register">CADASTRAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="../Framework/JQuery/script.js"></script>
    <script src="../Framework/Bootstrap/script.js"></script>
    <script src="../Framework/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
    <script src="../Framework/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/login/client/login.js"></script>
    <script src="../js/login/client/register.js"></script>
    <script src="../js/login/client/all.js"></script>
</body>

</html>