<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();
$nivel_necessario = 2;

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) {
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ETEOT - Escola Técnica Estadual Oscar Tenório</title>
        <link href="assets/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    </head>
    
    <body class="sidebar-fixed header-fixed">
        <div class="page-wrapper">
            
            <?php include "base/nav.php" ?>

            <div class="main-container">
                
                <?php include "base/sidebar.php" ?>
                
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <script src="assets/js/jquery-3.3.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/chart.min.js"></script>
        <script src="assets/js/carbon.js"></script>
        <script src="assets/js/demo.js"></script>
    </body>
</html>
