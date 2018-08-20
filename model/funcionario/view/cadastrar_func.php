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
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
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
                                    <h4>Adicionar Funcionário</h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/insere_func.php" method="post">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="id_func" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text" name="id_func" id="id_func" disabled/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_func" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="30" name="nome_func" id="nome_func" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="sobrenome_func" class="form-control-label">Sobrenome</label>
                                                    <input class="form-control" type="text" maxlength="70" name="sobrenome_func" id="sobrenome_func" />
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
                                                    <script>
                                                        function SomenteNumero(e){
                                                            var tecla=(window.event)?event.keyCode:e.which;   
                                                            if((tecla>47 && tecla<58)) return true;
                                                            else{
                                                                if (tecla==8 || tecla==0) return true;
                                                            else  return false;
                                                            }
                                                        }
                                                    </script>
                                                    <label for="rg_func" class="form-control-label">RG</label>
                                                    <input onkeypress='return SomenteNumero(event)' class="form-control" type="text" maxlength="20" name="rg_func" id="rg_func" />
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
                                                <div class="form-group">
                                                    <label for="id_setor">Setor</label>
                                                    <select id="id_setor" name="id_setor" class="form-control">
                                                        <option value="0">Selecione...</option>
                                                        <?php
                                                            include("../../../base/conexao.php");
                                                            $data_setor = mysql_query("select * from setor order by nome_setor asc") or die(mysql_error());
                                                            while($info_setor = mysql_fetch_array($data_setor)){
                                                                echo "<option value='".$info_setor['id_setor']."'>".$info_setor['nome_setor']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="id_cargo">Cargo</label>
                                                    <select id="id_cargo" name="id_cargo" class="form-control">
                                                        <option value="0">Selecione...</option>
                                                        <?php
                                                            $data_cargo = mysql_query("select * from cargo order by nome_cargo asc") or die(mysql_error());
                                                            while($info_cargo = mysql_fetch_array($data_cargo)){
                                                                echo "<option value='".$info_cargo['id_cargo']."'>".$info_cargo['nome_cargo']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="id_funcao">Função</label>
                                                    <select id="id_funcao" name="id_funcao" class="form-control">
                                                        <option value="0">Selecione...</option>
                                                        <?php
                                                            $data_funcao = mysql_query("select * from funcao order by nome_funcao asc") or die(mysql_error());
                                                            while($info_funcao = mysql_fetch_array($data_funcao)){
                                                                echo "<option value='".$info_funcao['id_funcao']."'>".$info_funcao['nome_funcao']."</option>";
                                                            }
                                                        ?>
                                                    </select>
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
	
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/cep.js"></script>
	<script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
