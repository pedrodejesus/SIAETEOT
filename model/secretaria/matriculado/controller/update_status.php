<?php
session_start();
$usuario = $_SESSION['UsuarioNome'];
$id_usuario = $_SESSION['UsuarioID'];

include("../../../../base/conexao.php");
include("../../../../base/logatvusu.php");

$matricula_alu = $_GET['matricula_alu'];
$id_turma = $_GET['id_turma'];
$acao = $_GET['acao'];

switch($acao){
        
    case "trancar":
        $sql = "update aluno set situacao = 3 where matricula_alu = $matricula_alu";
        $query = mysqli_query($conexao, $sql);
        header ('Location: ../view/visualizar_mat.php?matricula_alu='.$matricula_alu.'&msg=1');
        break;
     case "destrancar":
        $sql = "update aluno set situacao = 1 where matricula_alu = $matricula_alu";
        $query = mysqli_query($conexao, $sql);
        header ('Location: ../view/visualizar_mat.php?matricula_alu='.$matricula_alu.'&msg=2');
        break;
    case "concluir":
        $sql = "update aluno set situacao = 4 where matricula_alu = $matricula_alu";
        $query = mysqli_query($conexao, $sql);
        header ('Location: ../view/visualizar_mat.php?matricula_alu='.$matricula_alu.'&msg=3');
        break;
    case "desistir":
        $sql = "update aluno set situacao = 2 where matricula_alu = $matricula_alu";
        $query = mysqli_query($conexao, $sql);
        header ('Location: ../view/visualizar_mat.php?matricula_alu='.$matricula_alu.'&msg=4');
        break;
        
}
?>