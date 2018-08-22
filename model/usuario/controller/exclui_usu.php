<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$id_usu = (int) @$_GET['id_usu'];
$sql = "delete from usuario where id_usu = '$id_usu';";
$resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_usuario.php?msg=5');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_usuario.php?msg=6');
}

?>