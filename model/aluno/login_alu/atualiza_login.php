<?php
session_start();
include "../../../base/conexao.php";

$usuario_alu            = $_POST['usuario_alu'];
$senha_alu              = $_POST['senha_alu'];
$confirma_senha_alu     = $_POST['confirma_senha_alu'];
$email_alu              = $_POST['email_alu'];

$matricula_alu = $_SESSION['matricula_alu'];

$sql  = "update aluno set";
$sql .= " usuario_alu = '$usuario_alu', senha_alu = sha1('$senha_alu'), email_alu = '$email_alu'";
$sql .= " where matricula_alu = $matricula_alu";

$query = mysqli_query($conexao, $sql);

if($query){
    header("Location: ../../../index.php");
}

