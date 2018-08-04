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
                        
                $id_cargo = (int) $_GET['id_cargo'];
                $sql = mysql_query("select * from cargo where id_cargo = '".$id_cargo."';");
                $row = mysql_fetch_array($sql);
            ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo $row["id_cargo"]." - ".$row["nome_cargo"]; ?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_cargo" class="form-control-label"><strong>ID</strong></label>
                                                    <p class="form-control-plaintext"><?php echo $row["id_cargo"]; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_cargo" class="form-control-label"><strong>Nome</strong></label>
                                                    <p class="form-control-plaintext"><?php echo $row["nome_cargo"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <?php
                                                    echo "<a class='btn btn-warning' href=editar_cargo.php?id_cargo=".$row['id_cargo']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                           <a class='btn btn-danger' href='../controller/exclui_cargo.php?id_cargo=".$row['id_cargo']."'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                           
                                                           <a class='btn btn-light' href='../lista_cargo.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>";
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