<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'transf_ue';
include "../../../../base/head.php";
?>
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
<script src="\siaeteot/assets/js/jquery-migrate-1.4.1"></script>
<script src="\siaeteot/assets/js/jquery.autocomplete.js"></script>
<link href="\siaeteot/assets/js/jquery.autocomplete.css" rel="stylesheet">
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
    /*$(document).ready(function(){
        $('#ano_letivo').change(function(){
            $('#id_turma').load('select_turma.php?ano_letivo='+$('#ano_letivo').val()+'&id_ue='+$('#id_ue').val());
        });
    });*/
    
</script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                include "../../../../base/sidebar/8_sidebar_secretaria.php"; 
                include "../../../../base/conexao.php";
            ?>
            <div class="content">
                <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\siaeteot/model/secretaria/transf_ue/lista_transf_ue.php">Transferências de U.E.</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Transferir aluno</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Transferir aluno</h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/insere_transf_alu.php" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php
                                                    if(isset($_GET['matricula_alu'])){
                                                        $matricula_alu = $_GET['matricula_alu'];
                                                        $query_alu = mysqli_query($conexao, "select nome_alu, sobrenome_alu from aluno where matricula_alu = $matricula_alu limit 1;");
                                                        $alu = mysqli_fetch_array($query_alu);
                                                    }
                                                ?>
                                                <label for="matricula_alu" class="form-control-label">Nome do aluno</label>
                                                <input class="form-control" type="text" name="matricula_alu" value="<?php echo $matricula_alu.' - '.$alu['nome_alu'].$alu['sobrenome_alu'] ?>" id="matricula_alu" required />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="id_ue" class="form-control-label">Unidade Escolar</label>
                                                <select class="form-control" type="text" name="id_ue" id="id_ue">
                                                    <?php
                                                        $query = mysqli_query($conexao, "select id_ue, nome_ue from unidade_estudantil order by nome_ue");
                                                        echo"<option value=''>Selecione</option>";
                                                        while($array = mysqli_fetch_array($query)){
                                                            echo"<option value='".$array['id_ue']."'>".$array['nome_ue']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="num_processo" class="form-control-label">Número do processo</label>
                                                <input class="form-control" type="text" maxlength="20" name="num_processo" id="num_processo" required />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dt_trans" class="form-control-label">Data da transferência</label>
                                                <input class="form-control" type="date" name="dt_matricula" value="<?php echo date('Y-m-d'); ?>" id="dt_matricula" />
                                            </div>
                                        </div>
                                    </div>                        
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <button type="submit" class="btn btn-success"><i class="fa fa-exchange"></i>&nbsp; Transferir</button>
                                                <a href="../lista_transf_ue.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>
