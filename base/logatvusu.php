<?php
function lau($usu, $atv, $id_usu){
	
	$log_atv  = "insert into logatv_usuario values ";
	$log_atv .= "('0','$usu', '$atv', now(), '$id_usu');";
	
    return $log_atv;
}
?>