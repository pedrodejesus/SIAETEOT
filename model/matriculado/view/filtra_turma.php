<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
//include("../../../base/logatvusu.php");

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select id_turma, numero, ano_letivo from turma where numero like '%$q%'";

$rsd = mysql_query($sql);

while($rs = mysql_fetch_array($rsd)) {
	$_SESSION["sid_turma"] = $rs['id_turma'];
	echo $rs['id_turma']." - ".$rs['numero']."/".$rs['ano_letivo']."\n";
}
?>