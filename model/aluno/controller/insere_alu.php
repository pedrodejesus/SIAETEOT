<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$matricula_alu       = $_POST["matricula_alu"];
$nome_alu            = mb_strtoupper($_POST["nome_alu"], $encoding);
$sobrenome_alu       = mb_strtoupper($_POST["sobrenome_alu"], $encoding);
$cpf_alu             = $_POST["cpf_alu"];
$rg_alu              = $_POST["rg_alu"];
$dt_nasc_alu         = implode("-", array_reverse(explode("/", $_POST["dt_nasc_alu"])));
$nome_pai            = mb_strtoupper($_POST["nome_pai"], $encoding);
$nome_mae            = mb_strtoupper($_POST["nome_mae"], $encoding);
$sexo_alu            = $_POST["sexo_alu"];
$cep                 = $_POST["cep"];
$num_resid_alu       = $_POST["num_resid_alu"];
$complemento_alu     = $_POST["complemento_alu"];
$tipo_alu            = $_POST["tipo_alu"];

$sql  = "insert into aluno values ";
$sql .= "('$matricula_alu', '$nome_alu', '$sobrenome_alu', '$cpf_alu', '$rg_alu', '$dt_nasc_alu', '$nome_pai', '$nome_mae', '$sexo_alu', NULL, '$tipo_alu', NULL, NULL, NULL, NULL, '$cep', '$num_resid_alu', '$complemento_alu');";

$resultado = mysqli_query($conexao, $sql);

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_aluno.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_aluno.php?msg=2');
}
?>