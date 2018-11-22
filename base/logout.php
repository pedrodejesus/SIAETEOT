<?php
	session_start(); // Inicia a sessão
	session_destroy(); // Destrói a sessão limpando todos os valores salvos
	header("Location: \siaeteot/login.php"); 
    exit; // Redireciona o visitante
?>