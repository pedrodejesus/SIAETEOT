<?php
// Verifica se houve POST e se o usu�rio ou a senha �(s�o) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
	header("Location: ../login.php"); exit;
}

include "conexao.php";

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

// Valida��o do usu�rio e senha digitados
$sql = "select id_usu, nome_usu, nivel, ativo, id_func from usuario where (usuario = '". $usuario ."') AND (senha = '". sha1($senha) ."') limit 1";
$query = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($query);

if (mysqli_num_rows($query) != 1) {
    header("Location: ../login.php?msg=1"); exit;
}else if ($dados['ativo'] == 0) {
    header("Location: ../login.php?msg=2"); exit;    
}else {
	$resultado = $dados; // Salva os dados encontados na vari�vel $resultado
	
    //4.0 - Salvando os dados na sess�o do PHP
    
	if (!isset($_SESSION)) session_start(); // Se a sess�o n�o existir, inicia uma

	// Salva os dados encontrados na sess�o
	$_SESSION['UsuarioID'] = $resultado['id_usu'];
	$_SESSION['UsuarioNome'] = $resultado['nome_usu'];
	$_SESSION['UsuarioNivel'] = $resultado['nivel'];
    $_SESSION['FuncID'] = $resultado['id_func'];

	// Redireciona o visitante
	header("Location: ../index.php"); exit;
}

?>