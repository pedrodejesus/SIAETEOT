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
//$checkbox             = $_POST["checkbox"];

$sql   = "insert into turma values ";  // Adiciona os dados à tabela;
$sql  .= "(0, '$numero', '$ano_letivo', '$situacao', '$turno', '$dt_inicio', NULL, '$id_cur');";

$resultado = mysql_query($sql);

/*while($checkbox = $_POST["checkbox"]){
    $sql2   = "insert into disc_pdr_turma values ";  // Adiciona os dados à tabela;
    $sql2  .= "(0, '$id_turma', '$checkbox');";
    $resultado2 = mysql_query($sql);
}*/

if($resultado){
    $registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysql_close($conexao);
    //header('Location: ../lista_turma.php?msg=1');
    header('Location: ../view/cadastrar_disc_pdr.php?numero='.$numero.'&ano_letivo='.$ano_letivo);
    /*echo $sql;
    foreach($checkbox as $valor){
        echo $valor;
    } PEGAR OS DADOS DAS DISCIPLINAS PADRÃO*/ 
}else{
    header('Location: ../lista_turma.php?msg=2');
    /*echo "Erro na inserção de dados!<br>".$sql;
	echo trigger_error(mysql_error());*/
}


?>