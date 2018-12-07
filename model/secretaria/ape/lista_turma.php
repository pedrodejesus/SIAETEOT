<?php 
include "../../../base/conexao.php";

$ano_letivo = $_GET['ano_letivo'];
$proximo_ano = $ano_letivo + 1;
$id_cur = $_GET['id_cur'];

$sql = "select * from turma where ano_letivo = ".$proximo_ano." and id_cur =".$id_cur." order by numero asc";
$query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao)); 

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
