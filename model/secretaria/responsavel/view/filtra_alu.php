<?php

session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
//include("../../../base/logatvusu.php");

$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select matricula_alu, nome_alu, sobrenome_alu from aluno where nome_alu like '%$q%' or sobrenome_alu like '%$q%'";

$rsd = mysqli_query($conexao, $sql);

while($rs = mysqli_fetch_array($rsd)) {
	$_SESSION["smatricula_alu"] = $rs['matricula_alu'];
	echo $rs['matricula_alu']." - ".$rs['nome_alu']." ".$rs['sobrenome_alu']."\n";
}
?>