<script src="https://use.fontawesome.com/5c09ce9350.js"></script>
<?php
require_once '../../../../assets/vendor/autoload.php';
include "../../../../base/conexao.php";

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'orientation' => 'P',
	'default_font_size' => 10,
	'default_font' => 'arial'
    //'debug' => true
]);

$ano_letivo = $_POST['ano_letivo'];

//$mpdf->DefHTMLHeaderByName('MyHeader1', '<h1 style="text-align:center">Relatório de alunos por turma - '.$ano_letivo.'</h1>');
//$mpdf->DefHTMLFooterByName('MyFooter1','');

$mpdf->SetHTMLHeaderByName('MyHeader1');
//$mpdf->SetHTMLFooterByName('MyFooter1');

$css = file_get_contents('../../../../assets/css/style-rel.css');
$mpdf->WriteHTML($css,1);

$sql_turma = "select distinct m.id_turma, t.numero from matriculado m, turma t where m.id_turma = t.id_turma and m.ano_letivo = $ano_letivo order by t.numero asc";
$query_turma = mysqli_query($conexao, $sql_turma) or die (mysqli_error($conexao));

$html  = '<table style="width:100%; text-align:center;" cellpadding="6">';

$html .= '<thead><tr><th style="background:#CFCFCF; border:solid 1px black;" colspan="4">ETEOT - QUANTIDADE DE ALUNOS POR TURMA - '.$ano_letivo.'</th></tr>';
$html .= '<tr><th style="background:#CFCFCF; border:solid 1px black;" colspan="2">INTEGRADO</th><th style="background:#CFCFCF; border:solid 1px black;" colspan="2">SUBSEQUENTE</th></tr>';
$html .= '<tr><th style="background:#CFCFCF; border:solid 1px black;" colspan="1">TURMA</th><th style="background:#CFCFCF; border:solid 1px black;" colspan="1">QUANTIDADE</th>';
$html .= '<th style="background:#CFCFCF; border:solid 1px black;" colspan="1">TURMA</th><th style="background:#CFCFCF; border:solid 1px black;" colspan="1">QUANTIDADE</th></tr></thead>';

$html .= '<tbody>';
$mpdf->WriteHTML($html,2);

//$html2 .= '<tr><td style="border:solid 1px black;">1151</td><td style="border:solid 1px black;">43</td></tr>';
while($row_turma = mysqli_fetch_array($query_turma)){
    $sql_count      = "select count(distinct matricula_alu) from matriculado where id_turma = ".$row_turma['id_turma'].";";
    $query_count    = mysqli_query($conexao, $sql_count);
    $array_count    = mysqli_fetch_array($query_count);
    
    $html2 = '<tr><td style="border:solid 1px black;">'.$row_turma['numero'].'</td><td style="border:solid 1px black;">'.$array_count[0].'</td></tr>';
    $mpdf->WriteHTML($html2,2);
}
$sql_total = "select count(distinct matricula_alu) from matriculado where ano_letivo = ".$ano_letivo;
$html3 = '</tbody></table>';

$mpdf->WriteHTML($html3,2);
$mpdf->Output();

?>