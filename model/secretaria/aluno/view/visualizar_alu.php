<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'aluno';
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
                        
                $matricula_alu = $_GET['matricula_alu'];
                $sql = "call select_dados_alu($matricula_alu)";
                $query = mysqli_query($conexao, $sql);
                $row   = mysqli_fetch_array($query);
            ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\siaeteot/model/secretaria/aluno/lista_aluno.php">Alunos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#pess" role="tab" aria-controls="home" aria-expanded="true"><i class="fal fa-user-graduate"></i> Dados pessoais</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#docs" role="tab" aria-controls="profile" aria-expanded="false"><i class="fal fa-id-card"></i> Documentos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#comp" role="tab" aria-controls="test" aria-expanded="false"><i class="fal fa-info-circle"></i> Dados complementares</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="pess" role="tabpanel" aria-expanded="true">
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

                                                        <a class='btn btn-light' onclick="window.history.back();" ><i class='fa fa-undo'></i>&nbsp; Voltar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="docs" role="tabpanel" aria-expanded="false">
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
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <strong>Tipo de certidão</strong>
                                                        <p class="form-control-plaintext">
                                                            <?php 
                                                                switch($row['certidao_tipo']){
                                                                    case 1:
                                                                        echo "Certdão de Nascimento";
                                                                        break;
                                                                    case 2:
                                                                        echo "Certdão de Casamento";
                                                                        break;
                                                                }
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <strong>Termo</strong>
                                                        <p class="form-control-plaintext"><?php echo $row["certidao_termo"]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <strong>Circunscrição</strong>
                                                        <p class="form-control-plaintext"><?php echo $row["certidao_circ"]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <strong>Livro</strong>
                                                        <p class="form-control-plaintext"><?php echo $row["certidao_livro"]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <strong>Folha</strong>
                                                        <p class="form-control-plaintext"><?php echo $row["certidao_folha"]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <strong>Cidade</strong>
                                                        <p class="form-control-plaintext"><?php echo $row["certidao_cidade"]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <strong>UF</strong>
                                                        <p class="form-control-plaintext"><?php echo $row["certidao_uf"]; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <strong>RG Identidade</strong>
                                                        <p class="form-control-plaintext"><?php echo $row["identidade_rg"]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <strong>Data Expedição Identidade</strong>
                                                        <p class="form-control-plaintext"><?php echo implode("/", array_reverse(explode("-", $row["identidade_dt_exp"]))) ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <strong>Orgão Emissor Identidade</strong>
                                                        <p class="form-control-plaintext"><?php echo $row["identidade_org_exp"]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <strong>Naturalidade</strong>
                                                        <p class="form-control-plaintext"><?php echo $row["naturalidade"]; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="btn-group" role="group"> 
                                                        <a class='btn btn-warning' href='editar_alu.php?matricula_alu=<?php echo $matricula_alu ?>'><i class='fa fa-edit'></i>&nbsp; Editar</a>   

                                                        <a class='btn btn-danger' onclick='deletaAlu(<?php echo $matricula_alu ?>)' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>

                                                        <a class='btn btn-light' onclick="window.history.back();" ><i class='fa fa-undo'></i>&nbsp; Voltar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="comp" role="tabpanel" aria-expanded="false">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4><?php echo $row["matricula_alu"]." - ".$row["nome_alu"]." ".$row["sobrenome_alu"]; ?></h4>

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
    
    <script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="\siaeteot/assets/js/function-delete.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>