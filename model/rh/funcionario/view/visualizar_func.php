<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 3)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'func';
include "../../../../base/head.php";
?>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php
                include "../../../../base/sidebar/3_sidebar_rh.php";
                include("../../../../base/conexao.php");
                        
                $id_func = (int) $_GET['id_func'];
                $sql = mysqli_query($conexao, "select * from funcionario where id_func = '".$id_func."';");
                $row = mysqli_fetch_array($sql);
                    
                $sql1 = mysqli_query($conexao, "select * from setor where id_setor = '".$row['id_setor']."';");
                $row1 = mysqli_fetch_array($sql1);
                
                $sql2 = mysqli_query($conexao, "select * from localidade where cep = '".$row["cep"]."';");
                $row2 = mysqli_fetch_array($sql2);
            ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\siaeteot/model/rh/funcionario/lista_funcionario.php">Funcionários</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo $row["id_func"]." - ".$row["nome_func"]." ".$row["sobrenome_func"]; ?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="id_func" class="form-control-label"><strong>ID</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["id_func"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_func" class="form-control-label"><strong>Nome</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["nome_func"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sobrenome_func" class="form-control-label"><strong>Sobrenome</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["sobrenome_func"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sobrenome_func" class="form-control-label"><strong>Setor</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row1["nome_setor"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cpf_func" class="form-control-label"><strong>CPF</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["cpf_func"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rg_func" class="form-control-label"><strong>RG</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["rg_func"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dt_nasc_func" class="form-control-label"><strong>Data de nascimento</strong></label>
                                                <p class="form-control-plaintext"><?php echo implode("/", array_reverse(explode("-", $row['dt_nasc_func']))) ?></p>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cep" class="form-control-label"><strong>CEP</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["cep"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="num_resid_func"><strong>Número da residência</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["num_resid_func"]; ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="complemento_func"><strong>Complemento</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["complemento_func"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="logradouro" class="form-control-label"><strong>Logradouro</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row2["tp_logradouro"]." ".$row2["logradouro"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="bairro"><strong>Bairro</strong></label>
                                                <p class="form-control-plaintext">
                                                    <?php 
                                                        //echo mb_strtoupper($row2["bairro"], mb_internal_encoding()); header("Content-Type: text/html; charset=utf-8",true); 
                                                        echo $row2["bairro"];
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cidade"><strong>Cidade</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row2["cidade"] ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="uf"><strong>UF</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row2["uf"] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <?php
                                                    echo "<a class='btn btn-warning' href=editar_func.php?id_func=".$row['id_func']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                           <a class='btn btn-danger' href='../controller/exclui_func.php?id_func=".$row['id_func']."'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                           
                                                           <a class='btn btn-light' href='../lista_funcionario.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>";
                                                ?>
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
    <script src="\siaeteot/assets/js/popper.min.js"></script>
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="\siaeteot/assets/js/chart.min.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
    <script src="\siaeteot/assets/js/demo.js"></script>

</body>

</html>