<?php

if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { // Verifica se não há a variável da sessão que identifica o usuário
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
                $matricula_alu = (int) $_GET['matricula_alu'];
                $sql = mysql_query("select * from aluno where matricula_alu = '".$matricula_alu."';");
                $row = mysql_fetch_array($sql);
                
                $sql2 = mysql_query("select * from localidade where cep = '".$row["cep"]."';");
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
                                    Editar aluno <?php echo $row["matricula_alu"]." - ".$row["nome_alu"];?>
                                </div>

                                <div class="card-body">
                                    <form action="../controller/atualiza_alu.php?matricula_alu=<?php echo $row["matricula_alu"]; ?>" method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="matricula_alu" class="form-control-label">Matrícula</label>
                                                <input class="form-control" type="text" size="15" maxlength="256" name="matricula_alu" id="matricula_alu" value="<?php echo $row["matricula_alu"];?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nome_alu" class="form-control-label">Nome</label>
                                                <input class="form-control" type="text" maxlength="30" name="nome_alu" id="nome_alu" value="<?php echo $row["nome_alu"];?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sobrenome_alu" class="form-control-label">Sobrenome</label>
                                                <input class="form-control" type="text" maxlength="70" name="sobrenome_alu" id="sobrenome_alu" value="<?php echo $row["sobrenome_alu"];?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cpf_alu" class="form-control-label">CPF</label>
                                                <input class="form-control" type="text" name="cpf_alu" id="cpf_alu" value="<?php echo $row["cpf_alu"];?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rg_alu" class="form-control-label">RG</label>
                                                <input class="form-control" type="text" maxlength="20" name="rg_alu" id="rg_alu" value="<?php echo $row["rg_alu"];?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dt_nasc_alu" class="form-control-label">Data de nascimento</label>
                                                <input class="form-control" type="text" name="dt_nasc_alu" id="dt_nasc_alu" value="<?php echo date('d/m/Y', strtotime($row['dt_nasc_alu'])); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_pai" class="form-control-label">Nome do pai</label>
                                                <input class="form-control" type="text" maxlength="100" name="nome_pai" id="nome_pai" value="<?php echo $row["nome_pai"];?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_mae" class="form-control-label">Nome da mãe</label>
                                                <input class="form-control" type="text" maxlength="100" name="nome_mae" id="nome_mae" value="<?php echo $row["nome_mae"];?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sexo_alu">Sexo</label>
                                                <select id="sexo_alu" name="sexo_alu" class="form-control">
                                                    <?php 
                                                        if ("M" == $sexo_alu ){
                                                            echo "<option value='M'>Masculino</option>
                                                                  <option value='F'>Feminino</option>";
                                                        }else if ("F" == $sexo_alu){
                                                            echo "<option value='F'>Feminino</option>
                                                                  <option value='M'>Masculino</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tipo_alu">Tipo do aluno</label>
                                                <select id="tipo_alu" name="tipo_alu" class="form-control">
                                                    <?php 
                                                        if ("I" == $tipo_alu){
                                                            echo "<option value='I'>Ensino Integrado</option>
                                                                  <option value='S'>Ensino Subsequente</option>";
                                                        }else if ("S" == $tipo_alu){
                                                            echo "<option value='S'>Ensino Subsequente</option>
                                                                  <option value='I'>Ensino Integrado</option>";
                                                        }
                                                    ?>
                                                    <option value="I">Ensino Integrado</option>
                                                    <option value="S">Ensino Subsequente</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cep" class="form-control-label">CEP</label>
                                                <input class="form-control" type="text" name="cep" id="cep" value="<?php echo $row["cep"];?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="num_resid_alu">Número da residência</label>
                                                <input id="num_resid_alu" name="num_resid_alu" class="form-control" value="<?php echo $row["num_resid_alu"];?>" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="complemento_alu">Complemento</label>
                                                <input id="complemento_alu" name="complemento_alu" class="form-control" value="<?php echo $row["complemento_alu"];?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="logradouro" class="form-control-label">Logradouro</label>
                                                <input class="form-control" type="text" name="logradouro" id="logradouro" value="<?php echo $row2["tp_logradouro"]." ".$row2["logradouro"];?>" disabled />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="bairro">Bairro</label>
                                                <input id="bairro" name="bairro" class="form-control" value="<?php echo $row2["bairro"]?>" disabled />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cidade">Cidade</label>
                                                <input id="cidade" name="cidade" class="form-control" value="<?php echo $row2["cidade"]?>" disabled />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="uf">UF</label>
                                                <input id="uf" name="uf" class="form-control" value="<?php echo $row2["uf"]?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                <a href="../lista_aluno.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
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
    <script src="\projeto/assets/js/cep.js"></script>
	<script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/chart.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src=".v/assets/js/demo.js"></script>

</body>

</html>
