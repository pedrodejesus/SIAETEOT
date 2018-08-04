<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$id_setor = (int) @$_GET['id_setor'];

$sql = "delete from setor where id_setor = '$id_setor';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_setor.php?msg=5');
}else{
    header('Location: ../lista_setor.php?msg=6');
}

?>