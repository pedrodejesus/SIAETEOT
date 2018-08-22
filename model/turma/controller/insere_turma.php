<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$id_turma             = $_POST["id_turma"];
$numero               = $_POST["numero"];
$ano_letivo           = $_POST["ano_letivo"];
$situacao             = $_POST["situacao"];
$turno                = $_POST["turno"];
$dt_inicio            = implode("-", array_reverse(explode("/", $_POST["dt_inicio"])));
$id_cur               = $_POST["id_cur"];

$sql   = "insert into turma values ";  // Adiciona os dados à tabela;
$sql  .= "(0, '$numero', '$ano_letivo', '$situacao', '$turno', '$dt_inicio', NULL, '$id_cur');";

$resultado = mysqli_query($conexao, $sql);

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../view/cadastrar_disc_pdr.php?numero='.$numero.'&ano_letivo='.$ano_letivo);
}else{
    mysqli_close($conexao);
    header('Location: ../lista_turma.php?msg=2');
}


?>