<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$matricula_alu      = $_POST["matricula_alu"];
$id_turma_antiga    = $_POST["id_turma_ano_letivo_corrente"];
$proximo_ano_letivo = $_POST["proximo_ano_letivo"];
$id_turma           = $_POST["id_turma"];

foreach($matricula_alu as /*$index =>*/ $matricula){ //Para cada aluno selecionado, faça:
    $sql_update = "update matriculado set remat = 1 where matricula_alu = '".$matricula."' and id_turma = '".$id_turma_antiga."';";
    $query_update = mysqli_query($conexao, $sql_update); //A matricula do aluno na turma anterior recebe o atributo remat = 1, para indicar que ele já fopi rematriculado;
    
    $sql2 = "select distinct tipo_matricula, dt_matricula from matriculado where matricula_alu = ".$matricula." and id_turma = ".$id_turma_antiga.";";
    $consulta2 = mysqli_query($conexao, $sql2) or die(mysqli_error($conexao));
    while($data_tipo = mysqli_fetch_array($consulta2)){
        $tipo = $data_tipo['tipo_matricula'];
        $data = $data_tipo['dt_matricula'];
    } //Selecione o tipo de matricula e adata anteriores para manter nos novos registros;
    
    $sql = "select id_disc from disc_pdr_tur where id_turma = '".$id_turma."';";
    $consulta = mysqli_query($conexao, $sql); //Seleciona as disciplinas padrão da nova turma e matricula cada aluno selecionado nelas
    while ($disciplinas = mysqli_fetch_array($consulta)){
        $sql_insert = "insert into matriculado values (0, '".$tipo."', '".$data."', '".$proximo_ano_letivo."', 1, '0', '".$matricula."', '".$id_turma."',  '".$disciplinas['id_disc']."');";
        $resultado = mysqli_query($conexao, $sql_insert);
        //echo $sql_insert."<br>";
        
        $sql_insert_bol = "insert into boletim (id_boletim, matricula_alu, id_turma, id_disc) values (0, '".$matricula."', '".$id_turma."', '".$disciplinas['id_disc']."');";
        $resultado_insert_bol = mysqli_query($conexao, $sql_insert_bol); //Insere no boletim as novas disciplinas e turma 
    }
}
if($resultado){
    //$registra_atv = mysql_query (lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: remaneja_alu.php?msg=1');
    
}else{
    //echo $sql;
    echo "Erro na inserção de dados!<br>".mysqli_error($conexao);
	//echo trigger_error(mysql_error());
}

?>