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
                        
                $id_disc = (int) $_GET['id_disc'];
                $sql = mysql_query("select * from disciplina where id_disc = '".$id_disc."';");
                $row = mysql_fetch_array($sql);
        
                $id_cur = $row["id_cur"];
                
                /*$sql2 = mysql_query("select * from localidade where cep = '".$row["cep"]."';");
                $row2 = mysql_fetch_array($sql2);
        
                $sexo_alu = $row["sexo_alu"];
                $tipo_alu = $row["tipo_alu"];*/
            ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo $row["id_disc"]." - ".$row["nome_disc"]; ?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_disc" class="form-control-label"><strong>ID</strong></label>
                                                    <p class="form-control-plaintext"><?php echo $row["id_disc"]; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_disc" class="form-control-label"><strong>Nome</strong></label>
                                                    <p class="form-control-plaintext"><?php echo $row["nome_disc"]; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="sigla_disc" class="form-control-label"><strong>Sigla</strong></label>
                                                    <p class="form-control-plaintext"><?php echo $row["sigla_disc"]; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="ch_disc" class="form-control-label"><strong>Carga Horária</strong></label>
                                                    <p class="form-control-plaintext"><?php echo $row["ch_disc"]; ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_cur" class="form-control-label"><strong>Curso</strong></label>
                                                    <p class="form-control-plaintext">
                                                        <?php 
                                                            if ("0" == $id_cur){
                                                                echo "Administração";
                                                            }else if ("1" == $id_cur){
                                                                echo "Formação Geral";
                                                            }else if ("3" == $id_cur){
                                                                echo "Análises Clinicas";
                                                            }else if ("4" == $id_cur){
                                                                echo "Gerência em Saúde";
                                                            }else if ("5" == $id_cur){
                                                                echo "Informática para Internet";
                                                            }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <?php
                                                    echo "<a class='btn btn-warning' href=editar_disc.php?id_disc=".$row['id_disc']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                           <a class='btn btn-danger' href='../controller/exclui_disc.php?id_disc=".$row['id_disc']."'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                           
                                                           <a class='btn btn-light' href='../lista_disciplina.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>";
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