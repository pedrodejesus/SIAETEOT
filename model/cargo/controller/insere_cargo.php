<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$nome_cargo        = mb_strtoupper($_POST["nome_cargo"], $encoding);

$sql   = "insert into cargo values ";  // Adiciona os dados à tabela;
$sql  .= "('0', '$nome_cargo');";

$resultado = mysql_query($sql);

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_cargo.php?msg=1');
}else{
    header('Location: ../lista_cargo.php?msg=2');
    /*echo "Erro na inserção de dados!<br>".$sql;
	echo trigger_error(mysql_error());*/
}


?>