<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$nome_cargo        = mb_strtoupper($_POST["nome_cargo"], $encoding);

$sql   = "insert into cargo values ";  // Adiciona os dados à tabela;
$sql  .= "('0', '$nome_cargo');";
$resultado = mysqli_query($conexao, $sql);

if($resultado){
    $registra_atv = mysqli_query($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario)) or die(mysqli_error($conexao));
    mysqli_close($conexao);
    header('Location: ../lista_cargo.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_cargo.php?msg=2');
}
?>