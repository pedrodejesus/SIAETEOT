<?php
/*$conexao = mysqli_connect("Localhost", "root", "", "cal");
mysqli_query($conexao, "SET NAMES 'utf8'");
mysqli_query($conexao, 'SET character_set_connection=utf8');
mysqli_query($conexao, 'SET character_set_client=utf8');
mysqli_query($conexao, 'SET character_set_results=utf8');*/
include "../../../../base/conexao.php";

$evento = $_GET['evento'];
$sql  = "select e.dt_evento, e.tipo, e.cor, e.descricao, d.nome_disc, f.nome_func ";
$sql .= "from evento_avaliativo e, disciplina d, funcionario f "; 
$sql .= "where e.id_disc = d.id_disc and e.id_func = f.id_func "; 
$sql .= "and id_evento_av = $evento";
$query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
$array = mysqli_fetch_array($query);
?>
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
                <strong>Professor(a):</strong>
                <p class="form-control-plaintext"><?php echo $array['nome_func']; ?></p>
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