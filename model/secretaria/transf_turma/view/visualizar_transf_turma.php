<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'transf_tur';
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
                include "../../../../base/conexao.php";
                        
                $id_trans = (int) $_GET['id_trans'];
                $sql  = "select tt.id_trans, a.matricula_alu, a.nome_alu, sobrenome_alu, t.numero as turma_antiga, ";
                $sql .= "(select numero from turma where id_turma = tt.id_turma_nova) as turma_nova, tt.dt_trans ";
                $sql .= "from aluno a, turma t, transferencia_turma tt ";
                $sql .= "where t.id_turma = tt.id_turma_antiga ";
                $sql .= "and a.matricula_alu = tt.matricula_alu and id_trans = $id_trans";
                $query = mysqli_query($conexao, $sql);
                $row   = mysqli_fetch_array($query);
            ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\siaeteot/model/secretaria/transf_turma/lista_transf_turma.php">Transferências de Turma</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo $row["id_trans"]." - ".$row["nome_alu"]." ".$row["sobrenome_alu"]; ?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <strong>ID</strong>
                                                <p class="form-control-plaintext"><?php echo $row["id_trans"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <strong>Matrícula</strong>
                                                <p class="form-control-plaintext"><?php echo $row["matricula_alu"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Nome</strong>
                                                <p class="form-control-plaintext"><?php echo $row["nome_alu"]." ".$row["sobrenome_alu"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <strong>Turma antiga</strong>
                                                <p class="form-control-plaintext"><?php echo $row["turma_antiga"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <strong>Turma nova</strong>
                                                <p class="form-control-plaintext"><?php echo $row["turma_nova"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <strong>Data</strong>
                                                <p class="form-control-plaintext"><?php echo implode("/", array_reverse(explode("-", $row['dt_trans']))); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <!--<a class='btn btn-warning' href='editar_transf_ue.php?id_trans=<?php echo $id_trans ?>'><i class='fa fa-edit'></i>&nbsp; Editar</a>-->   
                                                
                                                <a class='btn btn-danger' onclick='deletaTransfTurma(<?php echo $id_trans ?>)' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                
                                                <a class='btn btn-light' href='../lista_transf_turma.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>
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
    
    <script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="\siaeteot/assets/js/function-delete.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>