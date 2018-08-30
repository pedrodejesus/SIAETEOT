<?php 
include "../../base/conexao.php";

$id_turma = $_GET['id_turma'];
//$id_disc = $_GET['id_disc'];

$sql = "call select_alunos_turma_sem_remat(".$id_turma.");";
$query = mysqli_query($conexao, $sql); 
//mysqli_next_result($conexao);

$cont_nota = 1;
$cont_rec = 1;
$cont_resp = 1;
$num_chamada_prov = 1;

echo "
    <tr><td><script>
                                                                    $(document).ready(function() {
                                                                        $('#checkTodos').click(function() {
                                                                            if(this.checked) {
                                                                                $('.checkbox').each(function() {
                                                                                    this.checked = true;
                                                                                });
                                                                            } else {
                                                                                $('.checkbox').each(function() {
                                                                                    this.checked = false;
                                                                                });
                                                                            }
                                                                        });
                                                                    });
                                                                </script></tr></td>
";
echo "<tr scope='row'>"; 
echo "<td><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' name='checkTodos' id='checkTodos' /> Marcar/Desmarcar Todos</div></td>"; 
echo "</tr>";

while($row_alu = mysqli_fetch_array($query)){ 
    echo "<tr scope='row'>"; 
    //echo "<td>".$row_alu['matricula_alu']."</td>"; 
    //echo "<td>".$num_chamada_prov++."</td>"; 
    echo "<td><div class='form-check form-check-inline'><input class='form-check-input checkbox' type='checkbox' name='matricula_alu[]' value='".$row_alu['matricula_alu']."' />".$row_alu['nome_alu']." ".$row_alu['sobrenome_alu']."</div></td>"; 
    /*echo "<td><input class='form-control form-control-sm' type='text' maxlength='4' id='nota".$cont_nota++."' name='nota[]' /></td>";
    echo "<td><input class='form-control form-control-sm' type='text' maxlength='4' id='recu".$cont_rec++."' name='rec[]' readonly /></td>";*/
    echo "<td>APR</td>"; 
    //echo "<td><input type='hidden' name='matricula_alu[]' id='matricula_alu[]' value='".$row_alu['matricula_alu']."' /></td>";
    echo "</tr>";
}  
?>
