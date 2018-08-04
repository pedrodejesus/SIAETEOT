<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_cargo          = $_POST["id_cargo"];
$nome_cargo        = mb_strtoupper($_POST["nome_cargo"], $encoding);

$sql  = "update cargo set ";
$sql .= "nome_cargo='".$nome_cargo."' ";
$sql .= "where id_cargo = '".$id_cargo."';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao); 
    header('Location: ../lista_cargo.php?msg=3');
}else{
    echo $sql;
    //header('Location: ../lista_disciplina.php?msg=4');
    //echo "Erro na atualização dos dados.<br>".$sql;
}
?>