<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$id_usu         = $_POST["id_usu"];
$nome_usu       = $_POST["nome_usu"];
$usuario        = $_POST["usuario"];
$email          = $_POST["email"];
$nivel          = $_POST["nivel"];

$sql  = "update usuario set ";
$sql .= "nome_usu='".$nome_usu."', usuario='".$usuario."', email='".$email."', nivel='".$nivel."' ";
$sql .= "where id_usu = '".$id_usu."';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao); 
    header('Location: ../lista_usuario.php?msg=3');
}else{
    mysql_close($conexao);
    header('Location: ../lista_usuario.php?msg=4');
    /*echo "Erro na atualização dos dados.<br>".$sql;*/
}
?>