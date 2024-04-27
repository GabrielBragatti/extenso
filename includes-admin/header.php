<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Framework/Bootstrap/style.css">
  <link rel="stylesheet" href="../Framework/sweetalert2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/all.js"></script>
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
  if (!isset($_SESSION['user_id']) || !$_SESSION['user_id'] || $_SESSION['user_permission'] != "1") {
    header("Location: ../index.php");
    return;
  }

  date_default_timezone_set('America/Sao_Paulo');

  ?>

  <nav class="navbar bg-dark navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./initial.php">Vícios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./news.php">Notícias / Dicas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./users.php">Usuários</a>
          </li>
        </ul>
      </div>
      <form class="d-flex align-items-center">
        <button type="button" class="ms-2 btn btn-danger darkmode-ignore" id="user-logout"><i class="me-1 fa-solid fa-arrow-right-from-bracket"></i>SAIR</button>
      </form>
    </div>
  </nav>