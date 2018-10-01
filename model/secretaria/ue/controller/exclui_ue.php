<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$id_ue = (int) @$_GET['id_ue'];
$sql = "delete from unidade_estudantil where id_ue = '$id_ue';";
$resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_ue.php?msg=5');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_ue.php?msg=6');
}

?>