<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'ue';
include "../../../../base/head.php";
?>
</head>

<body class="sidebar-fixed header-fixed">
    <?php include "../modal.php" ?>
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">   
            <?php
                include "../../../../base/sidebar/8_sidebar_secretaria.php";
                include("../../../../base/conexao.php");
                        
                $id_ue = (int) $_GET['id_ue'];
                $sql = mysqli_query($conexao, "select * from unidade_estudantil where id_ue = '".$id_ue."';");
                $row = mysqli_fetch_array($sql);
            ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\projeto/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\projeto/model/secretaria/ue/lista_ue.php">Unidades Escolares</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo $row["id_ue"]." - ".$row["nome_ue"]; ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <strong>ID</strong>
                                                    <p class="form-control-plaintext"><?php echo $row["id_ue"]; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <strong>Nome</strong>
                                                    <p class="form-control-plaintext"><?php echo $row["nome_ue"]; ?></p>
                                                </div>
                                            </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Telefone</strong>
                                                <p class="form-control-plaintext"><?php echo $row["tel_ue"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <a class='btn btn-warning' href='editar_ue.php?id_ue=<?php echo $id_ue ?>'><i class='fa fa-edit'></i>&nbsp; Editar</a>   
                                                
                                                <a class='btn btn-danger' onclick='deletaUe(<?php echo $id_ue ?>)' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                
                                                <a class='btn btn-light' href='../lista_ue.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/function-delete.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>