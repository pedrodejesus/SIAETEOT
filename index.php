<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();
//$nivel_necessario = 2;

// Verifica se não há a variável da sessão que identifica o usuário
/*if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) {
	session_destroy(); // Destrói a sessão por segurança
	header("Location: login.php"); exit; // Redireciona o visitante de volta pro login
}*/
$page = 'dashboard';
include "base/head.php";
?>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "base/nav.php" ?>
        <div class="main-container">
                <?php 
                    switch($_SESSION['UsuarioNivel']){
                        case 1: 
                            include "base/sidebar/1_sidebar_aluno.php";
                            break;
                        case 2: 
                            include "base/sidebar/2_sidebar_oe.php";
                            break;
                        case 3: 
                            include "base/sidebar/3_sidebar_rh.php";
                            break;
                        case 4: 
                            include "base/sidebar/4_sidebar_inspetoria.php";
                            break;
                        case 5: 
                            include "base/sidebar/5_sidebar_sup.php";
                            break;
                        case 6: 
                            include "base/sidebar/6_sidebar_coord.php";
                            break;
                        case 7: 
                            include "base/sidebar/7_sidebar_prof.php";
                            break;
                        case 8: 
                            include "base/sidebar/8_sidebar_secretaria.php";
                            break;
                        case 9: 
                            include "base/sidebar/9_sidebar_dir.php";
                            break;
                        case 0:
                            include "base/sidebar/0_sidebar_admin.php";
                            break;
                    }
                ?>
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
    <script src="assets/js/carbon.js"></script>
</body>

</html>
