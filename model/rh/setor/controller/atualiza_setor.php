<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_setor          = $_POST["id_setor"];
$nome_setor        = mb_strtoupper($_POST["nome_setor"], $encoding);

$sql  = "update setor set ";
$sql .= "nome_setor='".$nome_setor."' ";
$sql .= "where id_setor = '".$id_setor."';";

$resultado = mysqli_query($conexao, $sql);

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao); 
    header('Location: ../lista_setor.php?msg=3');
}else{
    mysqli_close($conexao); 
    header('Location: ../lista_disciplina.php?msg=4');
}
?>