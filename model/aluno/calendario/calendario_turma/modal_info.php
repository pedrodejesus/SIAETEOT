<?php
$conexao = mysqli_connect("Localhost", "root", "", "cal");
mysqli_query($conexao, "SET NAMES 'utf8'");
mysqli_query($conexao, 'SET character_set_connection=utf8');
mysqli_query($conexao, 'SET character_set_client=utf8');
mysqli_query($conexao, 'SET character_set_results=utf8');

$evento = $_GET['evento'];
$sql  = "select e.data_evento, e.tipo, e.descricao, d.nome_disc, p.nome_prof ";
$sql .= "from evento e, disciplina d, professor p "; 
$sql .= "where e.id_disc = d.id_disc and e.id_prof = p.id_prof "; 
$sql .= "and id_evento = $evento";
$query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
$array = mysqli_fetch_array($query);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <strong>Evento:</strong>
                <p class="form-control-plaintext"><?php echo $array['tipo']." de ".$array['nome_disc']; ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <strong>Professor(a):</strong>
                <p class="form-control-plaintext"><?php echo $array['nome_prof']; ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <strong>Data:</strong>
                <p class="form-control-plaintext"><?php echo implode("/", array_reverse(explode("-", $array['data_evento']))) ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <strong>Descrição</strong>
            <p class="form-control-plaintext"><?php echo $array['descricao'] ?></p>
        </div>
    </div>
</div>