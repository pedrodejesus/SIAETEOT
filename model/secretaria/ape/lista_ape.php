<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'ape';
include "../../../base/head.php";
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.js" integrity="sha256-MCmDSoIMecFUw3f1LicZ/D/yonYAoHrgiep/3pCH9rw=" crossorigin="anonymous"></script>
<script src="\siaeteot/assets/js/jquery-migrate-1.4.1"></script>
<script>
    $(document).ready(function(){
        $('#id_cur').change(function(){
            $('#id_turma').load('select_turma.php?ano_letivo='+$('#ano_letivo').val()+'&id_cur='+$('#id_cur').val());
        });
    });
    $(document).ready(function(){
        $('#id_turma').change(function(){
            $('#tbody_alu').load('lista_alu.php?id_turma='+$('#id_turma').val()+'&ano_letivo='+$('#ano_letivo').val());
            //$('#tbody_turma').load('lista_turma.php?ano_letivo='+$('#ano_letivo_corrente').val());
        });
    });
    $(document).ready(function(){
        $('#id_turma').change(function(){
            $('#tbody_turma').load('lista_turma.php?ano_letivo='+$('#ano_letivo').val()+'&id_cur='+$('#id_cur').val());
        });
    });
    
    $(document).ready(function(){
        $('#modal-detail').on('show.bs.modal', function(e){
            var matricula_alu = $(e.relatedTarget).data('alu'); //Recebe o id do data-alu
            var id_turma = $(e.relatedTarget).data('turma'); //Recebe o id do data-turma
            $.ajax({
                type: 'get', 
                url: 'modal_info.php', 
                data: {matricula_alu : matricula_alu, id_turma : id_turma}, 
                success: function(data){
                    $('.modal-body').html(data);
                } 
            });
        });
    });
</script>
</head>

<body class="sidebar-fixed header-fixed">
    <?php include "modal.php"; ?>
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                include "../../../base/sidebar/8_sidebar_secretaria.php";
                include "../../../base/conexao.php";
            ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">APE</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
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
                                            <div class="col-md-4">
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
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="id_turma" class="form-control-label">Curso</label>
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
                                        </div> 
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <div id="table-list" class="table-responsive">
                                                        <table id="tabela_alu" class="table table-sm table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th scope='col'>Matrícula</th>
                                                                    <th scope='col'>Aluno</th>
                                                                    <th scope='col'>Situação</th>
                                                                    <th scope='col'>Ações</th>
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
                                                    <!--<button type="submit" class="btn btn-success"><i class="far fa-sync-alt"></i>&nbsp; Remanejar alunos</button> -->
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
