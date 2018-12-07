<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$matricula_alu      = substr($_POST["matricula_alu"],0, strpos($_POST["matricula_alu"],' -'));
$id_turma_nova      = $_POST["id_turma"];
$ano_letivo         = $_POST["ano_letivo"];

//echo $matricula_alu."<br>".$id_turma_nova;

$sql1 = "select distinct id_turma, tipo_matricula, dt_matricula from matriculado where matricula_alu = $matricula_alu and remat = 0 limit 1";
$query1 = mysqli_query($conexao, $sql1);
$array_alu = mysqli_fetch_array($query1); //Pega o ID da turma em que o aluno está matriculado no momento;

//Deleta do boletim e da tabela matriculado os dados atuais;
$sql2 = "delete from matriculado where matricula_alu = $matricula_alu and id_turma = ".$array_alu['id_turma'];
$query2 = mysqli_query($conexao, $sql2);
$sql3 = "delete from boletim where matricula_alu = $matricula_alu and id_turma = ".$array_alu['id_turma'];
$query3 = mysqli_query($conexao, $sql3);

//Pega as disciplinas da nova turma
$sql4 = "select id_disc from disc_pdr_tur where id_turma = $id_turma_nova";
$query4 = mysqli_query($conexao, $sql4);

while ($disciplinas = mysqli_fetch_array($query4)){
    $id_disciplinas = $disciplinas['id_disc'];
    
    $sql5   = "insert into matriculado values ";
    $sql5  .= "(0, '".$array_alu['tipo_matricula']."', '".$array_alu['dt_matricula']."', '$ano_letivo', 1, 0, '$matricula_alu', '$id_turma_nova', '$id_disciplinas'); ";
    $resultado = mysqli_query($conexao, $sql5) or die(mysqli_error($conexao));
    
    $sql6 = "insert into boletim (id_boletim, matricula_alu, id_turma, id_disc) values (0, '".$matricula_alu."', '".$id_turma_nova."', '".$id_disciplinas."');";
    $resultado2 = mysqli_query($conexao, $sql6);  
}

$sql7  = "insert into transferencia_turma values ";
$sql7 .= "(0, '".date("Y-m-d")."', $matricula_alu, ".$array_alu['id_turma'].", $id_turma_nova)";
//echo $sql7;
$query5 = mysqli_query($conexao, $sql7) or die(mysqli_error($conexao));


if($resultado and $resultado2){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql5), $id_usuario));
    $registra_atv2 = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql6), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_transf_turma.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_transf_turma.php?msg=2');
}
?>