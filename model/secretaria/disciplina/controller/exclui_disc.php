<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$id_disc = (int) @$_GET['id_disc'];
$sql = "delete from disciplina where id_disc = '$id_disc';";
$resultado = mysqli_query($conexao, $sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysqli_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_disciplina.php?msg=5');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_disciplina.php?msg=6');
}

?>