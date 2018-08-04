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

$sql  = "update responsavel set ";
$sql .= "id_resp='".$id_resp."', nome_resp='".$nome_resp."', sobrenome_resp='".$sobrenome_resp."', cpf_resp='".$cpf_resp."', rg_resp='".$rg_resp."', cel_resp='".$cel_resp."', tel_resp='".$tel_resp."', email_resp='".$email_resp."', matricula_alu='".$matricula_alu."' ";
$sql .= "where id_resp = '".$id_resp."';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao); 
    header('Location: ../lista_responsavel.php?msg=3');
}else{
    header('Location: ../lista_responsavel.php?msg=4');
    //echo "Erro na atualização dos dados.<br>".$sql;
}
?>