<?php
include "../../base/conexao.php";
 
$id_turma = $_GET['id_turma'];
$sql  = "select dpt.id_disc_pdr_turma, dpt.id_turma, dpt.id_disc, ";
$sql .= "d.id_disc, d.nome_disc, d.sigla_disc ";
$sql .= "from disc_pdr_tur dpt, disciplina d ";
$sql .= "where dpt.id_disc = d.id_disc ";
$sql .= "and id_turma = '".$id_turma."';";
      
$query = mysqli_query($conexao, $sql);
 
while($data_disc = mysqli_fetch_array($query)){
    echo "<option value='".$data_disc['id_disc']."'>".$data_disc['nome_disc']."</option>";
} 
?>