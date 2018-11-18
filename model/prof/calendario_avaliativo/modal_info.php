<?php
include "../../../base/conexao.php";
$evento = $_GET['evento'];

$sql  = "select e.id_evento_av, e.dt_evento, e.tipo, e.cor, e.descricao, d.nome_disc, t.numero, t.ano_letivo, t.id_cur ";
$sql .= "from evento_avaliativo e, disciplina d, turma t, funcionario f "; 
$sql .= "where e.id_disc = d.id_disc and t.id_turma = e.id_turma and e.id_func = f.id_func "; 
$sql .= "and id_evento_av = $evento";
$query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
$array = mysqli_fetch_array($query);
?>
<div class="modal-header">
                <h5 class="modal-title">Evento avaliativo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="modal-body" class="modal-body">  
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Evento:</strong>
                                <p class="form-control-plaintext">
                                    <?php 
                                        switch($array['tipo']){
                                            case 1:
                                                echo "Trabalho";
                                                break;
                                            case 2:
                                                echo "Teste";
                                                break;
                                            case 3:
                                                echo "Prova";
                                                break;
                                            case 4:
                                                echo "Seminário";
                                            break;
                                        }
                                        echo " de ".$array['nome_disc']; 
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Disciplina:</strong>
                                <p class="form-control-plaintext"><?php echo $array['nome_disc']; ?></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <strong>Data:</strong>
                                <p class="form-control-plaintext"><?php echo implode("/", array_reverse(explode("-", $array['dt_evento']))) ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <strong>Descrição</strong>
                            <p class="form-control-plaintext"><textarea style='height:140px;' class="form-control" readonly><?php echo $array['descricao'] ?></textarea></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check"></i>&nbsp;OK</button>
                <a href='controller/exclui_evento.php?id_evento=<?php echo $array['id_evento_av'] ?>'><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp; Excluir evento</button></a>
            </div>