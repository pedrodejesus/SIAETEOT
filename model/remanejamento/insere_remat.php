<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../base/conexao.php");
include("../../base/logatvusu.php");

$matricula_alu      = $_POST["matricula_alu"];
$id_turma_antiga    = $_POST["id_turma_ano_letivo_corrente"];
$proximo_ano_letivo = $_POST["proximo_ano_letivo"];
$id_turma           = $_POST["id_turma"];

$sql = "select id_disc from disc_pdr_tur where id_turma = '".$id_turma."';";
$consulta = mysqli_query($conexao, $sql);

foreach($matricula_alu as /*$index =>*/ $matricula){
    /*$sql_update = "update matriculado set remat = 1 where matricula_alu = '".$matricula."' and id_turma = '".$id_turma_antiga."';";
    $query_update = mysqli_query($conexao, $sql_update);*/
    
    $sql2 = "select distinct tipo_matricula, dt_matricula from matriculado where matricula_alu = ".$matricula." and id_turma = ".$id_turma_antiga.";";
    $consulta2 = mysqli_query($conexao, $sql2) or die(mysqli_error($conexao));
    while($data_tipo = mysqli_fetch_array($consulta2)){
        $tipo = $data_tipo['tipo_matricula'];
        $data = $data_tipo['dt_matricula'];
    }
    
    while ($disciplinas = mysqli_fetch_array($consulta)){
        $sql_insert = "insert into matriculado values (0, '".$tipo."', ".$data.", '".$proximo_ano_letivo."', '0', '".$matricula."', '".$id_turma."',  '".$disciplinas['id_disc']."');";
        $resultado = mysqli_query($conexao, $sql_insert);
        //echo $sql_insert."<br>";
    }
}
if($resultado){
    //$registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: remaneja_alu.php?msg=1');
    
}else{
    //echo $sql;
    echo "Erro na inserção de dados!<br>".$sql_insert."<br>".mysqli_error($conexao);
	//echo trigger_error(mysql_error());
}

?>