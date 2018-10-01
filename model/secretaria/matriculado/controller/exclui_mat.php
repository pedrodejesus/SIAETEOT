<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$matricula_alu = (int) @$_GET['matricula_alu'];

$sql = "delete from aluno where matricula_alu = '$matricula_alu';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_aluno.php?msg=5');
}else{
    header('Location: ../lista_aluno.php?msg=6');
}

?>