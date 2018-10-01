<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$nome_setor     = mb_strtoupper($_POST["nome_setor"], $encoding);

$sql   = "insert into setor values ";
$sql  .= "('0', '$nome_setor');";

$resultado = mysql_query($sql);

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_setor.php?msg=1');
}else{
    mysql_close($conexao);
    header('Location: ../lista_setor.php?msg=2');
}
?>