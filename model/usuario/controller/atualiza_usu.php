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

$resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao); 
    header('Location: ../lista_usuario.php?msg=3');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_usuario.php?msg=4');
}
?>