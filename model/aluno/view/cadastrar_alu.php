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
                                    <h4>Cadastrar aluno</h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/insere_alu.php" method="post">
                                        <div class="row">
                                            <div class="col-md-4">
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
                                                <div class="form-group">
                                                    <label for="matricula_alu" class="form-control-label">Matrícula</label>
                                                    <input onkeypress='return SomenteNumero(event)' class="form-control" type="text" maxlength="18" name="matricula_alu" id="matricula_alu" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_alu" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="30" name="nome_alu" id="nome_alu" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="sobrenome_alu" class="form-control-label">Sobrenome</label>
                                                    <input class="form-control" type="text" maxlength="70" name="sobrenome_alu" id="sobrenome_alu" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cpf_alu" class="form-control-label">CPF</label>
                                                    <input class="form-control" type="text" name="cpf_alu" id="cpf_alu" required />
                                                    <!--<h6 id="validacpftxt" class="form-text text-muted"></h6>
                                                    <script type="text/javascript">
                                                        function CPF(){"user_strict";function r(r){for(var t=null,n=0;9>n;++n)t+=r.toString().charAt(n)*(10-n);var i=t%11;return i=2>i?0:11-i}function t(r){for(var t=null,n=0;10>n;++n)t+=r.toString().charAt(n)*(11-n);var i=t%11;return i=2>i?0:11-i}var n="CPF Inválido",i="";this.gera=function(){for(var n="",i=0;9>i;++i)n+=Math.floor(9*Math.random())+"";var o=r(n),a=n+"-"+o+t(n+""+o);return a},this.valida=function(o){for(var a=o.replace(/\D/g,""),u=a.substring(0,9),f=a.substring(9,11),v=0;10>v;v++)if(""+u+f==""+v+v+v+v+v+v+v+v+v+v+v)return n;var c=r(u),e=t(u+""+c);return f.toString()===c.toString()+e.toString()?i:n}}

                                                       var CPF = new CPF();

                                                        $("#cpf_alu").blur(function(){
                                                             $("#validacpftxt").html(CPF.valida($(this).val()));
                                                        });
                                                    </script>-->
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="rg_alu" class="form-control-label">RG</label>
                                                    <input onkeypress='return SomenteNumero(event)' class="form-control" type="text" maxlength="20" name="rg_alu" id="rg_alu" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dt_nasc_alu" class="form-control-label">Data de nascimento</label>
                                                    <input class="form-control" type="date" name="dt_nasc_alu" id="dt_nasc_alu" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_pai" class="form-control-label">Nome do pai</label>
                                                    <input class="form-control" type="text" maxlength="100" name="nome_pai" id="nome_pai" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_mae" class="form-control-label">Nome da mãe</label>
                                                    <input class="form-control" type="text" maxlength="100" name="nome_mae" id="nome_mae" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="sexo_alu">Sexo</label>
                                                    <select id="sexo_alu" name="sexo_alu" class="form-control">
                                                        <option value="M">Masculino</option>
                                                        <option value="F">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tipo_alu">Tipo do aluno</label>
                                                    <select id="tipo_alu" name="tipo_alu" class="form-control">
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
                                                    <input onblur="pesquisacep(this.value);" class="form-control" type="text" name="cep" id="cep" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="num_resid_alu">Número da residência</label>
                                                    <input id="num_resid_alu" name="num_resid_alu" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="complemento_alu">Complemento</label>
                                                    <input id="complemento_alu" name="complemento_alu" class="form-control" />
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
    
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
	<script src="\projeto/assets/js/cep.js"></script>
	<script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
