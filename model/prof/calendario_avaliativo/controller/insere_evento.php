<?php
if (!isset($_SESSION)) session_start();
include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$dt_evento = implode("-", array_reverse(explode("/", $_POST["dt_evento"])));
$tipo = $_POST['tipo'];
$cor = $_POST['cor'];
$id_disc = $_POST['id_disc'];
$id_turma = $_POST['id_turma'];
$descricao = $_POST['descricao'];

//echo $dt_evento."<br>".$tipo."<br>".$cor."<br>".$id_disc."<br>".$id_turma."<br>".$descricao;

$sql  = "insert into evento_avaliativo values ";
$sql .= "(0, '$dt_evento', $tipo, '$cor', '$descricao', ".$_SESSION['FuncID'].", $id_disc, $id_turma);";
//echo $sql;
$resultado = mysqli_query($conexao, $sql);

if($resultado){
    //$registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../calendario_avaliativo.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../calendario_avaliativo.php?msg=2');
}