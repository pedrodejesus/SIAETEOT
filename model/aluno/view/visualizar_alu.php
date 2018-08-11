<?php
header('content-type text/html charset=iso-8859-1');
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
    <meta charset="iso-8859-1">
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
        
                $matricula_alu = (int) $_GET['matricula_alu'];
                $sql = mysql_query("select * from aluno where matricula_alu = '".$matricula_alu."';");
                $row = mysql_fetch_array($sql);
                
                $sql2 = mysql_query("select upper(tp_logradouro) as tp_logradouro, upper(logradouro) as logradouro, upper(bairro) as bairro, upper(cidade) as cidade, uf from localidade where cep = '".$row["cep"]."';");
                $row2 = mysql_fetch_array($sql2);
        
                $sexo_alu = $row["sexo_alu"];
                $tipo_alu = $row["tipo_alu"];
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
                                                <label for="matricula_alu" class="form-control-label"><strong>Matrícula</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["matricula_alu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nome_alu" class="form-control-label"><strong>Nome</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["nome_alu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sobrenome_alu" class="form-control-label"><strong>Sobrenome</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["sobrenome_alu"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cpf_alu" class="form-control-label"><strong>CPF</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["cpf_alu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rg_alu" class="form-control-label"><strong>RG</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["rg_alu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dt_nasc_alu" class="form-control-label"><strong>Data de nascimento</strong></label>
                                                <p class="form-control-plaintext"><?php echo implode("/", array_reverse(explode("-", $row['dt_nasc_alu']))) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_pai" class="form-control-label"><strong>Nome do pai</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["nome_pai"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_mae" class="form-control-label"><strong>Nome da mãe</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["nome_mae"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sexo_alu"><strong>Sexo</strong></label>
                                                <p class="form-control-plaintext"><?php if ("M" == $row["sexo_alu"]){echo"Masculino";}else if ("F" == $row["sexo_alu"]){echo"Feminino";} ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tipo_alu"><strong>Tipo do aluno</strong></label>
                                                <p class="form-control-plaintext"><?php if ("I" == $row["tipo_alu"]){echo"Ensino Integrado";}else if ("S" == $row["tipo_alu"]){echo"Ensino Subsequente";} ?></p>
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
                                                <label for="num_resid_alu"><strong>Número da residência</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["num_resid_alu"]; ?></p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="complemento_alu"><strong>Complemento</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["complemento_alu"]; ?></p>
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
                                                <p class="form-control-plaintext"><?php echo $row2["bairro"]; ?></p>
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
                                                    echo "<a class='btn btn-warning' href=editar_alu.php?matricula_alu=".$row['matricula_alu']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                           <a class='btn btn-danger' href='../controller/exclui_alu.php?matricula_alu=".$row['matricula_alu']."'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                           
                                                           <a class='btn btn-light' href='../lista_aluno.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>";
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