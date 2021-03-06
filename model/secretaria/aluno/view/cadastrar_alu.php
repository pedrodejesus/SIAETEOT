<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'aluno';
include "../../../../base/head.php";
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php include "../../../../base/sidebar/8_sidebar_secretaria.php" ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\siaeteot/model/secretaria/aluno/lista_aluno.php">Alunos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Cadastrar aluno</h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/insere_alu.php" method="post">
                                        <div class="row">
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nome_alu" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="30" name="nome_alu" id="nome_alu" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
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
                                                    <h6 id="validacpftxt" class="form-text text-danger"></h6>
                                                    <script type="text/javascript">
                                                        function CPF() {
                                                            "user_strict";

                                                            function r(r) {
                                                                for (var t = null, n = 0; 9 > n; ++n) t += r.toString().charAt(n) * (10 - n);
                                                                var i = t % 11;
                                                                return i = 2 > i ? 0 : 11 - i
                                                            }

                                                            function t(r) {
                                                                for (var t = null, n = 0; 10 > n; ++n) t += r.toString().charAt(n) * (11 - n);
                                                                var i = t % 11;
                                                                return i = 2 > i ? 0 : 11 - i
                                                            }
                                                            var n = "<b>CPF Inválido</b>",
                                                                i = '';
                                                            this.gera = function() {
                                                                for (var n = "", i = 0; 9 > i; ++i) n += Math.floor(9 * Math.random()) + "";
                                                                var o = r(n),
                                                                    a = n + "-" + o + t(n + "" + o);
                                                                return a
                                                            }, this.valida = function(o) {
                                                                for (var a = o.replace(/\D/g, ""), u = a.substring(0, 9), f = a.substring(9, 11), v = 0; 10 > v; v++)
                                                                    if ("" + u + f == "" + v + v + v + v + v + v + v + v + v + v + v) return n;
                                                                var c = r(u),
                                                                    e = t(u + "" + c);
                                                                return f.toString() === c.toString() + e.toString() ? i : n
                                                            }
                                                        }

                                                        var CPF = new CPF();

                                                        $("#cpf_alu").blur(function(){
                                                            $("#validacpftxt").html(CPF.valida($(this).val()));
                                                            var validacpftxt = $('#validacpftxt').html().length;
                                                            if ($.trim($('#validacpftxt').html()) === "<b>CPF Inválido</b>"){
                                                                $("#teste").attr('disabled', 'disabled');
                                                            }else{
                                                                $("#teste").removeAttr('disabled');
                                                            }
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dt_nasc_alu" class="form-control-label">Data de nascimento</label>
                                                    <input class="form-control" type="date" name="dt_nasc_alu" id="dt_nasc_alu" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="sexo_alu">Sexo</label>
                                                    <select id="sexo_alu" name="sexo_alu" class="form-control">
                                                        <option value="M">Masculino</option>
                                                        <option value="F">Feminino</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_pai" class="form-control-label">Nome do pai</label>
                                                    <input class="form-control" type="text" maxlength="100" name="nome_pai" id="nome_pai" />
                                                </div>
                                            </div> 
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="rg_pai" class="form-control-label">RG pai</label>
                                                    <input class="form-control" type="text" maxlength="12" name="rg_pai" id="rg_pai" />
                                                </div>
                                            </div> 
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_mae" class="form-control-label">Nome da mãe</label>
                                                    <input class="form-control" type="text" maxlength="100" name="nome_mae" id="nome_mae" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="rg_mae" class="form-control-label">RG mãe</label>
                                                    <input class="form-control" type="text" maxlength="12" name="rg_mae" id="rg_mae" />
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="resp" class="form-control-label">Responsável</label>
                                                    <input class="form-control" type="text" maxlength="100" name="resp" id="resp" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="rg_resp" class="form-control-label">RG responsável</label>
                                                    <input class="form-control" type="text" maxlength="12" name="rg_resp" id="rg_resp" />
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cel_alu" class="form-control-label">Celular</label>
                                                    <input class="form-control" type="text" name="cel_alu" id="cel_alu" />
                                                </div>
                                            </div> 
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tel_alu" class="form-control-label">Telefone</label>
                                                    <input class="form-control" type="text" name="tel_alu" id="tel_alu" />
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
                                        <br>
                                        <h4>Informações para matrícula</h4>
                                        <hr>                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <script>
                                                        //$("#2trim").attr('disabled', 'disabled');
                                                    </script>
                                                    <label for="tipo_alu">Modalidade</label>
                                                    <select id="tipo_alu" name="tipo_alu" class="form-control">
                                                        <option value="I">Ensino Integrado</option>
                                                        <option value="S">Ensino Subsequente</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_cur" class="form-control-label">Curso</label>
                                                    <select class="form-control" type="text" name="id_cur" id="id_cur">
                                                        <option value="0">Administração</option>
                                                        <option value="3">Análises Clínicas</option>
                                                        <option value="4">Gerência em Saúde</option>
                                                        <option value="5">Informática para Internet</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cidade">Ano Letivo</label>
                                                    <input onkeypress='return SomenteNumero(event)' maxlength="4" id="ano_letivo" name="ano_letivo" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="uf">Semestre</label>
                                                    <select class="form-control" type="text" name="semestre" id="semestre">
                                                        <option value="1">1º semestre</option>
                                                        <option id="2trim" value="2">2º semestre</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button id="teste" type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
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
    
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
	<script src="\siaeteot/assets/js/cep.js"></script>
	<script src="\siaeteot/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\siaeteot/assets/js/script_mask.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>
