<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'turma';
include "../../../../base/head.php";
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php include "../../../../base/sidebar/8_sidebar_secretaria.php" ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\projeto/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\projeto/model/secretaria/turma/lista_turma.php">Turmas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Adicionar turma</h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/insere_turma.php" method="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_turma" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text" name="id_turma" id="id_turma" value="0" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
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
                                                    <label for="numero" class="form-control-label">Número</label>
                                                    <input onkeypress='return SomenteNumero(event)' class="form-control" type="text" maxlength="4" name="numero" id="numero" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="ano_letivo" class="form-control-label">Ano letivo</label>
                                                    <input class="form-control" type="text" maxlength="4" name="ano_letivo" id="ano_letivo" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="situacao" class="form-control-label">Situação</label>
                                                    <select class="form-control" type="text" name="situacao" id="situacao">
                                                        <option value="1">Ativa</option>
                                                        <option value="0">Encerrada</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="turno" class="form-control-label">Turno</label>
                                                    <select class="form-control" type="date" name="turno" id="turno">
                                                        <option value="1">Manhã</option>
                                                        <option value="2">Tarde</option>
                                                        <option value="3">Noite</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_cur">Curso</label>
                                                    <select id="id_cur" name="id_cur" class="form-control">
                                                        <option value="0">Administração</option>
                                                        <option value="3">Análises Clínicas</option>
                                                        <option value="4">Gerência em Saúde</option>
                                                        <option value="5">Informática para Internet</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="dt_inicio" class="form-control-label">Data de início</label>
                                                    <input class="form-control" type="date" name="dt_inicio" id="dt_inicio" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="dt_fim" class="form-control-label">Data de fim</label>
                                                    <input class="form-control" type="date" name="dt_fim" id="dt_fim" disabled />
                                                </div>
                                            </div>
                                        </div>  
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group">
                                                    <a href="../lista_turma.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-arrow-right"></i>&nbsp; Disciplinas padrão</button> 
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

    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
