<?php
if (!isset($_SESSION)) session_start();
include 'calendario_function.php';
$mostrar_mes = $_GET['mes'];

if(strlen($mostrar_mes) == 1){
    $mostrar_mes = '0'.$mostrar_mes;
}
                                
MostreCalendario($mostrar_mes); //Mostra o calendário do mês atual
//echo $mostrar_mes;
                                
?>
