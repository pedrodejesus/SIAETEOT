<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
include "../../../base/head.php"
?>
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
<script src="\projeto/assets/js/jquery-migrate-1.4.1"></script>
<script src="\projeto/assets/js/jquery.autocomplete.js"></script>
<link href="\projeto/assets/js/jquery.autocomplete.css" rel="stylesheet">
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
    $(document).ready(function(){
        $('#ano_letivo').change(function(){
            $('#id_turma').load('select_turma.php?ano_letivo='+$('#ano_letivo').val()+'&id_cur='+$('#id_cur').val());
        });
    });
    
</script>
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
                                    <h4>Matricular aluno</h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/insere_mat.php" method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="matricula_alu" class="form-control-label">Nome do aluno</label>
                                                <input class="form-control" type="text" name="matricula_alu" id="matricula_alu" required />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id_cur" class="form-control-label">Curso</label>
                                                <select class="form-control" type="text" name="id_cur" id="id_cur">
                                                    <option value="">Selecione</option>
                                                    <option value="0">Administração</option>
                                                    <option value="3">Análises Clínicas</option>
                                                    <option value="4">Gerência em Saúde</option>
                                                    <option value="5">Informática para Internet</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="ano_letivo" class="form-control-label">Ano letivo</label>
                                                <select class="form-control" type="text" name="ano_letivo" id="ano_letivo">
                                                    <option value="">Selecione</option>
                                                    <?php
                                                        $ano_atual = date("Y");
                                                        $ano_anterior = $ano_atual - 1;
                                                        $ano_preanterior = $ano_atual - 2;
                                                        $proximo_ano = $ano_atual + 1;
                                                        echo "<option value='".$ano_atual."'>".$ano_atual."</option>";
                                                        echo "<option value='".$ano_anterior."'>".$ano_anterior."</option>";
                                                        echo "<option value='".$proximo_ano."'>".$proximo_ano."</option>";
                                                        echo "<option value='".$ano_preanterior."'>".$ano_preanterior."</option>";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id_turma" class="form-control-label">Turma</label>
                                                <select class="form-control" type="text" name="id_turma" id="id_turma">
                                                    <option value="">Selecione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="tipo_matricula" class="form-control-label">Modalidade</label>
                                                <select id="tipo_matricula" name="tipo_matricula" class="form-control">
                                                    <option value="1">Integrado</option>
                                                    <option value="2">Subsequente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dt_matricula" class="form-control-label">Data da matrícula</label>
                                                <input class="form-control" type="text" name="dt_matricula" value="<?php echo date('d/m/Y'); ?> " id="dt_matricula" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div id='teste' class="row">
                                        
                                    </div>                          
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Matricular</button>
                                                <a href="../lista_matriculado.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
