<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_disc          = $_POST["id_disc"];
$nome_disc        = mb_strtoupper($_POST["nome_disc"], $encoding);
$sigla_disc       = mb_strtoupper($_POST["sigla_disc"], $encoding);
$ch               = $_POST["ch"];
$id_cur           = $_POST["id_cur"];

$sql  = "update disciplina set ";
$sql .= "nome_disc='".$nome_disc."', sigla_disc='".$sigla_disc."', ch='".$ch."', id_cur='".$id_cur."' ";
$sql .= "where id_disc = '".$id_disc."';";

$resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao); 
    header('Location: ../lista_disciplina.php?msg=3');
}else{
    mysqli_close($conexao); 
    header('Location: ../lista_disciplina.php?msg=4');
}
?>