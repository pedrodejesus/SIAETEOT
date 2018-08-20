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
                include "../../../base/conexao.php";
                        
                $matricula_alu = (int) $_GET['matricula_alu'];
                $sql   = "select a.matricula_alu, a.nome_alu, a.sobrenome_alu, a.cpf_alu, a.rg_alu, a.dt_nasc_alu, ";
                $sql  .= "a.nome_pai, a.nome_mae, a.sexo_alu, a.tipo_alu, a.cep, a.num_resid_alu, a.complemento_alu, ";
                $sql  .= "l.cep, upper(l.tp_logradouro) as tp_logradouro, upper(l.logradouro) as logradouro, upper(l.bairro) as bairro, upper(l.cidade) as cidade, upper(l.uf) as uf ";
                $sql  .= "from aluno a, localidade l ";
                $sql  .= "where a.cep = l.cep ";
                $sql  .= "and a.matricula_alu = '".$matricula_alu."';";
                $query = mysqli_query($conexao, $sql);
                $row   = mysqli_fetch_array($query);
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo $row["matricula_alu"]." - ".$row["nome_alu"]." ".$row["sobrenome_alu"]; ?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Matrícula</strong>
                                                <p class="form-control-plaintext"><?php echo $row["matricula_alu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Nome</strong>
                                                <p class="form-control-plaintext"><?php echo $row["nome_alu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Sobrenome</strong>
                                                <p class="form-control-plaintext"><?php echo $row["sobrenome_alu"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>CPF</strong>
                                                <p class="form-control-plaintext"><?php echo $row["cpf_alu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>RG</strong>
                                                <p class="form-control-plaintext"><?php echo $row["rg_alu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Data de nascimento</strong>
                                                <p class="form-control-plaintext"><?php echo implode("/", array_reverse(explode("-", $row['dt_nasc_alu']))) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Nome do pai</strong>
                                                <p class="form-control-plaintext"><?php echo $row["nome_pai"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Nome da mãe</strong>
                                                <p class="form-control-plaintext"><?php echo $row["nome_mae"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Sexo</strong>
                                                <p class="form-control-plaintext"><?php if ("M" == $row["sexo_alu"]){echo"Masculino";}else if ("F" == $row["sexo_alu"]){echo"Feminino";} ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Tipo do aluno</strong>
                                                <p class="form-control-plaintext"><?php if ("I" == $row["tipo_alu"]){echo"Ensino Integrado";}else if ("S" == $row["tipo_alu"]){echo"Ensino Subsequente";} ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>CEP</strong>
                                                <p class="form-control-plaintext"><?php echo $row["cep"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Número da residência</strong>
                                                <p class="form-control-plaintext"><?php echo $row["num_resid_alu"]; ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <strong>Complemento</strong>
                                                <p class="form-control-plaintext"><?php echo $row["complemento_alu"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Logradouro</strong>
                                                <p class="form-control-plaintext"><?php echo $row["tp_logradouro"]." ".$row["logradouro"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Bairro</strong>
                                                <p class="form-control-plaintext"><?php echo $row["bairro"]; ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Cidade</strong>
                                                <p class="form-control-plaintext"><?php echo $row["cidade"] ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>UF</strong>
                                                <p class="form-control-plaintext"><?php echo $row["uf"] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <a class='btn btn-warning' href='editar_alu.php?matricula_alu=<?php echo $matricula_alu ?>'><i class='fa fa-edit'></i>&nbsp; Editar</a>   
                                                
                                                <a class='btn btn-danger' onclick='deletaAlu(<?php echo $matricula_alu ?>)' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                
                                                <a class='btn btn-light' href='../lista_aluno.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>
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