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

            <?php include "../../../base/sidebar.php" ?>
            
            <?php
                include("../../../base/conexao.php");
        
                $id_usu = (int) $_GET['id_usu'];
                $sql = mysql_query("select * from usuario where id_usu = '".$id_usu."';");
                $row = mysql_fetch_array($sql);
        
                /*$sexo_usu = $row["sexo_usu"];
                $tipo_usu = $row["tipo_usu"];*/
            ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo $row["id_usu"]." - ".$row["nome_usu"]; ?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="id_usu" class="form-control-label"><strong>ID</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["id_usu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nome_usu" class="form-control-label"><strong>Nome do Usuário</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["nome_usu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="usuario" class="form-control-label"><strong>Usuário</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["usuario"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="senha" class="form-control-label"><strong>Senha</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["senha"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_pai" class="form-control-label"><strong>E-mail</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["email"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_mae" class="form-control-label"><strong>Nível</strong></label>
                                                <p class="form-control-plaintext"><?php 
                                                    switch($row["nivel"]){
                                                        case 1:
                                                            echo "Secretaria";
                                                            break;
                                                        case 2:
                                                            echo "Administrador";
                                                            break;
                                                        case 3:
                                                            echo "Docente";
                                                            break;
                                                        case 4:
                                                            echo "Aluno";
                                                            break;
                                                        case 5:
                                                            echo "Supervisão";
                                                            break;
                                                        case 6:
                                                            echo "Coordenação";
                                                            break;
                                                        case 2:
                                                            echo "Orientação Educacional";
                                                            break;
                                                    }                                                    
                                                ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sexo_usu"><strong>Ativo</strong></label>
                                                <p class="form-control-plaintext"><?php if ("1" == $row["ativo"]){echo"Sim";}else if ("0" == $row["ativo"]){echo"Não";} ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tipo_usu"><strong>Data de cadastro</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["dt_cadastro"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <?php
                                                    echo "<a class='btn btn-warning' href=editar_usu.php?id_usu=".$row['id_usu']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                           <a class='btn btn-danger' href='../controller/exclui_usu.php?id_usu=".$row['id_usu']."'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                           
                                                           <a class='btn btn-light' href='../lista_usuario.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>"                                                
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