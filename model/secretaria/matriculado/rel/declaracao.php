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

$mpdf->DefHTMLHeaderByName('MyHeader1',
  '<div><table width="100%"><tr>
	<td width="20%"><img class="logo_rj_dec" src="../../../../assets/img/logo_rj.jpg" /></td>
	<td class="topo-declaracao"><h4>
        GOVERNO DO ESTADO DO RIO DE JANEIRO <br> 
        SECRETARIA DE ESTADO DE DE CIÊNCIA E TECNOLOGIA <br>
        FUNDAÇÃO DE APOIO A ESCOLA TÉCNICA <br>
        ESCOLA TÉCNICA ESTADUAL OSCAR TENÓRIO <br>
        CNPJ: 33608763/0016-20 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; COD. INEP: 33075034
    </h4></td>

	</tr></table></div>');

/*$mpdf->DefHTMLFooterByName('MyFooter1',
  '<div class="rodape"><div class="emiss">Emissão: '.date("d/m/Y  -  H:i:s").' </div></div>');*/

$mpdf->SetHTMLHeaderByName('MyHeader1');
//$mpdf->SetHTMLFooterByName('MyFooter1');

$css = file_get_contents('../../../../assets/css/style-rel.css');
$mpdf->WriteHTML($css,1);

$matricula_alu = $_GET['matricula_alu'];
//$id_turma = $_GET['id_turma'];
$sql  = "select m.tipo_matricula, m.dt_matricula, m.ano_letivo, m.matricula_alu, m.id_turma, m.id_disc, m.dt_matricula, m.situacao as sit_pdg, ";
$sql .= "a.matricula_alu, a.nome_alu, a.sobrenome_alu, a.situacao as sit_adm, a.dt_nasc_alu, a.nome_pai, a.nome_mae, ";
$sql .= "d.id_disc, d.nome_disc, ";
$sql .= "t.id_turma, t.numero, t.ano_letivo ";
$sql .= "from matriculado m, aluno a, disciplina d, turma t ";
$sql .= "where m.matricula_alu = a.matricula_alu ";
$sql .= "and m.id_disc = d.id_disc ";
$sql .= "and m.id_turma = t.id_turma ";
$sql .= "and m.remat = '0' ";
$sql .= "and m.matricula_alu = '".$matricula_alu."' ";
$query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
$row = mysqli_fetch_array($query);


// Área do html PDF
$html ='<h1 class="dec_tit"><b>DECLARAÇÃO</b></h1>';

$html .='<p class="dec_txt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Declaramos que, de acordo com os assentamentos constantes no arquivo deste Estabelecimento de Ensino: </p>';

$html .='<h2 class="dec_nome"><b>'.$row['nome_alu'].' '.$row['sobrenome_alu'].'</b></h2>';

$html .='<p class="dec_txt"> nascido(a) em: ';

$html .= implode("/", array_reverse(explode("-", $row['dt_nasc_alu'])));

$html .= ' e tendo por pais os senhores: </p>';

$html .='<h3 class="dec_nome"><b>'.$row['nome_pai'].' e '.$row['nome_mae'].',</b></h3>';

$html .='<p class="dec_txt"> está matriculado(a) e cursando a ';

$serie = substr($row['numero'], 0, -3);

$html .= '<b>'.$serie.'ª</b> série do Ensino médio, integrado ao Curso Técnico em </p>';

$curso = substr($row['numero'], -2, -1);

switch($curso){
    case 0:
        $html .= '<h3 class="dec_nome"><b>ADMINISTRAÇÃO,</b></h3>';
        break;
    case 3:
        $html .= '<h3 class="dec_nome"><b>ANÁLISES CLÍNICAS,</b></h3>';
        break;
    case 4:
        $html .= '<h3 class="dec_nome"><b>GERÊNCIA EM SAÚDE,</b></h3>';
        break;
    case 5:
        $html .= '<h3 class="dec_nome"><b>INFORMÁTICA PARA INTERNET,</b></h3>';
        break;
}

$html .= '<p class="dec_txt">no ano letivo de '.$row['ano_letivo'].', no horário de 7:00 horas ás 18:10 horas; com aulas aos sábados, no horário de 7:00 horas ás 12:00 horas.</p><br><br>';

$html .= '<p class="num_mat"><b>NÚMERO DE MATRÍCULA: &nbsp;&nbsp;&nbsp;&nbsp;'.$row['matricula_alu'].'</b></p>';
$html .= '<p class="num_mat"><b>PREVISÃO DE TÉRMINO:</b></p><br><br>';
$html .= '<p class="num_mat"><b>VALIDADE DE 6 (SEIS) MESES.</b></p><br>';

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data = strftime('%d de %B de %Y', strtotime('today'));

$html .= '<p class="data">Rio de Janeiro, '.$data.'</p><br><br><br><br>';
$html .= '<p style="text-align:right;">________________________________________________________________________________________</p>';
// Fim da Área do HTML PDF

$mpdf->WriteHTML($html,2);
$mpdf->Output();
?>