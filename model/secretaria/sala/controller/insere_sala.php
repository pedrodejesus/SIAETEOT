<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$nome_sala      = mb_strtoupper($_POST["nome_sala"], $encoding);
$situacao       = mb_strtoupper($_POST["situacao"], $encoding);
$capacidade     = $_POST["capacidade"];
$tipo           = mb_strtoupper($_POST["tipo"], $encoding);

$sql   = "insert into sala values ";  // Adiciona os dados à tabela;
$sql  .= "('0', '$nome_sala', '$situacao', '$capacidade', '$tipo');";

$resultado = mysql_query($sql);

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_sala.php?msg=1');
}else{
    header('Location: ../lista_sala.php?msg=2');
    /*echo "Erro na inserção de dados!<br>".$sql;
	echo trigger_error(mysql_error());*/
}


?>