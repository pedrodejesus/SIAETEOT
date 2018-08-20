<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_disc          = $_POST["id_disc"];
$nome_disc        = mb_strtoupper($_POST["nome_disc"], $encoding);
$sigla_disc       = mb_strtoupper($_POST["sigla_disc"], $encoding);
$id_cur           = $_POST["id_cur"];

$sql  = "update disciplina set ";
$sql .= "nome_disc='".$nome_disc."', sigla_disc='".$sigla_disc."', id_cur='".$id_cur."' ";
$sql .= "where id_disc = '".$id_disc."';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao); 
    header('Location: ../lista_disciplina.php?msg=3');
}else{
    mysql_close($conexao); 
    header('Location: ../lista_disciplina.php?msg=4');
}
?>