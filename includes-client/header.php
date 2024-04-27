<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Framework/Bootstrap/style.css">
  <link rel="stylesheet" href="../Framework/sweetalert2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
</head>

<body>

  <?php
  session_start();
  if (!isset($_SESSION['user_id']) || !$_SESSION['user_id'] || $_SESSION['user_permission'] != "2") {
    header("Location: ../client/login.php");
    return;
  }

  date_default_timezone_set('America/Sao_Paulo');

  ?>

  <nav class="navbar navbar-expand-lg bg-dark nav-client">
    <div class="container-fluid">
      <ul class="navbar-nav nav-center">
        <li class="nav-item">
          <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'main.php') ? 'bold' : '' ?>" href="./main.php">Contador</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'news.php') ? 'bold' : '' ?>" href="./news.php">Dicas / Notícias</a>
        </li>
        <li class="nav-item">
        <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'account.php') ? 'bold' : '' ?>" href="./account.php">Minha conta</a>
        </li>
      </ul>
      <div class="justify-content-end" style="color: white !important; white-space: nowrap;">
        <?php $complete = $_SESSION['user_name'];
        $parts = explode(" ", $complete);
        $first = trim($parts[0]);

        echo 'Olá ' . $first;
        ?>
      <button type="button" class="ms-2 btn btn-sm btn-danger darkmode-ignore" id="user-client-logout"><i class="me-1 fa-solid fa-arrow-right-from-bracket"></i> SAIR</button>
      </div>
    </div>
  </nav>