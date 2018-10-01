<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'resp';
include "../../../../base/head.php";
?>
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
<script src="\projeto/assets/js/jquery-migrate-1.4.1"></script>
<script src="\projeto/assets/js/jquery.autocomplete.js"></script>
<link href="\projeto/assets/js/jquery.autocomplete.css" rel="stylesheet">
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script type="text/javascript">
    $().ready(function() {
        $("#matricula_alu").autocomplete("filtra_alu.php", {
            width: 250,
            matchContains: true,
            //mustMatch: true,
            //minChars: 0,
            //multiple: true,
            //highlight: false,
            //multipleSeparator: ",",
            selectFirst: false
        });
    });
</script>
</head>
<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php include "../../../../base/sidebar/8_sidebar_secretaria.php" ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Adicionar responsável</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/insere_resp.php" method="post">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_resp" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text" value="0" name="id_resp" id="id_resp" disabled/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_resp" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="30" name="nome_resp" id="nome_resp" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="sobrenome_resp" class="form-control-label">Sobrenome</label>
                                                    <input class="form-control" type="text" maxlength="70" name="sobrenome_resp" id="sobrenome_resp" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cpf_resp" class="form-control-label">CPF</label>
                                                    <input class="form-control" type="text" name="cpf_resp" id="cpf_resp" required />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
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
                                                    <label for="rg_resp" class="form-control-label">RG</label>
                                                    <input onkeypress='return SomenteNumero(event)' class="form-control" type="text" maxlength="14" name="rg_resp" id="rg_resp" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="cel_resp" class="form-control-label">Celular</label>
                                                    <input class="form-control" type="text" name="cel_resp" id="cel_resp" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="tel_resp">Telefone</label>
                                                    <input id="tel_resp" name="tel_resp" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email_resp">E-mail</label>
                                                    <input id="email_resp" name="email_resp" maxlength="60" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="matricula_alu" class="form-control-label">Aluno Referente</label>
                                                    <input class="form-control" type="text" name="matricula_alu" id="matricula_alu" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_responsavel.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
	<script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
