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

            <?php include "../../../base/sidebar.php" ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Adicionar Funcionário</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form action="../controller/insere_func.php" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="id_func" class="form-control-label">ID</label>
                                                <input class="form-control" type="text" name="id_func" id="id_func" disabled/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_func" class="form-control-label">Nome</label>
                                                <input class="form-control" type="text" maxlength="30" name="nome_func" id="nome_func" />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sobrenome_func" class="form-control-label">Sobrenome</label>
                                                <input class="form-control" type="text" maxlength="70" name="sobrenome_func" id="sobrenome_func" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="id_setor">Setor</label>
                                                <select id="id_setor" name="id_setor" class="form-control">
                                                    <?php
                                                        include("../../../base/conexao.php");
                                                        $data = mysql_query("select * from setor") or die(mysql_error());
                                                        while($info = mysql_fetch_array($data)){
                                                            echo "<option value='".$info['id_setor']."'>".$info['nome_setor']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cpf_func" class="form-control-label">CPF</label>
                                                <input class="form-control" type="text" name="cpf_func" id="cpf_func" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="rg_func" class="form-control-label">RG</label>
                                                <input class="form-control" type="text" maxlength="20" name="rg_func" id="rg_func" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dt_nasc_func" class="form-control-label">Data de nascimento</label>
                                                <input class="form-control" type="date" name="dt_nasc_func" id="dt_nasc_func" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cep" class="form-control-label">CEP</label>
                                                <input onblur="pesquisacep(this.value);" class="form-control" type="text" name="cep" id="cep" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="num_resid_func">Número da residência</label>
                                                <input id="num_resid_func" name="num_resid_func" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="complemento_func">Complemento</label>
                                                <input id="complemento_func" name="complemento_func" class="form-control" />
                                                <small id="passwordHelpBlock" class="form-text text-muted">
                                                    Se não houver, deixar em branco.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="logradouro" class="form-control-label">Logradouro</label>
                                                <input class="form-control" type="text" name="logradouro" id="logradouro" disabled />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="bairro">Bairro</label>
                                                <input id="bairro" name="bairro" class="form-control" disabled />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cidade">Cidade</label>
                                                <input id="cidade" name="cidade" class="form-control" disabled />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="uf">UF</label>
                                                <input id="uf" name="uf" class="form-control" disabled />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                <a href="../lista_funcionario.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
	<script src="\projeto/assets/js/cep.js"></script>
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\projeto/assets/js/popper.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
	<script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/chart.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src="\projeto/assets/js/demo.js"></script>

</body>

</html>
