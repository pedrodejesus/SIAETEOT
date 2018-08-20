<?php
//$conexao = @mysql_connect("Localhost", "root", "") or die(mysql_error("Erro: "));
//$db = @mysql_select_db("projeto") or die(mysql_error()); VERSÃO PHP 5.6

$conexao = mysqli_connect("Localhost", "root", "", "projeto");

mysqli_query($conexao, "SET NAMES 'utf8'");
mysqli_query($conexao, 'SET character_set_connection=utf8');
mysqli_query($conexao, 'SET character_set_client=utf8');
mysqli_query($conexao, 'SET character_set_results=utf8');
?>