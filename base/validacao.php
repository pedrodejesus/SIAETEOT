<?php
// Verifica se houve POST e se o usu�rio ou a senha �(s�o) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
	header("Location: ../login.php"); exit;
}

mysql_connect('localhost', 'root', '') or trigger_error(mysql_error()); // Tenta se conectar ao servidor MySQL
mysql_select_db('projeto') or trigger_error(mysql_error()); // Tenta se conectar a um banco de dados MySQL

$usuario = mysql_real_escape_string($_POST['usuario']);
$senha = mysql_real_escape_string($_POST['senha']);

// Valida��o do usu�rio e senha digitados
$sql = "SELECT id_usu, nome_usu, nivel, id_func FROM usuario WHERE (usuario = '". $usuario ."') AND (senha = '". sha1($senha) ."') AND (ativo = 1) LIMIT 1";
$query = mysql_query($sql);

if (mysql_num_rows($query) != 1) {
	echo "Login inv�lido!", trigger_error(mysql_error()); exit; // Mensagem de erro quando os dados s�o inv�lidos e/ou o usu�rio n�o foi encontrado
} else {
	$resultado = mysql_fetch_assoc($query); // Salva os dados encontados na vari�vel $resultado

	
////// 4.0 - Salvando os dados na sess�o do PHP ////////

	// Se a sess�o n�o existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na sess�o
	$_SESSION['UsuarioID'] = $resultado['id_usu'];
	$_SESSION['UsuarioNome'] = $resultado['nome_usu'];
	$_SESSION['UsuarioNivel'] = $resultado['nivel'];
    $_SESSION['FuncID'] = $resultado['id_func'];

	// Redireciona o visitante
	header("Location: ../index.php"); exit;
}

?>