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
                $id_usu = (int) $_GET['id_usu'];
                $sql = mysql_query("select * from usuario where id_usu = '".$id_usu."';");
                $row = mysql_fetch_array($sql);
                    
                //$sexo_alu = $row["sexo_alu"];
                //$tipo_alu = $row["tipo_alu"];
            ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    Editar usuário <?php echo $row["id_usu"]." - ".$row["nome_usu"];?>
                                </div>

                                <div class="card-body">
                                    <form action="../controller/atualiza_usu.php?id_usu=<?php echo $row["id_usu"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_usu" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text" name="id_usu" id="id_usu" value="<?php echo $row["id_usu"];?>" readonly />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_usu" class="form-control-label">Nome do Usuário</label>
                                                    <input class="form-control" type="text" maxlength="30" name="nome_usu" id="nome_usu" value="<?php echo $row["nome_usu"];?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="usuario" class="form-control-label">Usuário</label>
                                                    <input class="form-control" type="text" name="usuario" id="usuario" value="<?php echo $row["usuario"];?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="senha" class="form-control-label">Senha</label>
                                                    <input class="form-control" type="text" name="senha" id="senha" value="<?php echo $row["senha"];?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email" class="form-control-label">E-mail</label>
                                                    <input class="form-control" type="text" name="email" id="email" value="<?php echo $row["email"];?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nivel" class="form-control-label">Nível</label>
                                                    <select class="form-control" name="nivel" id="nivel">
                                                        <option value="1" >Secretaria</option>
                                                        <option value="2" >Administrador</option>
                                                        <option value="3">Docente</option>		
                                                        <option value="4">Aluno</option>		
                                                        <option value="5">Supervisão</option>		
                                                        <option value="6">Coordenação</option>		
                                                        <option value="7">Orientação Educacional</option>		
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="dt_cadastro" class="form-control-label">Data do cadastro</label>
                                                    <input class="form-control" type="text" name="dt_cadastro" id="dt_cadastro" value="<?php echo $row["dt_cadastro"];?>" readonly />
                                                </div>
                                            </div>
                                        </div>
                                        
                                    <!--<div class="row">
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
                                    </div>-->
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                <a href="../lista_usuario.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
