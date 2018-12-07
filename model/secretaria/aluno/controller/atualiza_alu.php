<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$matricula_alu       = $_POST["matricula_alu"];
$nome_alu            = mb_strtoupper($_POST["nome_alu"], $encoding);
$sobrenome_alu       = mb_strtoupper($_POST["sobrenome_alu"], $encoding);
$cpf_alu             = $_POST["cpf_alu"];
$dt_nasc_alu         = implode("-", array_reverse(explode("/", $_POST["dt_nasc_alu"])));
$nome_pai            = mb_strtoupper($_POST["nome_pai"], $encoding);
$nome_mae            = mb_strtoupper($_POST["nome_mae"], $encoding);
$sexo_alu            = $_POST["sexo_alu"];
$cep                 = $_POST["cep"];
$num_resid_alu       = $_POST["num_resid_alu"];
$complemento_alu     = $_POST["complemento_alu"];
$tipo_alu            = $_POST["tipo_alu"];

//Documentos
$certidao_tipo       = $_POST['certidao_tipo'];
$certidao_termo      = $_POST['certidao_termo'];
$certidao_circ       = $_POST['certidao_circ'];
$certidao_livro      = $_POST['certidao_livro'];
$certidao_folha      = $_POST['certidao_folha'];
$certidao_cidade     = $_POST['certidao_cidade'];
$certidao_uf         = $_POST['certidao_uf'];
$identidade_rg       = $_POST['identidade_rg']; 
if(empty($_POST['identidade_dt_exp'])){
    $identidade_dt_exp = 'NULL';
}else{
    $identidade_dt_exp = implode("-", array_reverse(explode("/", $_POST["identidade_dt_exp"])));
}
$identidade_dt_exp   = $_POST['identidade_dt_exp']; 
$identidade_org_exp  = $_POST['identidade_org_exp']; 
$naturalidade        = $_POST['naturalidade']; 

$sql  = "update aluno set ";
$sql .= "matricula_alu='".$matricula_alu."', nome_alu='".$nome_alu."', sobrenome_alu='".$sobrenome_alu."', cpf_alu='".$cpf_alu."', dt_nasc_alu='".$dt_nasc_alu."', nome_pai='".$nome_pai."', nome_mae='".$nome_mae."', sexo_alu='".$sexo_alu."', num_resid_alu='".$num_resid_alu."', complemento_alu='".$complemento_alu."', cep='".$cep."', tipo_alu='".$tipo_alu."' ";
$sql .= "where matricula_alu = '".$matricula_alu."';";

$sql2  = "update aluno_doc set ";
$sql2 .= "certidao_tipo='$certidao_tipo', certidao_termo='$certidao_termo', certidao_circ='$certidao_circ', certidao_livro='$certidao_livro', certidao_folha='$certidao_folha', ";
$sql2 .= "certidao_cidade='$certidao_cidade', certidao_uf='$certidao_uf', identidade_rg='$identidade_rg', identidade_dt_exp='$identidade_dt_exp', ";
$sql2 .= "identidade_org_exp='$identidade_org_exp', naturalidade='$naturalidade' where matricula_alu= $matricula_alu";

$resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
$resultado2 = mysqli_query($conexao, $sql2) or die(mysqli_error($conexao));

if($resultado and $resultado2){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao); 
    header('Location: ../lista_aluno.php?msg=3');
}else{
    mysqli_close($conexao); 
    header('Location: ../lista_aluno.php?msg=4');
}
?>