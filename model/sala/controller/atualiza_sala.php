<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_sala       = (int) @$_GET['id_sala'];
$nome_sala      = mb_strtoupper($_POST["nome_sala"], $encoding);
$situacao       = mb_strtoupper($_POST["situacao"], $encoding);
$capacidade     = $_POST["capacidade"];
$tipo           = mb_strtoupper($_POST["tipo"], $encoding);

$sql  = "update sala set ";
$sql .= "nome_sala='".$nome_sala."', situacao='".$situacao."', capacidade='".$capacidade."', tipo='".$tipo."' ";
$sql .= "where id_sala = '".$id_sala."';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao); 
    header('Location: ../lista_sala.php?msg=3');
}else{
    mysql_close($conexao); 
    header('Location: ../lista_sala.php?msg=4');
    //echo "Erro na atualização dos dados.<br>".$sql;
}
?>