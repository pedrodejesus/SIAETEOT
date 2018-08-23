<?php
header("Content-Type: text/html; charset=utf-8",true); // Acentuação
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

$id_func = $_SESSION['FuncID'];

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { //Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança 
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
include "../../base/head.php";
?>
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
<script src="\projeto/assets/js/jquery-migrate-1.4.1"></script>
<script type="text/javascript" src="search.js"></script>
</head>
<body class="sidebar-fixed header-fixed">
    <?php //include "modal.php" ?>
    <div class="page-wrapper">
    <?php include "../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                include "../../base/conexao.php";
                include "../../base/sidebar.php";
    
                $sql  = "select m.id_func, m.id_disc, ";
                $sql .= "f.id_func, f.nome_func, f.sobrenome_func, ";
                $sql .= "d.id_disc, d.nome_disc ";
                $sql .= "from ministra m, funcionario f, disciplina d ";
                $sql .= "where m.id_disc = d.id_disc ";
                $sql .= "and m.id_func = f.id_func ";
                $sql .= "and f.id_func = '".$id_func."';";
    
                $query = mysqli_query($conexao, $sql);
                $row = mysqli_fetch_array($query);
            ?>
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <?php echo  $row['nome_func']." ".$row['sobrenome_func']; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab" aria-controls="home">Frequência</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">Conteúdo</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages" role="tab" aria-controls="messages">Avaliações</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                1. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>

                            <div class="tab-pane" id="profile" role="tabpanel">
                                2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>

                            <div class="tab-pane" id="messages" role="tabpanel">
                                3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </div>    
    
    
    <!--<script src="\projeto/assets/js/jquery.tablesorter.min.js"></script>
	<script src="\projeto/assets/js/script_tablesorter.js"></script>-->
    <script src="\projeto/assets/js/popper.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/function-delete.js"></script>
    <script src="\projeto/assets/js/function-search.js"></script>
    <script src="\projeto/assets/js/chart.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src="\projeto/assets/js/demo.js"></script>
</body>

</html>
