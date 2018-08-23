<?php

use Mpdf\Mpdf;

require_once '../../assets/vendor/autoload.php';
include "../../base/conexao.php";

$mpdf = new \Mpdf\Mpdf();
//$mpdf->WriteHTML('<h1>Hello world!!</h1>');
$data = mysqli_query($conexao, "select * from aluno order by nome_alu asc limit $inicio, $quantidade;")/* or die(mysql_error())*/;
$info = mysqli_fetch_array($data);
$mpdf->WriteHTML('<h1>'.$info['nome_alu'].'</h1>');

$mpdf->Output();

?>