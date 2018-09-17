<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");
$encoding = mb_internal_encoding();

//$matricula_alu       = $_POST["matricula_alu"];
$nome_alu            = mb_strtoupper($_POST["nome_alu"], $encoding);
$sobrenome_alu       = mb_strtoupper($_POST["sobrenome_alu"], $encoding);
$cpf_alu             = $_POST["cpf_alu"];
$rg_alu              = $_POST["rg_alu"];
$dt_nasc_alu         = implode("-", array_reverse(explode("/", $_POST["dt_nasc_alu"])));
$nome_pai            = mb_strtoupper($_POST["nome_pai"], $encoding);
$nome_mae            = mb_strtoupper($_POST["nome_mae"], $encoding);
$sexo_alu            = $_POST["sexo_alu"];
$cep                 = $_POST["cep"];
$num_resid_alu       = $_POST["num_resid_alu"];
$complemento_alu     = $_POST["complemento_alu"]; //Resgata os dados pessoais do aluno;

//Dados para a matríoula
$ano_letivo          = $_POST["ano_letivo"];
$semestre            = $_POST["semestre"];
$tipo_alu            = $_POST["tipo_alu"];
$id_cur              = $_POST["id_cur"];

//Algoritmo matrícula parte fixa
$ano = substr($ano_letivo, -2); //Ano
if($semestre == 1){
    $semestre_mat = 10; 
}elseif($semestre == 2){
    $semestre_mat = 20;
} //Semeste
if($tipo_alu == 'I'){
    $modalidade = 14; 
}elseif($tipo_alu == 'S'){
    $modalidade = 15; 
} //Modalidade
switch($id_cur){
    case 0:
        $curso = str_pad(1, 2, 0, STR_PAD_LEFT);
        break;
    case 3:
        $curso = str_pad(5, 2, 0, STR_PAD_LEFT);
        break;
    case 4:
        $curso = 39;
        break;
    case 5:
        $curso = 44;
        break; 
} //Curso
$mat_fixa = $ano.$semestre_mat.$modalidade.$curso;

//Algoritmo matrícula parte sequencial
$sql_ano = "select distinct ano_letivo from matriculado order by ano_letivo desc";
$query_ano = mysqli_query($conexao, $sql_ano);
$array_ano = mysqli_fetch_array($query_ano);
$ultimo_ano = substr($array_ano[0], -2);

if(($ano <> $ultimo_ano) || empty($ultimo_ano)){ //Se ano for diferente do ultimo ano (ou for um ano novo), cria uma nova sequência;
    $mat_sequencial = str_pad(1, 4, 0, STR_PAD_LEFT); 
}elseif($ano == $ultimo_ano){ //Senão, puxa do banco as matrículas daquele ano, pega os últimos 4 dígitos e faz um incremento para gerar a próxima matrícula;
    $sql_check  = "select distinct max(substring(matricula_alu, 9, 4)) as mat_sequencial ";
    $sql_check .= "from aluno where matricula_alu like '$ano%'";
    $query_check = mysqli_query($conexao, $sql_check);
    //$array_check = mysqli_fetch_array($query_check);
    $array_check[0] = '0999';
    
    $ultimo_numero = (int) $array_check[0];
    $proximo_numero = $ultimo_numero + 1;
    $mat_sequencial = str_pad($proximo_numero, 4, 0, STR_PAD_LEFT);
}
$matricula_alu = $mat_fixa.$mat_sequencial;

echo $matricula_alu;




/*$sql  = "insert into aluno values ";
$sql .= "('$matricula_alu', '$nome_alu', '$sobrenome_alu', '$cpf_alu', '$rg_alu', '$dt_nasc_alu', '$nome_pai', '$nome_mae', '$sexo_alu', NULL, 1, '$tipo_alu', NULL, NULL, NULL, NULL, '$cep', '$num_resid_alu', '$complemento_alu');";

$resultado = mysqli_query($conexao, $sql) or die (mysqli_error($conexao));

if($resultado){
    $registra_atv = mysqli_query ($conexao, lau($usuario, str_replace( array("'"), "\'", $sql), $id_usuario));
    mysqli_close($conexao);
    header('Location: ../lista_aluno.php?msg=1');
}else{
    mysqli_close($conexao);
    header('Location: ../lista_aluno.php?msg=2');
}*/
?>