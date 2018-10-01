<?php
include("../../../../base/conexao.php");

$ano_letivo = $_GET['ano_letivo'];
$curso = $_GET['id_cur'];

$query = mysqli_query($conexao, "select * from turma where ano_letivo = ".$ano_letivo." and id_cur = ".$curso." and numero like '1%'") or die(mysqli_error($conexao));

echo "<option value=''>Selecione</option>";
while($data = mysqli_fetch_array($query)){
        echo "<option value='".$data['id_turma']."'>".$data['numero']." / ".$data['ano_letivo']."</option>";    
}
?>