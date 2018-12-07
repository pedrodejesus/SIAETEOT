<?php 
include "../../../base/conexao.php";

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
        $faltas_trim    = $row_alu['faltas_1t'];
    }
    if($trimestre == 2){
        $nota_trimestre = $row_alu['nota_2t'];
        $recu_trimestre = $row_alu['nota_rec_2t'];
        $faltas_trim    = $row_alu['faltas_2t'];
    }
    if($trimestre == 3){
        $nota_trimestre = $row_alu['nota_3t'];
        $recu_trimestre = $row_alu['nota_rec_3t'];
        $faltas_trim    = $row_alu['faltas_3t'];
    }
    echo "<tr scope='row'>"; 
    echo "<td>".$row_alu['matricula_alu']."</td>"; 
    echo "<td>".$num_chamada_prov++."</td>"; 
    echo "<td>".$row_alu['nome_alu']." ".$row_alu['sobrenome_alu']."</td>"; 
    echo "<td><input class='form-control form-control-sm' type='text' maxlength='4' id='falta' name='falta[]' value='".$faltas_trim."' autocomplete='off' /></td>";
    echo "<td><input class='form-control form-control-sm' type='text' maxlength='4' id='nota".$cont_nota++."' name='nota[]' value='".$nota_trimestre."' autocomplete='off' /></td>";
    echo "<td><input class='form-control form-control-sm' type='text' maxlength='4' id='recu".$cont_rec++."' name='rec[]' value='".$recu_trimestre."' autocomplete='off' ";if(is_null($recu_trimestre)){echo "readonly";}echo " tabindex='-1' /></td>";
    echo "<td id='resp".$cont_resp++."' ></td>"; 
    echo "<td><input type='hidden' name='matricula_alu[]' id='matricula_alu[]' value='".$row_alu['matricula_alu']."' /></td>";
    echo "</tr>";
    
}  

echo'
<script type="text/javascript">
        /*$(document).ready(function(){
            $("#nota1").inputmask("9[9].9");
            $("#recu1").inputmask("9[9].9");
        });*/
    </script>
';
?>
