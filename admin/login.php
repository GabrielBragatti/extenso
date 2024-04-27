<?php
session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    header("Location: ./initial.php");
    return;
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <title>SGV - Admin - Login</title>

</head>

<body>
    <div class="content-login border p-5">
        <form id="user-login" class="needs-validation" novalidate method="post">
            <div class="row">
                <div class="col-md-12">
                    <label for="email">E-mail:</label>
                    <input type="email" class="form-control" name="email" autofocus required placeholder="exemplo@email.com" autocomplete="off">
                    <div class="invalid-feedback">
                        Informe seu e-mail!
                    </div>
                </div>

                <div class="col-md-12 pt-2">
                    <label for="password">Senha:</label>
                    <input type="password" class="form-control" name="password" required placeholder="********" autocomplete="off">
                    <div class="invalid-feedback">
                        Informe sua senha!
                    </div>
                </div>

                <div class="col-md-12 mt-2 d-grid gap-2">
                    <span class="error error-msg label-required"></span>
                    <button class="btn btn-success darkmode-ignore" id="button-login">ENTRAR</button>
                </div>
            </div>
        </form>
    </div>

    <script src="../Framework/JQuery/script.js"></script>
    <script src="../Framework/Bootstrap/script.js"></script>
    <script src="../Framework/jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
    <script src="../Framework/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../js/sweetalert2.js"></script>
    <script src="../js/login/admin/login.js"></script>
</body>

</html>