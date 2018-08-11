<?php

if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
include "../../../base/head.php"
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
</head>
<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            
            <?php
                include "../../../base/sidebar.php";
                include("../../../base/conexao.php");
                $id_disc = (int) $_GET['id_disc'];
                $sql = mysql_query("select * from disciplina where id_disc = '".$id_disc."';");
                $row = mysql_fetch_array($sql);
                                
                $id_cur = $row["id_cur"];
            ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    Editar disciplina <?php echo $row["id_disc"]." - ".$row["nome_disc"];?>
                                </div>

                                <div class="card-body">
                                    <form action="../controller/atualiza_disc.php?id_disc=<?php echo $row["id_disc"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_disc" class="form-control-label">Matrícula</label>
                                                    <input class="form-control" type="text"name="id_disc" id="id_disc" value="<?php echo $row["id_disc"];?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_disc" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="100" name="nome_disc" id="nome_disc" value="<?php echo $row["nome_disc"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="sigla_disc" class="form-control-label">Sigla</label>
                                                    <input class="form-control" type="text" maxlength="10" name="sigla_disc" id="sigla_disc" value="<?php echo $row["sigla_disc"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="ch_disc" class="form-control-label">Carga Horária</label>
                                                    <input class="form-control" type="text" name="ch_disc" id="ch_disc" value="<?php echo $row["ch_disc"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_cur">Curso</label>
                                                    <select id="id_cur" name="id_cur" class="form-control">
                                                        <?php 
                                                            if ("0" == $id_cur){
                                                                echo "<option value='0'>Administração</option>
                                                                      <option value='1'>Formação Geral</option>
                                                                      <option value='3'>Análises Clinicas</option>
                                                                      <option value='4'>Gerência em Saúde</option>
                                                                      <option value='5'>Informática para Internet</option>";
                                                            }else if ("1" == $id_cur){
                                                                echo "<option value='1'>Formação Geral</option>
                                                                      <option value='0'>Administração</option>
                                                                      <option value='3'>Análises Clinicas</option>
                                                                      <option value='4'>Gerência em Saúde</option>
                                                                      <option value='5'>Informática para Internet</option>";
                                                            }else if ("3" == $id_cur){
                                                                echo "<option value='3'>Análises Clinicas</option>
                                                                      <option value='0'>Administração</option>
                                                                      <option value='1'>Formação Geral</option>
                                                                      <option value='4'>Gerência em Saúde</option>
                                                                      <option value='5'>Informática para Internet</option>";
                                                            }else if ("4" == $id_cur){
                                                                echo "<option value='4'>Gerência em Saúde</option>
                                                                      <option value='0'>Administração</option>
                                                                      <option value='1'>Formação Geral</option>
                                                                      <option value='3'>Análises Clinicas</option>
                                                                      <option value='5'>Informática para Internet</option>";
                                                            }else if ("5" == $id_cur){
                                                                echo "<option value='5'>Informática para Internet</option>
                                                                      <option value='0'>Administração</option>
                                                                      <option value='1'>Formação Geral</option>
                                                                      <option value='3'>Análises Clinicas</option>
                                                                      <option value='4'>Gerência em Saúde</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!--<div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tipo_alu">Tipo do aluno</label>
                                                    <select id="tipo_alu" name="tipo_alu" class="form-control">
                                                        <?php 
                                                            /*if ("I" == $tipo_alu){
                                                                echo "<option value='I'>Ensino Integrado</option>
                                                                      <option value='S'>Ensino Subsequente</option>";
                                                            }else if ("S" == $tipo_alu){
                                                                echo "<option value='S'>Ensino Subsequente</option>
                                                                      <option value='I'>Ensino Integrado</option>";
                                                            }*/
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
                                                    <a href="../lista_disciplina.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src="\projeto/assets/js/demo.js"></script>

</body>

</html>
