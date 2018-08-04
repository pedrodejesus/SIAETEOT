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
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ETEOT - Escola Técnica Estadual Oscar Tenório</title>

    <link href="\projeto/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php
                include "../../../base/sidebar.php";
                include("../../../base/conexao.php");
                        
                $id_resp = (int) $_GET['id_resp'];
                $sql = mysql_query("select * from responsavel where id_resp = '".$id_resp."';");
                $row = mysql_fetch_array($sql);
                    
                $sql1 = mysql_query("select * from aluno where matricula_alu = '".$row['matricula_alu']."';");
                $row1 = mysql_fetch_array($sql1);
        
                header("Content-Type: text/html; charset=utf-8",true); // Acentuação
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
                                                <p class="form-control-plaintext"><?php echo $row1['matricula_alu']." - ".$row1['nome_alu']." ".$row1['sobrenome_alu'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <?php
                                                    echo "<a class='btn btn-warning' href=editar_resp.php?id_resp=".$row['id_resp']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                           <a class='btn btn-danger' href='../controller/exclui_resp.php?id_resp=".$row['id_resp']."'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                           
                                                           <a class='btn btn-light' href='../lista_responsavel.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>";
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
    </div>
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\projeto/assets/js/popper.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/chart.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src="\projeto/assets/js/demo.js"></script>

</body>

</html>