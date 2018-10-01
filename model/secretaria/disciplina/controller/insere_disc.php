<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$nome_disc        = mb_strtoupper($_POST["nome_disc"], $encoding);
$sigla_disc       = mb_strtoupper($_POST["sigla_disc"], $encoding);
$id_cur         = $_POST["id_cur"];

$sql   = "insert into disciplina values ";  // Adiciona os dados à tabela;
$sql  .= "('0', '$nome_disc', '$sigla_disc', '$id_cur');";

$resultado = mysqli_query($conexao, $sql);

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_disciplina.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_aluno.php?msg=2');
}


?>