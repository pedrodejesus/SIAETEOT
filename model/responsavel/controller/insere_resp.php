<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_resp            = $_POST["id_resp"];
$nome_resp          = mb_strtoupper($_POST["nome_resp"], $encoding);
$sobrenome_resp     = mb_strtoupper($_POST["sobrenome_resp"], $encoding);
$cpf_resp           = $_POST["cpf_resp"];
$rg_resp            = $_POST["rg_resp"];
$cel_resp           = $_POST["cel_resp"];
$tel_resp           = $_POST["tel_resp"];
$email_resp         = $_POST["email_resp"];
$matricula_alu      = substr($_POST["matricula_alu"],0, strpos($_POST["matricula_alu"],' -'));

$sql   = "insert into responsavel values ";
$sql  .= "('0', '$nome_resp', '$sobrenome_resp', '$cpf_resp', '$rg_resp', '$cel_resp', '$tel_resp', '$email_resp', '$matricula_alu');";

$resultado = mysqli_query($conexao, $sql);
if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_responsavel.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_responsavel.php?msg=2');
}


?>