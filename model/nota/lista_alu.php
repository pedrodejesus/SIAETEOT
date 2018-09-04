<?php 
include "../../base/conexao.php";

$id_turma  = $_GET['id_turma'];
$id_disc   = $_GET['id_disc'];
$trimestre = $_GET['trimestre'];

$sql = "call select_alunos_turma_disc(".$id_turma.", ".$id_disc.");";
$query = mysqli_query($conexao, $sql); 
//mysqli_next_result($conexao);

$cont_nota = $cont_rec = $cont_resp = $num_chamada_prov = 1;

while($row_alu = mysqli_fetch_array($query)){ 
    /*echo $trimestre."<br>";*/
    if ($trimestre == 1){
        $nota_trimestre = $row_alu['nota_1t'];
        $recu_trimestre = $row_alu['nota_rec_1t'];
    }
    if($trimestre == 2){
        $nota_trimestre = $row_alu['nota_2t'];
        $recu_trimestre = $row_alu['nota_rec_2t'];
    }
    if($trimestre == 3){
        $nota_trimestre = $row_alu['nota_3t'];
        $recu_trimestre = $row_alu['nota_rec_3t'];
    }
    echo "<tr scope='row'>"; 
    echo "<td>".$row_alu['matricula_alu']."</td>"; 
    echo "<td>".$num_chamada_prov++."</td>"; 
    echo "<td>".$row_alu['nome_alu']." ".$row_alu['sobrenome_alu']."</td>"; 
    echo "<td><input class='form-control form-control-sm' type='text' maxlength='4' id='nota".$cont_nota++."' name='nota[]' value='".$nota_trimestre."' autocomplete='off' /></td>";
    echo "<td><input class='form-control form-control-sm' type='text' maxlength='4' id='recu".$cont_rec++."' name='rec[]' value='".$recu_trimestre."' autocomplete='off' readonly /></td>";
    echo "<td id='resp".$cont_resp++."' ></td>"; 
    echo "<td><input type='hidden' name='matricula_alu[]' id='matricula_alu[]' value='".$row_alu['matricula_alu']."' /></td>";
    echo "</tr>";
    
}  
?>
