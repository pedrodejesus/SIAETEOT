<?php
include "../../../../base/conexao.php";
 
$id_cur     = $_GET['id_cur'];
$ano_letivo = $_GET['ano_letivo'];
 
$rs = mysqli_query($conexao, "SELECT * FROM turma WHERE id_cur = '$id_cur' and ano_letivo = $ano_letivo ORDER BY numero") or die(mysqli_error($conexao));

echo "<option value=''>Selecione</option>";  
while($data = mysqli_fetch_array($rs)){
    echo "<option value='".$data['id_turma']."'>".$data['numero']." / ".$data['ano_letivo']."</option>";  
}
 
?>