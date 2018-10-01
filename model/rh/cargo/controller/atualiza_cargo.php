<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_cargo          = $_POST["id_cargo"];
$nome_cargo        = mb_strtoupper($_POST["nome_cargo"], $encoding);

$sql  = "update cargo set ";
$sql .= "nome_cargo='".$nome_cargo."' ";
$sql .= "where id_cargo = '".$id_cargo."';";
$resultado = mysqli_query($conexao, $sql);

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao); 
    header('Location: ../lista_cargo.php?msg=3');
}else{
    mysqli_close($conexao); 
    header('Location: ../lista_cargo.php?msg=4');
}
?>