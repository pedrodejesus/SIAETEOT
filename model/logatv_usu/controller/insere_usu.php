<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$id_usu         = $_POST["id_usu"];
$nome_usu       = $_POST["nome_usu"];
$usuario        = $_POST["usuario"];
$senha          = $_POST["senha"];
$email          = $_POST["email"];
$nivel          = $_POST["nivel"];
$ativo          = $_POST["ativo"];
//$dt_cadastro    = implode("-", array_reverse(explode("/", $_POST["dt_cadastro"])));


$sql   = "insert into usuario values ";  // Adiciona os dados à tabela;
$sql  .= "('0', '$nome_usu', '$usuario', sha1('$senha'), '$email', '$nivel', '$ativo', now(), '1');";

$resultado = mysql_query($sql);

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao); 
    header('Location: ../lista_usuario.php?msg=1');
}else{
    mysql_close($conexao);
    header('Location: ../lista_usuario.php?msg=2');
    /*echo "Erro na inserção de dados!<br>".$sql;
	echo trigger_error(mysql_error());*/
}


?>