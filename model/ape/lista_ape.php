<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
include "../../base/head.php"
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.js" integrity="sha256-MCmDSoIMecFUw3f1LicZ/D/yonYAoHrgiep/3pCH9rw=" crossorigin="anonymous"></script>
<script src="\projeto/assets/js/jquery-migrate-1.4.1"></script>
<script>
    $(document).ready(function(){
        $('#ano_letivo').change(function(){
            $('#id_turma').load('select_turma.php?ano_letivo='+$('#ano_letivo').val());
        });
    });
    $(document).ready(function(){
        $('#id_turma').change(function(){
            $('#tbody_alu').load('lista_alu.php?id_turma='+$('#id_turma').val());
            //$('#tbody_turma').load('lista_turma.php?ano_letivo='+$('#ano_letivo_corrente').val());
        });
    });
    /*$(document).ready(function(){
        $('#id_turma').change(function(){
            $('#tbody_turma').load('lista_turma.php?ano_letivo_corrente='+$('#ano_letivo_corrente').val());
        });
    });*/
</script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                include "../../base/sidebar.php";
                include "../../base/conexao.php";
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div draggable="true" class="card-header bg-light">
                                    <h4>Aproveitamento de Estudos</h4>
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ano_letivo" class="form-control-label">Ano letivo</label>
                                                    <select class="form-control" type="text" name="ano_letivo" id="ano_letivo">
                                                        <option value="">Selecione o ano letivo</option>
                                                        <?php
                                                            $sql_ano = "select distinct ano_letivo from matriculado order by ano_letivo desc";
                                                            $query_ano = mysqli_query($conexao, $sql_ano) or die(mysqli_error($conexao));

                                                            while($array_ano = mysqli_fetch_array($query_ano)){
                                                                echo "<option value='".$array_ano['ano_letivo']."'>".$array_ano['ano_letivo']."</option>";
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="id_turma" class="form-control-label">Turma</label>
                                                    <select class="form-control" type="text" name="id_turma_ano_letivo_corrente" id="id_turma">
                                                        <option value="">Selecione</option>
                                                    </select>
                                                </div> 
                                            </div>
                                        </div> 
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                    <div id="table-list" class="table-responsive">
                                                        <table id="tabela_turma" class="table table-sm table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope='col'>Aluno</th>
                                                                    <th scope='col'>Situação</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbody_alu">
                                                                
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
    </div>
    
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
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
    <!--<script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>-->
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
