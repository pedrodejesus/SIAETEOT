<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_funcao          = $_POST["id_funcao"];
$nome_funcao        = mb_strtoupper($_POST["nome_funcao"], $encoding);

$sql  = "update funcao set ";
$sql .= "nome_funcao='".$nome_funcao."' ";
$sql .= "where id_funcao = '".$id_funcao."';";

$resultado = mysqli_query($conexao, $sql);

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao); 
    header('Location: ../lista_funcao.php?msg=3');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_funcao.php?msg=4');
}
?>