<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$nome_ue        = mb_strtoupper($_POST["nome_ue"], $encoding);
$tel_ue        = $_POST["tel_ue"];

$sql   = "insert into unidade_estudantil values ";
$sql  .= "('0', '$nome_ue', '$tel_ue');";

$resultado = mysql_query($sql);

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_ue.php?msg=1');
}else{
    mysql_close($conexao);
    header('Location: ../lista_ue.php?msg=2');
}
?>