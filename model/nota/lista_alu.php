<?php 
include "../../base/conexao.php";

$id_turma = $_GET['id_turma'];
$id_disc = $_GET['id_disc'];

$sql  = "select distinct m.matricula_alu, m.id_turma, m.id_disc, ";
$sql .= "a.matricula_alu, a.nome_alu, a.sobrenome_alu, ";
$sql .= "t.id_turma, t.numero, t.ano_letivo, ";
$sql .= "d.id_disc, d.nome_disc ";
$sql .= "from matriculado m, aluno a, turma t, disciplina d ";
$sql .= "where m.matricula_alu = a.matricula_alu ";
$sql .= "and m.id_turma = t.id_turma ";
$sql .= "and m.id_disc = d.id_disc ";
$sql .= "and t.id_turma = '".$id_turma."' ";
$sql .= "and m.id_disc = '".$id_disc."' ";
$sql .= "order by nome_alu asc;";
$query = mysqli_query($conexao, $sql); 

$cont_nota = 1;
$cont_rec = 1;
$cont_resp = 1;
$num_chamada_prov = 1;
while($row_alu = mysqli_fetch_array($query)){ 
    $sql_check  = "select a.matricula_alu, a.nome_alu, a.sobrenome_alu, ";
    $sql_check .= "t.id_turma, t.numero, t.ano_letivo, ";
    $sql_check .= "d.id_disc, d.nome_disc, ";
    $sql_check .= "b.matricula_alu, b.id_turma, b.id_disc ";
    $sql_check .= "from aluno a, turma t, disciplina d, boletim b ";
    $sql_check .= "where b.matricula_alu = a.matricula_alu ";
    $sql_check .= "and b.id_turma = t.id_turma ";
    $sql_check .= "and b.id_disc = d.id_disc ";
    $sql_check .= "and b.matricula_alu = '".$row_alu['matricula_alu']."' ";
    $sql_check .= "and b.id_turma = '".$id_turma."' ";
    $sql_check .= "and b.id_disc = '".$id_disc."' ";
    
    $query_check = mysqli_query($conexao, $sql_check);
    $query_rows = mysqli_num_rows($query_check);
    
    if($query_rows == 0){
        $sql_insert = "insert into boletim (id_boletim, matricula_alu, id_turma, id_disc) values (0, '".$row_alu['matricula_alu']."', '".$id_turma."', '".$id_disc."');";
        $query_insert = mysqli_query($conexao, $sql_insert);
    }
    
    echo "<tr scope='row'>"; 
    echo "<td>".$row_alu['matricula_alu']."</td>"; 
    echo "<td>".$num_chamada_prov++."</td>"; 
    echo "<td>".$row_alu['nome_alu']." ".$row_alu['sobrenome_alu']."</td>"; 
    echo "<td><input class='form-control form-control-sm' type='text' maxlength='4' id='nota".$cont_nota++."' name='nota[]' /></td>";
    echo "<td><input class='form-control form-control-sm' type='text' maxlength='4' id='recu".$cont_rec++."' name='rec[]' readonly /></td>";
    echo "<td id='resp".$cont_resp++."' ></td>"; 
    echo "<td><input type='hidden' name='matricula_alu[]' id='matricula_alu[]' value='".$row_alu['matricula_alu']."' /></td>";
    echo "</tr>"; 
    
}  
?>
