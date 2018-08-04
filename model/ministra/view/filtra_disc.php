<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
//include("../../../base/logatvusu.php");

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select id_disc, nome_disc from disciplina where nome_disc like '%$q%'";

$rsd = mysql_query($sql);

while($rs = mysql_fetch_array($rsd)) {
	$_SESSION["sid_disc"] = $rs['id_disc'];
	echo $rs['id_disc']." - ".$rs['nome_disc']."\n";
}
?>