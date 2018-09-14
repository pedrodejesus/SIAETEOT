<?php
include "../../base/conexao.php";
 
$ano_letivo = $_GET['ano_letivo_corrente'];
 
$rs = mysqli_query($conexao, "SELECT * FROM turma WHERE ano_letivo = '$ano_letivo' ORDER BY numero");

echo "<option value=''>Selecione</option>";
while($data = mysqli_fetch_array($rs)){
        echo "<option value='".$data['id_turma']."'>".$data['numero']." / ".$data['ano_letivo']."</option>";    
}
 
?>