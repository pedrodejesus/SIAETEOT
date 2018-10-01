<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$num_processo        = $_POST["num_processo"];
$dt_trans            = date('Y-m-d');
$matricula_alu       = substr($_POST["matricula_alu"],0, strpos($_POST["matricula_alu"],' -'));
$id_ue               = $_POST["id_ue"];

$sql  = "insert into transferencia_ue values ";
$sql .= "(0, '$num_processo', '$dt_trans', $matricula_alu, $id_ue);";
echo $sql."<br>";
$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));

$sql2 = "update aluno set situacao = 5 where matricula_alu = $matricula_alu;";
$resultado2 = mysqli_query($conexao, $sql2) or die (mysqli_error($conexao));
echo $sql2;

if($resultado && $resultado2){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    $registra_atv2 = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql2), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_transf_ue.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_transf_ue.php?msg=2');
}
?>