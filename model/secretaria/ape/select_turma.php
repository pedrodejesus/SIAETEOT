<?php
include "../../../base/conexao.php";
 
$ano_letivo = $_GET['ano_letivo'];
$id_cur = $_GET['id_cur'];
 
$rs = mysqli_query($conexao, "SELECT * FROM turma WHERE ano_letivo = '$ano_letivo' and id_cur = $id_cur ORDER BY numero") or die (mysqli_error($conexao));

echo "<option value=''>Selecione</option>";
while($data = mysqli_fetch_array($rs)){
        echo "<option value='".$data['id_turma']."'>".$data['numero']." / ".$data['ano_letivo']."</option>";    
}
 
?>