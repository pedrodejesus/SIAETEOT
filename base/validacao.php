<?php
// Verifica se houve POST e se o usuсrio ou a senha щ(sуo) vazio(s)
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
	header("Location: ../login.php"); exit;
}

mysql_connect('localhost', 'root', '') or trigger_error(mysql_error()); // Tenta se conectar ao servidor MySQL
mysql_select_db('projeto') or trigger_error(mysql_error()); // Tenta se conectar a um banco de dados MySQL

$usuario = mysql_real_escape_string($_POST['usuario']);
$senha = mysql_real_escape_string($_POST['senha']);

// Validaчуo do usuсrio e senha digitados
$sql = "SELECT id_usu, nome_usu, nivel, id_func FROM usuario WHERE (usuario = '". $usuario ."') AND (senha = '". sha1($senha) ."') AND (ativo = 1) LIMIT 1";
$query = mysql_query($sql);

if (mysql_num_rows($query) != 1) {
	echo "Login invсlido!", trigger_error(mysql_error()); exit; // Mensagem de erro quando os dados sуo invсlidos e/ou o usuсrio nуo foi encontrado
} else {
	$resultado = mysql_fetch_assoc($query); // Salva os dados encontados na variсvel $resultado

	
////// 4.0 - Salvando os dados na sessуo do PHP ////////

	// Se a sessуo nуo existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na sessуo
	$_SESSION['UsuarioID'] = $resultado['id_usu'];
	$_SESSION['UsuarioNome'] = $resultado['nome_usu'];
	$_SESSION['UsuarioNivel'] = $resultado['nivel'];
    $_SESSION['FuncID'] = $resultado['id_func'];

	// Redireciona o visitante
	header("Location: ../index.php"); exit;
}

?>