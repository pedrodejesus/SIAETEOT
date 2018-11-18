<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$matricula_alu      = substr($_POST["matricula_alu"],0, strpos($_POST["matricula_alu"],' -'));
$id_turma_nova      = $_POST["id_turma"];

echo $matricula_alu."<br>".$id_turma;

/*$sql1 = "select distinct id_turma from matriculado where matricula_alu = $matricula_alu and remat = 0 limit 1";
$query1 = mysqli_query($conexao, $sql1);
$id_turma_antiga = mysqli_fetch_array($query_1);

$sql2 = "delete from matriculado where matricula_alu = $matricula_alu and id_turma = $id_turma_antiga";
$query2 = mysqli_query($conexao, $sql2);
$sql3 = "delete from boletim where matricula_alu = $matricula_alu and id_turma = $id_turma_antiga";
$query3 = mysqli_query($conexao, $sql3);

$sql4 = "select id_disc from disc_pdr_tur where id_turma = $id_turma_nova";
$query4 = mysqli_query($conexao, $sql4);

while ($disciplinas = mysqli_fetch_array($query4)){
    $id_disciplinas = $disciplinas['id_disc'];
    
    $sql5   = "insert into matriculado values ";
    $sql5  .= "(0, '$tipo_matricula', '$dt_matricula', '$ano_letivo', 1, 0, '$matricula_alu', '$id_turma', '$id_disciplinas'); ";
    $resultado = mysqli_query($conexao, $sql2) or die(mysqli_error($conexao));
    
    $sql3 = "insert into boletim (id_boletim, matricula_alu, id_turma, id_disc) values (0, '".$matricula_alu."', '".$id_turma."', '".$id_disciplinas."');";
    $resultado2 = mysqli_query($conexao, $sql3);  
}*/

/*
if($resultado && $resultado2){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    $registra_atv2 = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql2), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_transf_ue.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_transf_ue.php?msg=2');
}*/
?>