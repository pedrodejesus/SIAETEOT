<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$id_setor = (int) @$_GET['id_setor'];
$sql = "delete from setor where id_setor = '$id_setor';";
$resultado = mysqli_query($conexao, $sql);

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_setor.php?msg=5');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_setor.php?msg=6');
}
?>