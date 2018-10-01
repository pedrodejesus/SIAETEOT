<?php
include "../../../base/conexao.php";
 
$ano_letivo = $_GET['ano_letivo_corrente'];
$id_cur = $_GET['id_cur'];
 
$rs = mysqli_query($conexao, "select * from turma where ano_letivo = '$ano_letivo' and id_cur = $id_cur order by numero");

echo "<option value=''>Selecione</option>";
while($data = mysqli_fetch_array($rs)){
        echo "<option value='".$data['id_turma']."'>".$data['numero']." / ".$data['ano_letivo']."</option>";    
}
 
?>