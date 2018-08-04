<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_func                = $_POST["id_func"];
$nome_func              = mb_strtoupper($_POST["nome_func"], $encoding);
$sobrenome_func         = mb_strtoupper($_POST["sobrenome_func"], $encoding);
$cpf_func               = $_POST["cpf_func"];
$rg_func                = $_POST["rg_func"];
$dt_nasc_func           = implode("-", array_reverse(explode("/", $_POST["dt_nasc_func"])));
$cep                    = $_POST["cep"];
$num_resid_func         = $_POST["num_resid_func"];
$complemento_func       = $_POST["complemento_func"];
$id_setor               = $_POST["id_setor"];

$sql  = "update funcionario set ";
$sql .= "id_func='".$id_func."', nome_func='".$nome_func."', sobrenome_func='".$sobrenome_func."', cpf_func='".$cpf_func."', rg_func='".$rg_func."', dt_nasc_func='".$dt_nasc_func."', cep='".$cep."', num_resid_func='".$num_resid_func."', complemento_func='".$complemento_func."', id_setor='".$id_setor."' ";
$sql .= "where id_func = '".$id_func."';";

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao); 
    header('Location: ../lista_funcionario.php?msg=3');
}else{
    header('Location: ../lista_funcionario.php?msg=4');
    //echo "Erro na atualização dos dados.<br>".$sql;
}
?>