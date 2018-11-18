<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$id_turma = $_GET['id_turma'];
$id_disc =  $_GET['id_disc'];

$sql1 = "delete from disc_pdr_tur where id_turma = $id_turma and id_disc = $id_disc;";
$sql2 = "delete from boletim where id_turma = $id_turma and id_disc = $id_disc;";
$sql3 = "delete from matriculado where id_turma = $id_turma and id_disc = $id_disc;";

$resultado1 = mysqli_query($conexao, $sql1);
$resultado2 = mysqli_query($conexao, $sql2);
$resultado3 = mysqli_query($conexao, $sql3);


if($resultado1 && $resultado2 && $resultado3){
    //$registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../view/visualizar_turma.php?id_turma='.$id_turma);
}else{
    header('Location: ../view/visualizar_turma.php?id_turma='.$id_turma);
}

?>