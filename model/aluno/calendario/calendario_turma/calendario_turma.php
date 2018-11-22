<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if ($_SESSION['UsuarioNivel'] != 1) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'calendario_turma';
include "../../../../base/head.php";
?>
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
<script src="\siaeteot/assets/js/jquery-migrate-1.4.1"></script>
<script>
    function mostrarMes(mes){
        $(document).ready(function(){
            $('#card-body').load('mostra_mes.php?mes='+mes);
        });
    }
    
    $(document).ready(function(){
        $('#modal-event').on('show.bs.modal', function(e){
            var evento = $(e.relatedTarget).data('event'); //Recebe o id do data-event
            $.ajax({
                type: 'get', 
                url: 'modal_info.php', 
                data:  'evento='+ evento, 
                success: function(data){
                    $('.modal-body').html(data);
                } 
            });
        });
    });
</script>
<style>
    td{
        max-width:20px !important;
        max-height:90px !important;
        word-wrap:break-word !important;
    }
    p{
        margin-bottom: -2px !important;
    }
    span{
        border-radius: 5px 5px 5px 5px;
        padding-bottom: 5px !important;
    }
</style>
</head>
<body class="sidebar-fixed header-fixed">
    <?php include "modal.php"; ?>
    <div class="page-wrapper">
    <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                //include "../../../../base/conexao.php";                
                include "../../../../base/sidebar/1_sidebar_aluno.php";
    
                /*$matricula_alu = $_GET['matricula_alu'];
                $sql  = "select distinct ano_letivo, id_turma from matriculado where matricula_alu = $matricula_alu order by ano_letivo desc";
                $query = mysqli_query($conexao, $sql); */
            ?>
            <div class="content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light">
                        <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Calendário de turma</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h3>Calendário de Turma</h3>
                                    </div>
                                </div>
                            </div>
                            <div id="card-body" class="card-body">
                                <?php
                                    include 'calendario_function.php';    
                                
                                    MostreCalendario(date('m')); //Mostra o calendário do mês atual
                                
                                    //MostreCalendario('05');
                                    //MostreCalendarioCompleto();

                                    /*$data_atual = date('d-m');
                                    echo $data_atual;*/
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </div>    
    
    <script src="\siaeteot/assets/js/popper.min.js"></script>
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="\siaeteot/assets/js/function-delete.js"></script>
    <script src="\siaeteot/assets/js/function-search.js"></script>
    <script src="\siaeteot/assets/js/chart.min.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
    <script src="\siaeteot/assets/js/demo.js"></script>
</body>

</html>
