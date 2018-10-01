<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_setor          = $_POST["id_setor"];
$nome_setor        = mb_strtoupper($_POST["nome_setor"], $encoding);

$sql  = "update setor set ";
$sql .= "nome_setor='".$nome_setor."' ";
$sql .= "where id_setor = '".$id_setor."';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao); 
    header('Location: ../lista_setor.php?msg=3');
}else{
    mysql_close($conexao); 
    header('Location: ../lista_disciplina.php?msg=4');
}
?>