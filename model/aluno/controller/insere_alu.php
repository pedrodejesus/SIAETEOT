<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$matricula_alu          = $_POST["matricula_alu"];
$nome_alu               = $_POST["nome_alu"];
$sobrenome_alu          = $_POST["sobrenome_alu"];
$cpf_alu                = $_POST["cpf_alu"];
$rg_alu                 = $_POST["rg_alu"];
$dt_nasc_alu            = implode("-", array_reverse(explode("/", $_POST["dt_nasc_alu"])));
$nome_pai               = $_POST["nome_pai"];
$nome_mae               = $_POST["nome_mae"];
$sexo_alu               = $_POST["sexo_alu"];
$tipo_alu               = $_POST["tipo_alu"];
$cep                    = $_POST["cep"];
$num_resid_alu          = $_POST["num_resid_alu"];
$complemento_alu        = $_POST["complemento_alu"];

$sql   = "insert into aluno values ";  // Adiciona os dados à tabela;
$sql  .= "('$matricula_alu', '$nome_alu', '$sobrenome_alu', '$cpf_alu', '$rg_alu', '$dt_nasc_alu', '$nome_pai', '$nome_mae', '$sexo_alu', NULL, '$tipo_alu', NULL, NULL, NULL, NULL, '$cep', '$num_resid_alu', '$complemento_alu');";

$resultado = mysql_query($sql);

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_aluno.php?msg=1');
}else{
    header('Location: ../lista_aluno.php?msg=2');
    /*echo "Erro na inserção de dados!<br>".$sql;
	echo trigger_error(mysql_error());*/
}


?>