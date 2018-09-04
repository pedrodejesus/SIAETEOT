<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();
$nivel_necessario = 2;

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) {
	session_destroy(); // Destrói a sessão por segurança
	header("Location: login.php"); exit; // Redireciona o visitante de volta pro login
}
include "base/head.php";
?>
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
