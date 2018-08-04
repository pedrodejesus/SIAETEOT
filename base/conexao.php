<?php
$conexao = @mysql_connect("Localhost", "root", "") or die(mysql_error("Erro: "));
$db = @mysql_select_db("projeto") or die(mysql_error());
?>