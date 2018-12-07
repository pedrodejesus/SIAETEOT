<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$id_trans = $_GET['id_trans'];
$sql = "delete from transferencia_turma where id_trans = '$id_trans';";
$resultado = mysqli_query($conexao, $sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_transf_turma.php?msg=5');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_transf_turma.php?msg=6');
}

?>