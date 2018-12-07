<?php
require_once '../../../../assets/vendor/autoload.php';
include "../../../../base/conexao.php";

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'orientation' => 'P',
	'default_font_size' => 10,
	'default_font' => 'arial',
    'debug' => true
]);
    
$mpdf->DefHTMLHeaderByName('MyHeader1', '<h1 style="text-align:center">Histórico</h1>');

$matricula_alu = $_GET['matricula_alu']; //TODO: MUDAR P/ POST AO IMPLEMENTAR

$css = file_get_contents('../../../../assets/css/style-rel.css');
$mpdf->WriteHTML($css,1);

$sql = "call select_historico($matricula_alu)";
$query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

$html  = '<table style="width:100%; text-align:center;" cellpadding="6">';
$html .= '<thead><tr><th style="background:#CFCFCF; border:solid 1px black;">ANO LETIVO</th><th style="background:#CFCFCF; border:solid 1px black;">COMPONENTES CURRICULARES</th><th style="background:#CFCFCF; border:solid 1px black;">CARGA HORÁRIA</th><th style="background:#CFCFCF; border:solid 1px black;">MÉDIA ANUAL</th></tr></thead>';
$html .= '<tbody>';

$mpdf->WriteHTML($html,2);

while ($hist = mysqli_fetch_array($query)) {
    $html2 = '<tr><td style="border:solid 1px black;">'.$hist['ano_letivo'].'</td><td style="border:solid 1px black;">'.$hist['nome_disc'].'</tr>';
    $mpdf->WriteHTML($html2,2);
    
}

$html3 = '</tbody></table>';

$mpdf->WriteHTML($html3,2);
$mpdf->Output();