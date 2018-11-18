<?php
if (!isset($_SESSION)) session_start();
include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$id_evento = $_GET['id_evento'];

$sql  = "delete from evento_avaliativo where id_evento_av = $id_evento ";
//$sql .= "(0, '$dt_evento', $tipo, '$cor', '$descricao', ".$_SESSION['FuncID'].", $id_disc, $id_turma);";
//echo $sql;
$resultado = mysqli_query($conexao, $sql);

if($resultado){
    //$registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../calendario_avaliativo.php?msg=3');
}else{
    mysqli_close($conexao);
    header('Location: ../calendario_avaliativo.php?msg=4');
}