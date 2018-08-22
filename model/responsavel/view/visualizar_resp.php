<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
include "../../../base/head.php"
?>
</head>

<body class="sidebar-fixed header-fixed">
    <?php include "../modal.php" ?>
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php
                include "../../../base/sidebar.php";
                include("../../../base/conexao.php");
                        
                $id_resp = (int) $_GET['id_resp'];
                $sql  = "select r.id_resp, r.nome_resp, r.sobrenome_resp, r.cpf_resp, r.rg_resp, ";
                $sql .= "r.cel_resp, r.tel_resp, r.email_resp, r.matricula_alu, ";
                $sql .= "a.matricula_alu, a.nome_alu, a.sobrenome_alu ";
                $sql .= "from responsavel r, aluno a ";
                $sql .= "where r.matricula_alu = a.matricula_alu ";
                $sql .= "and r.id_resp = '".$id_resp."';";
                $query = mysqli_query($conexao, $sql);
                $row = mysqli_fetch_array($query);
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo $row["id_resp"]." - ".$row["nome_resp"]." ".$row["sobrenome_resp"]; ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">   
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="id_resp" class="form-control-label"><strong>ID</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["id_resp"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_resp" class="form-control-label"><strong>Nome</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["nome_resp"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sobrenome_resp" class="form-control-label"><strong>Sobrenome</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["sobrenome_resp"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cpf_resp" class="form-control-label"><strong>CPF</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["cpf_resp"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="rg_resp" class="form-control-label"><strong>RG</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["rg_resp"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="cel_resp" class="form-control-label"><strong>Celular</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["cel_resp"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="tel_resp" class="form-control-label"><strong>Telefone</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["tel_resp"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dt_nasc_resp" class="form-control-label"><strong>E-mail</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row['email_resp'] ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dt_nasc_resp" class="form-control-label"><strong>Aluno referente</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row['matricula_alu']." - ".$row['nome_alu']." ".$row['sobrenome_alu'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group">
                                                <a class='btn btn-warning' href='editar_resp.php?id_resp=<?php echo $id_resp ?>'><i class='fa fa-edit'></i>&nbsp; Editar</a>   
                                                
                                                <a class='btn btn-danger' onclick='deletaResp(<?php echo $id_resp ?>)' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                
                                                <a class='btn btn-light' href='../lista_responsavel.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>
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
    </div>
    
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/function-delete.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>