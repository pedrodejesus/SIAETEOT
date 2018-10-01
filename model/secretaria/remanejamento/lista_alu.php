<?php 
include "../../../base/conexao.php";

$id_turma = $_GET['id_turma'];
$sql = "call select_alunos_turma_sem_remat(".$id_turma.");";
$query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao)); 
mysqli_next_result($conexao);

echo "<tr><script>
        $(document).ready(function() {
            $('#checkTodos').click(function() {
                if(this.checked) {
                    $('.checkbox').each(function() {
                        var isDisabled = $(this).prop('disabled');
                        if(isDisabled){
                            this.checked = false;
                        }else{
                            this.checked = true;
                        }                                                                          
                    });
                } else {
                    $('.checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });
        });
    </script></tr>"; //Script JS para marcar ou desnarcar todos os checkboxes que não estejam desabilitados;
echo "<tr scope='row'>"; 
echo "<td><div class='form-check form-check-inline'><input class='form-check-input' type='checkbox' name='checkTodos' id='checkTodos' /> Marcar/Desmarcar Todos</div></td>"; 
echo "</tr>";

while($row_alu = mysqli_fetch_array($query)){ 
    $sql_check = "call select_checa_ape(".$row_alu['matricula_alu'].", ".$id_turma.");";
    $query_check = mysqli_query($conexao, $sql_check) or die(mysqli_error($conexao));
    $query_array = mysqli_fetch_array($query_check);
    mysqli_next_result($conexao);
    
    //if($query_array[0]>3){echo"<tr><td>OK</td></tr>";}else{echo"<tr><td>NOT OK</td></tr>";}
        
    echo "<tr ";
    if($query_array[0]>3){echo"class='table-danger'";}; //Se reprovado, mostra a row em vermelho;
    echo " scope='row'>"; 
    echo "<td><div class='form-check form-check-inline'><input class='form-check-input checkbox' type='checkbox' name='matricula_alu[]' value='".$row_alu['matricula_alu']."'";
    if($query_array[0]>3){echo" disabled";}; // Se reprovado, desabilita para impedir o remanejamento;
    echo "/>".$row_alu['nome_alu']." ".$row_alu['sobrenome_alu']."</div></td>";
    if($query_array[0]>3){echo"<td>REP</td>";}else{echo"<td>APR</td>";};
    echo "</tr>";
}  
?>
