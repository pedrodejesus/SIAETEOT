<?php 
include "../../base/conexao.php";

$ano_letivo = $_GET['ano_letivo_corrente'] + 1;

$sql = "select * from turma where ano_letivo = ".$ano_letivo;
$query = mysqli_query($conexao, $sql); 
//mysqli_next_result($conexao);


$cont_nota = 1;
$cont_rec = 1;
$cont_resp = 1;
$num_chamada_prov = 1;

while($row = mysqli_fetch_array($query)){ 
    switch($row['id_cur']){
        case 0:
            $curso = "Administração";
            break;
        case 3:
            $curso = "Análises Clínicas";
            break;
        case 4:
            $curso = "Gerência em Saúde";
            break;
        case 5:
            $curso = "Informática para Internet";
            break;
    }
    echo "<tr scope='row'>"; 
    echo "<td><div class='form-check form-check-inline'><input class='form-check-input' name='id_turma' value='".$row['id_turma']."' type='radio' required />".$row['numero']." / ".$row['ano_letivo']." - ".$curso."</div></td>"; 
    echo "</tr>";
}  
?>
