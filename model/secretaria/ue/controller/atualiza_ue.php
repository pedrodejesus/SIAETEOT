<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_ue          = $_POST["id_ue"];
$nome_ue        = mb_strtoupper($_POST["nome_ue"], $encoding);
$tel_ue        = $_POST["tel_ue"];

$sql  = "update unidade_estudantil set ";
$sql .= "nome_ue='".$nome_ue."', tel_ue='".$tel_ue."' ";
$sql .= "where id_ue = '".$id_ue."';";

$resultado = mysqli_query($conexao, $sql) or die(mysql_error($conexao));

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao); 
    header('Location: ../lista_ue.php?msg=3');
}else{
    mysqli_close($conexao); 
    header('Location: ../lista_disciplina.php?msg=4');
}
?>