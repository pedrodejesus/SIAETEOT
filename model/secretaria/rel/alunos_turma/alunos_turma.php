<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'rel_alunos_turma';
include "../../../../base/head.php";
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
<script src="\siaeteot/assets/js/jquery-migrate-1.4.1"></script>
<script>
    /*$(document).ready(function(){
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
                            <li class="breadcrumb-item active" aria-current="page">Relatório de alunos por turma</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Relatório de Alunos por Turma</h4>
                                </div>
                                <div id="listanotas" class="card-body">
                                    <form action="rel_alunos_turma.php" method="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_cur" class="form-control-label">Ano letivo</label>
                                                    <select class="form-control" type="text" name="ano_letivo" id="ano_letivo">
                                                        <option value="">Selecione o ano letivo </option>
                                                        <?php
                                                            $sql = "select distinct ano_letivo from matriculado order by ano_letivo desc";
                                                            $query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
                                                            while($row = mysqli_fetch_array($query)){
                                                                echo "<option value='".$row['ano_letivo']."'>".$row['ano_letivo']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button id='add' type="submit" class="btn btn-primary col-sm-12"><i class="fal fa-print"></i>&nbsp; Imprimir</button>
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
    <script type="text/javascript">
            var el = document.getElementById('listanotas');
			el.addEventListener('keydown', function(e) {
				var num = (e.target.id).substring(4,6);
				$(document).ready(function() {
					$("input[id='"+e.target.id+"']").bind('keydown blur click',function() {
						var val_nota = parseFloat(document.getElementById("nota"+num).value);
						var val_rec = parseFloat(document.getElementById("recu"+num).value);
						if(val_nota >= 6){
							document.getElementById("resp"+num).innerHTML = "<i class='fa fa-check ml-4' style='color:green;'></i>";
						}else{
                            //document.getElementById("recu"+num).disabled = false;
                            $('#recu'+num).attr('readonly', false);
                            //$('input[name=recu'+num']').prop('readonly', false);
                            if (val_rec >= 6){
                                document.getElementById("resp"+num).innerHTML = "<i class='fa fa-check ml-4' style='color:green;'></i>";
                            }else{
                                document.getElementById("resp"+num).innerHTML = "<i class='fa fa-times ml-4' style='color:red;'></i>";
                            }
						}
					
					});
				});
			});
    </script>
    <!--<script src="\siaeteot/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\siaeteot/assets/js/script_mask.js"></script>-->
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>
