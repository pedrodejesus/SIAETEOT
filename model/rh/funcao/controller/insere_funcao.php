<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$nome_funcao    = mb_strtoupper($_POST["nome_funcao"], $encoding);

$sql   = "insert into funcao values ";
$sql  .= "('0', '$nome_funcao');";
$resultado = mysqli_query($conexao, $sql);

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_funcao.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_funcao.php?msg=2');
}


?>