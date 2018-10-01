<?php
include '../../../base/conexao.php';

$id_turma = (int) $_GET['id_turma'];
$ano_letivo = (int) $_GET['ano_letivo'];
$proximo_ano_letivo = $ano_letivo + 1;

$sql  = "select distinct m.matricula_alu, m.id_turma, m.remat, ";
$sql .= "a.matricula_alu, a.nome_alu, a.sobrenome_alu, ";
$sql .= "t.id_turma, t.numero, t.ano_letivo, t.situacao, t.turno, t.dt_inicio, t.dt_fim, t.id_cur ";
$sql .= "from matriculado m, aluno a, turma t ";
$sql .= "where m.matricula_alu = a.matricula_alu ";
$sql .= "and m.id_turma = t.id_turma  ";
$sql .= "and t.id_turma = '".$id_turma."' order by nome_alu asc, sobrenome_alu asc;";
$query = mysqli_query($conexao, $sql);

while($alunos = mysqli_fetch_array($query)){
    $sql_check = "call select_checa_ape(".$alunos['matricula_alu'].", ".$id_turma.");";
    $query_check = mysqli_query($conexao, $sql_check) or die(mysqli_error($conexao));
    $query_array = mysqli_fetch_array($query_check);
    mysqli_next_result($conexao);
    
    $sql_mat = "select * from matriculado where ano_letivo = $proximo_ano_letivo and matricula_alu = ".$alunos['matricula_alu'];
    $query_mat = mysqli_query($conexao, $sql_mat);
    $rows_mat = mysqli_num_rows($query_mat);
    
    if($query_array[0]>3){
        echo "<tr scope'row'><td>".$alunos['matricula_alu']."</td>";
        echo "<td>".$alunos['nome_alu']." ".$alunos['sobrenome_alu']."</td>";
        echo "<td>";
        if($rows_mat == 0){
            echo "Não rematriculado";
        }else{
            echo "Rematriculado";
        }
        echo "</td>";
        echo "<td><div class='btn-group btn-group-sm' role='group'>
                <a class='btn btn-success' href='visualizar_ape.php?matricula_alu=".$alunos['matricula_alu']."&id_turma=".$id_turma."'><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                            
                <a class='btn btn-primary' href='rel/declaracao.php?matricula_alu='".$alunos['matricula_alu']."'><i class='far fa-arrow-right'></i>&nbsp; Matricular</a>
               </div>
              </td></tr>";
    }
}

?>