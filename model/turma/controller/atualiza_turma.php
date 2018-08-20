<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

$id_turma             = $_POST["id_turma"];
$numero               = $_POST["numero"];
$ano_letivo           = $_POST["ano_letivo"];
$situacao             = $_POST["situacao"];
$turno                = $_POST["turno"];
$dt_inicio            = implode("-", array_reverse(explode("/", $_POST["dt_inicio"])));
$dt_fim               = implode("-", array_reverse(explode("/", $_POST["dt_fim"])));
$id_cur               = $_POST["id_cur"];

if (empty($dt_fim)){
    $sql  = "update turma set ";
    $sql .= "numero='".$numero."', ano_letivo='".$ano_letivo."', situacao='".$situacao."', turno='".$turno."', dt_inicio='".$dt_inicio."', dt_fim= NULL, id_cur='".$id_cur."' ";
    $sql .= "where id_turma = '".$id_turma."';";
} else{
    $sql  = "update turma set ";
    $sql .= "numero='".$numero."', ano_letivo='".$ano_letivo."', situacao='".$situacao."', turno='".$turno."', dt_inicio='".$dt_inicio."', dt_fim='".$dt_fim."', id_cur='".$id_cur."' ";
    $sql .= "where id_turma = '".$id_turma."';";
}

$resultado = mysql_query($sql) or die(mysql_error());

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao); 
    header('Location: ../lista_turma.php?msg=3');
}else{
    echo $sql;
    header('Location: ../lista_turma.php?msg=4');
    //echo "Erro na atualização dos dados.<br>".$sql;
}
?>