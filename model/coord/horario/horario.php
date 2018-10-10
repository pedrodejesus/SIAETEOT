<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 6)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'remanejamento';
include "../../../base/head.php";
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-1.11.1.js" integrity="sha256-MCmDSoIMecFUw3f1LicZ/D/yonYAoHrgiep/3pCH9rw=" crossorigin="anonymous"></script>-->
<script src="\projeto/assets/js/jquery-migrate-1.4.1"></script>
<script>
    $(document).ready(function(){
        $('#id_cur').change(function(){
            $('#id_turma').load('select_turma.php?ano_letivo_corrente='+$('#ano_letivo_corrente').val()+'&id_cur='+$('#id_cur').val());
        });
    });
    $(document).ready(function(){
        $('#id_turma').change(function(){
            $('#tbody_alu').load('lista_alu.php?id_turma='+$('#id_turma').val());
        });
    });
    $(document).ready(function(){
        $('#id_turma').change(function(){
            $('#tbody_turma').load('lista_turma.php?ano_letivo_corrente='+$('#ano_letivo_corrente').val()+'&id_cur='+$('#id_cur').val());
        });
    });
</script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php include "../../../base/sidebar/6_sidebar_coord.php" ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\projeto/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Horário</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Horário</h4>
                                </div>
                                <div id="listanotas" class="card-body">
                                    <?php 
                                        if(isset($_GET['msg'])){
                                            $msg = $_GET['msg'];

                                            switch($msg){
                                                case 1:
                                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Alunos remanejados com sucesso!
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>';
                                                    break;
                                                case 2:
                                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Erro no remanejamento de alunos!
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>';
                                                    break;
                                                $msg = 0;
                                            }
                                        }
                                    ?>
                                    <form action="insere_remat.php" method="post">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_cur" class="form-control-label">Ano letivo</label>
                                                            <select class="form-control" type="text" name="ano_letivo_corrente" id="ano_letivo_corrente">
                                                                <option value="">Selecione o ano letivo corrente</option>
                                                                <?php
                                                                    $ano_atual = date("Y");
                                                                    $ano_anterior = $ano_atual - 1;
                                                                    $ano_preanterior = $ano_atual - 2;
                                                                    $proximo_ano = $ano_atual + 1;
                                                                    echo "<option value='".$ano_atual."'>".$ano_atual."</option>";
                                                                    echo "<option value='".$ano_anterior."'>".$ano_anterior."</option>";
                                                                    echo "<option value='".$ano_preanterior."'>".$ano_preanterior."</option>";
                                                                    echo "<option value='".$proximo_ano."'>".$proximo_ano."</option>";
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_cur" class="form-control-label">Ano letivo</label>
                                                            <select class="form-control" type="text" name="ano_letivo_corrente" id="ano_letivo_corrente">
                                                                <option value="">Selecione o ano letivo corrente</option>
                                                                <?php
                                                                    $ano_atual = date("Y");
                                                                    $ano_anterior = $ano_atual - 1;
                                                                    $ano_preanterior = $ano_atual - 2;
                                                                    $proximo_ano = $ano_atual + 1;
                                                                    echo "<option value='".$ano_atual."'>".$ano_atual."</option>";
                                                                    echo "<option value='".$ano_anterior."'>".$ano_anterior."</option>";
                                                                    echo "<option value='".$ano_preanterior."'>".$ano_preanterior."</option>";
                                                                    echo "<option value='".$proximo_ano."'>".$proximo_ano."</option>";
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="id_cur" class="form-control-label">Ano letivo</label>
                                                            <select class="form-control" type="text" name="ano_letivo_corrente" id="ano_letivo_corrente">
                                                                <option value="">Selecione o ano letivo corrente</option>
                                                                <?php
                                                                    $ano_atual = date("Y");
                                                                    $ano_anterior = $ano_atual - 1;
                                                                    $ano_preanterior = $ano_atual - 2;
                                                                    $proximo_ano = $ano_atual + 1;
                                                                    echo "<option value='".$ano_atual."'>".$ano_atual."</option>";
                                                                    echo "<option value='".$ano_anterior."'>".$ano_anterior."</option>";
                                                                    echo "<option value='".$ano_preanterior."'>".$ano_preanterior."</option>";
                                                                    echo "<option value='".$proximo_ano."'>".$proximo_ano."</option>";
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <div id="table-list" class="table-responsive">
                                                        <table id="tabela_turma" class="table table-sm table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope='col'>Aluno</th>
                                                                    <th scope='col'>Situação</th>
                                                                    <!--<th scope='col'>Nome</th>
                                                                    <th scope='col'>Nota</th>
                                                                    <th scope='col'>Recuperação</th>
                                                                    <th scope='col'>Status</th>-->
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody_alu">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                    <div id="table-list" class="table-responsive">
                                                        <table id="tabela_turma" class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th scope='col'>Selecione próxima turma</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody_turma">

                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group">
                                                    <a href="remaneja_alu.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
                                                    <button type="submit" class="btn btn-success"><i class="far fa-sync-alt"></i>&nbsp; Remanejar alunos</button> 
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
