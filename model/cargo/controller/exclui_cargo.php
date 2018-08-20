<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$id_cargo = (int) @$_GET['id_cargo'];
$sql = "delete from cargo where id_cargo = '$id_cargo';";
$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_cargo.php?msg=5');
}else{
    mysql_close($conexao);
    header('Location: ../lista_cargo.php?msg=6');
}

?>