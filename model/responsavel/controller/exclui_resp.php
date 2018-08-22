<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$id_resp = (int) @$_GET['id_resp'];
$sql = "delete from responsavel where id_resp = '$id_resp';";
$resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_responsavel.php?msg=5');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_responsavel.php?msg=6');
}

?>