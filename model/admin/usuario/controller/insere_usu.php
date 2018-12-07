<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$id_usu         = $_POST["id_usu"];
$nome_usu       = $_POST["nome_usu"];
$usuario        = $_POST["usuario"];
$senha          = $_POST["senha"];
$email          = $_POST["email"];
$nivel          = $_POST["nivel"];
$ativo          = $_POST["ativo"];

$sql   = "insert into usuario values ";
$sql  .= "('0', '$nome_usu', '$usuario', sha1('$senha'), '$email', '$nivel', '$ativo', now(), '1');";

$resultado = mysqli_query($conexao, $sql);

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao); 
    header('Location: ../lista_usuario.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_usuario.php?msg=2');
}


?>