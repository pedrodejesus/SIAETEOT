<?php
require_once '../../../../assets/vendor/autoload.php';
include "../../../../base/conexao.php";

$orientacao = strtoupper($_POST['orientacao']);

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'orientation' => "$orientacao",
	'default_font_size' => 10,
	'default_font' => 'arial'/*,
    'debug' => true,
    'allow_output_buffering' => true*/
]);

$id_turma    = $_POST['id_turma'];
$ano_letivo  = $_POST['ano_letivo'];
$sql_turma   = mysqli_query($conexao, "select * from turma where id_turma = $id_turma limit 1");
$array_turma = mysqli_fetch_array($sql_turma);

$mpdf->DefHTMLHeaderByName('MyHeader1', '<h1 style="text-align:center">Relatório de alunos por turma - '.$ano_letivo.'</h1>');
$css = file_get_contents('../../../../assets/css/style-rel.css');
$mpdf->WriteHTML($css,1);

$sql_list = "select distinct a.matricula_alu, concat(a.nome_alu, a.sobrenome_alu) as nome
            from aluno a, matriculado m, turma t
            where a.matricula_alu = m.matricula_alu
            and t.id_turma = m.id_turma
            and m.id_turma = $id_turma";
$query_list = mysqli_query($conexao, $sql_list) or die(mysqli_error($conexao));

$html = '<h2 clas="txt-center">LISTAGEM DE ALUNOS DA TURMA '.$array_turma['numero'].'/'.$array_turma['ano_letivo'].'</h2>';
$html .= '<br><table style="width:100%; text-align:center;">';
$html .= '<thead><tr><th style="background:#CFCFCF; border:solid 1px black;">MATRÍCULA</th><th style="background:#CFCFCF; border:solid 1px black;">ALUNO</th><th style="background:#CFCFCF; border:solid 1px black;">ASSINATURA</th></tr>';

$html .= '<tbody>';
$mpdf->WriteHTML($html,2);

//$html2 .= '<tr><td style="border:solid 1px black;">1151</td><td style="border:solid 1px black;">43</td></tr>';
while($row = mysqli_fetch_array($query_list)){
    $html2 = '<tr><td style="border:solid 1px black;">'.$row['matricula_alu'].'</td><td style="border:solid 1px black; text-align: left; padding-left:5px;">'.$row['nome'].'</td><td style="border:solid 1px black; width: 30%;"></td></tr>';
    $mpdf->WriteHTML($html2,2);
}

$html3 = '</tbody></table>';

$mpdf->WriteHTML($html3,2);
$mpdf->Output();

?>