<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../base/conexao.php");
include("../../../base/logatvusu.php");

$id_turma       = $_POST["id_turma"];
$disc_pdr_tur = $_POST["disc_pdr_tur"];

foreach($disc_pdr_tur as $valor){
    $sql   = "insert into disc_pdr_tur values ";
    $sql  .= "(0, '$id_turma', '$valor'); ";
    $resultado = mysqli_query($conexao, $sql);
} /* foreach é um iterador de arrays, que execuata um código para cada posição do vetor*/

if($resultado){
    mysqli_close($conexao);
    header('Location: ../lista_turma.php?msg=1');
    
}else{
    echo "Erro na inserção de dados!<br>".$sql;
}

?>