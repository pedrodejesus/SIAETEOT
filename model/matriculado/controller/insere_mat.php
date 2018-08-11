<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$matricula_alu      = substr($_POST["matricula_alu"],0, strpos($_POST["matricula_alu"],' -'));
$id_turma			= substr($_POST["id_turma"],0, strpos($_POST["id_turma"],' -'));
$ano_letivo         = $_POST["ano_letivo"];
$tipo_matricula     = $_POST["tipo_matricula"];
//$dt_matricula       = implode("-", array_reverse(explode("/", $_POST["dt_matricula"]))); (Retorna 2018 -10-10)
$dt_matricula = date('Y-m-d');

$sql = "select id_disc from disc_pdr_tur where id_turma = '".$id_turma."';";
$consulta = mysql_query($sql);

while ($disciplinas = mysql_fetch_array($consulta)){
    
    $id_disciplinas = $disciplinas['id_disc'];
    
    $sql2   = "insert into matriculado values ";
    $sql2  .= "(0, '$tipo_matricula', '$dt_matricula', '$ano_letivo', '$matricula_alu', '$id_turma', '$id_disciplinas'); ";
    
    $resultado = mysql_query($sql2);
}

if($resultado){
    //$registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    header('Location: ../lista_matriculado.php?msg=1');
}else{
    echo $sql2;
    //*echo "Erro na inserção de dados!<br>".$sql;
	//echo trigger_error(mysql_error());
}


?>