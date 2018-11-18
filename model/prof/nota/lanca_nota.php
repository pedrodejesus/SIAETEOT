<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 7)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'nota';
include "../../../base/head.php";
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.js" integrity="sha256-MCmDSoIMecFUw3f1LicZ/D/yonYAoHrgiep/3pCH9rw=" crossorigin="anonymous"></script>
<script src="\projeto/assets/js/jquery-migrate-1.4.1"></script>
<script>
    $(document).ready(function(){
        $('#id_cur').change(function(){
            $('#id_turma').load('select_turma.php?id_cur='+$('#id_cur').val());
        });
    });
    $(document).ready(function(){
        $('#id_turma').change(function(){
            $('#id_disc').load('select_disc.php?id_turma='+$('#id_turma').val());
        });
    });
    $(document).ready(function(){
        $('#trimestre').change(function(){
            $('#tbody_alu').load('lista_alu.php?id_turma='+$('#id_turma').val()+'&id_disc='+$('#id_disc').val()+'&trimestre='+$('#trimestre').val());
        });
    });
</script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php include "../../../base/sidebar/7_sidebar_prof.php" ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\projeto/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lançamento de Notas</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Lançamento de notas</h4>
                                </div>
                                <div id="listanotas" class="card-body">
                                    <?php 
                                        if(isset($_GET['msg'])){
                                            $msg = $_GET['msg'];

                                            switch($msg){
                                                case 1:
                                                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Notas lançadas com sucesso!
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>';
                                                    break;
                                                case 2:
                                                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Erro no lançamento das notas!
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>';
                                                    break;
                                            $msg = 0;
                                            }
                                        }
                                    ?>
                                    <form action="insere_nota.php" method="post">
                                        <div class="row">
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
                                                    <label for="id_turma" class="form-control-label">Turma</label>
                                                    <select class="form-control" type="text" name="id_turma" id="id_turma">
                                                        <option value="">Selecione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="id_disc" class="form-control-label">Disciplina</label>
                                                    <select class="form-control" type="text" name="id_disc" id="id_disc">
                                                        <option value="">Selecione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="trimestre" class="form-control-label">Trimestre</label>
                                                    <select class="form-control" type="text" name="trimestre" id="trimestre">
                                                        <option value="">Selecione</option>
                                                        <option value="1">Primeiro Trimestre</option>
                                                        <option value="2">Segundo Trimestre</option>
                                                        <option value="3">Terceiro Trimestre</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="turno" class="form-control-label">Aulas previstas</label>
                                                    <input class="form-control" type="text" maxlength="2" name="aulas_prev" id="aulas_prev" required />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="turno" class="form-control-label">Aulas realizadas</label>
                                                    <input class="form-control" type="text" maxlength="2" name="aulas_dadas" id="aulas_dadas" required />
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
                                                            <th scope='col'>Matrícula</th>
                                                            <th scope='col'>Número</th>
                                                            <th scope='col'>Nome</th>
                                                            <th scope='col'>Nota</th>
                                                            <th scope='col'>Recuperação</th>
                                                            <th scope='col'>Status</th>
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
                                                    <a href="lanca_nota.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-arrow-right"></i>&nbsp; Lançar notas</button> 
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
    <script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
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
                        if(val_nota > 10){
                            document.getElementById("nota"+num).value = 10;
                        }else if(val_rec > 10){
                            document.getElementById("recu"+num).value = 10;
                        }
					
					});
				});
			});
    </script>
	<!--<script src="\projeto/assets/js/script_mask.js"></script>-->
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
