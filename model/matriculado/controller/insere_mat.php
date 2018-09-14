<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$matricula_alu      = substr($_POST["matricula_alu"],0, strpos($_POST["matricula_alu"],' -'));
$id_turma			= $_POST["id_turma"];
$ano_letivo         = $_POST["ano_letivo"];
$tipo_matricula     = $_POST["tipo_matricula"];
//$dt_matricula       = implode("-", array_reverse(explode("/", $_POST["dt_matricula"]))); (Retorna 2018 -10-10)
$dt_matricula = date('Y-m-d');

$sql = "select id_disc from disc_pdr_tur where id_turma = '".$id_turma."';";
$consulta = mysqli_query($conexao, $sql);

while ($disciplinas = mysqli_fetch_array($consulta)){
    $id_disciplinas = $disciplinas['id_disc'];
    
    $sql2   = "insert into matriculado values ";
    $sql2  .= "(0, '$tipo_matricula', '$dt_matricula', '$ano_letivo', 1, 0, '$matricula_alu', '$id_turma', '$id_disciplinas'); ";
    $resultado = mysqli_query($conexao, $sql2) or die(mysqli_error($conexao));
    
    $sql3 = "insert into boletim (id_boletim, matricula_alu, id_turma, id_disc) values (0, '".$matricula_alu."', '".$id_turma."', '".$id_disciplinas."');";
    $resultado2 = mysqli_query($conexao, $sql3);  
}

if($resultado && $resultado2){
    //$registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_matriculado.php?msg=1');
}else{
    //echo $sql2;
    //*echo "Erro na inserção de dados!<br>".$sql;
	//echo trigger_error(mysql_error());
}


?>