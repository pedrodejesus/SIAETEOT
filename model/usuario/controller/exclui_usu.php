<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$id_usu = (int) @$_GET['id_usu'];

$sql = "delete from usuario where id_usu = '$id_usu';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_usuario.php?msg=5');
}else{
    mysql_close($conexao);
    header('Location: ../lista_usuario.php?msg=6');
}

?>