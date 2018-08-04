<?php

session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
//include("../../../base/logatvusu.php");

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select id_func, nome_func from funcionario where nome_func like '%$q%'";

$rsd = mysql_query($sql);

while($rs = mysql_fetch_array($rsd)) {
	$_SESSION["sid_func"] = $rs['id_func'];
	echo $rs['id_func']." - ".$rs['nome_func']."\n";
}
?>