<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$id_func = (int) @$_GET['id_func'];

$sql = "delete from funcionario where id_func = '$id_func';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_funcionario.php?msg=5');
}else{
    header('Location: ../lista_funcionario.php?msg=6');
}

?>