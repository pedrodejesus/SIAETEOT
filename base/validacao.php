<?php
// Verifica se houve POST e se o usuário ou a senha estão vazio(s); Caso estejam, redireciona de volta para o login.
if (!empty($_POST) AND (empty($_POST['usuario']) OR empty($_POST['senha']))) {
	header("Location: ../login.php"); exit;
}

include "conexao.php";

if(isset($_POST['aluno'])){
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    
    $sql_alu  = "select matricula_alu, nome_alu, sobrenome_alu, usuario_alu, senha_alu, nivel_alu from aluno";
    $sql_alu .= " where (matricula_alu = $usuario or usuario_alu = $usuario or email_alu = $usuario) and senha_alu = sha1('$senha') limit 1;";
    $query_alu = mysqli_query($conexao, $sql_alu);
    $dados_alu = mysqli_fetch_array($query_alu);
    
    if(mysqli_num_rows($query_alu) != 1){
        header("Location: ../login.php?msg=1"); exit;
    }elseif($dados_alu['senha_alu'] == sha1($dados_alu['matricula_alu'])){
        session_start();
        $_SESSION['matricula_alu'] = $dados_alu['matricula_alu'];
        $_SESSION['nome_alu'] = $dados_alu['nome_alu'];
        $_SESSION['sobrenome_alu'] = $dados_alu['sobrenome_alu'];
        $_SESSION['UsuarioNivel'] = $dados_alu['nivel_alu'];
        $_SESSION['UsuarioNome'] = $dados_alu['nome_alu'].$dados_alu['sobrenome_alu'];
        
        header("Location: ../model/aluno/login_alu/primeiro_acesso.php?matricula_alu=".$dados_alu['matricula_alu']);
    }else{
        session_start();
        $_SESSION['matricula_alu'] = $dados_alu['matricula_alu'];
        $_SESSION['nome_alu'] = $dados_alu['nome_alu'];
        $_SESSION['sobrenome_alu'] = $dados_alu['sobrenome_alu'];
        $_SESSION['usuario_alu'] = $dados_alu['usuario_alu'];
        $_SESSION['email_alu'] = $dados_alu['email_alu'];
        $_SESSION['UsuarioNivel'] = $dados_alu['nivel_alu'];
        $_SESSION['UsuarioNome'] = $resultado['nome_usu'];
        
        header("Location: ../index.php");
    }
}else{
    $usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // Validação do usuário e senha digitados
    $sql = "select id_usu, nome_usu, nivel, ativo, id_func from usuario";
    $sql.= " where (usuario = '".$usuario."') AND (senha = '".sha1($senha)."') limit 1";
    $query = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_array($query);

    if (mysqli_num_rows($query) != 1) {
        header("Location: ../login.php?msg=1"); exit;
    }else if ($dados['ativo'] == 0) {
        header("Location: ../login.php?msg=2"); exit;    
    }else {
	$resultado = $dados; // Salva os dados encontados na variável $resultado
	
    //4.0 - Salvando os dados na sessão do PHP
    
	if (!isset($_SESSION)) session_start(); // Se a sessão não existir, inicia uma

	// Salva os dados encontrados na sess�o
	$_SESSION['UsuarioID'] = $resultado['id_usu'];
	$_SESSION['UsuarioNome'] = $resultado['nome_usu'];
	$_SESSION['UsuarioNivel'] = $resultado['nivel'];
    $_SESSION['FuncID'] = $resultado['id_func'];

	// Redireciona o visitante
	header("Location: ../index.php"); exit;
        }
}