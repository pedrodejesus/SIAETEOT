<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include "../../../base/conexao.php";
include "../../../base/logatvusu.php";

$id_usu = (int) $_GET['id_usu'];
$block_ativa = (int) $_GET['block_ativa'];

$sql  = "update usuario set ";
switch ($block_ativa){
    case 0:
        $sql .= "ativo='0' ";
        break;
    case 1:
        $sql .= "ativo='1' ";
        break;
}
$sql .= "where id_usu = '".$id_usu."';";

$resultado = mysql_query ($sql)or die(mysql_error());

if($resultado){
	$resultado2 = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql)));
    switch ($block_ativa){
    case 0:
        header('Location: ../lista_usuario.php?msg=8');
        break;
    case 1:
        header('Location: ../lista_usuario.php?msg=9');
        break;
    }
	mysql_close($conexao);
}else{
	echo "Erro ao Editar os dados:<br>".$sql;
}
?>
