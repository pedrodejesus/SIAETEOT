<?php
include "../../base/conexao.php";
 
$id_cur = $_GET['id_cur'];
 
$rs = mysqli_query($conexao, "SELECT * FROM turma WHERE id_cur = '$id_cur' ORDER BY numero");
$nr = mysqli_num_rows($rs);

while($data = mysqli_fetch_array($rs)){
    if ($nr > 1){
        echo "<option value='".$data['id_turma']."'>".$data['numero']." / ".$data['ano_letivo']."</option>";
    }else{
        echo "<option value='".$data['id_turma']."' SELECTED>".$data['numero']." / ".$data['ano_letivo']."</option>";
    }
    
}
 
?>