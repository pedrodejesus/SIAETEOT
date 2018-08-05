<?php
$conexao = @mysql_connect("Localhost", "root", "") or die(mysql_error("Erro: "));
$db = @mysql_select_db("projeto") or die(mysql_error());

mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
?>