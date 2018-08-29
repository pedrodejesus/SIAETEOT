<?php

require_once '../../assets/vendor/autoload.php';
//if (!isset($_SESSION)) session_start();
include "../../base/conexao.php";
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'orientation' => 'L'
]);

/*$sql = "call select_disciplinas_aluno_boletim(".$matricula_alu.", ".$id_turma.")";
$query = mysqli_query($conexao, $sql_bol) or die(mysqli_error($conexao));*/

$header = "
    <!--<div>Página {PAGENO} de {nbpg}</div>-->
    <img class='logo_rj' src='../../assets/img/logo_rj.jpg' />
                
    <h4 class='titulo_bol'>ESCOLA TÉCNICA ESTADUAL OSCAR TENÓRIO <br><br> FICHA INDIVIDUAL DE RENDIMENTOS 2018</h4>
                
    <img class='logo_eteot' class='logo_eteot' src='../../assets/img/logo.jpg' />
";

$html = "
                
        

";

$footer = "
    <hr>
    <div class='rodape'>Emissão: ".date('d/m/Y  -  H:i:s')." </div>
	</fieldset>
";

/*while($info = mysqli_fetch_array($query)){
    $html = $info['nome_disc'];
    $mpdf->WriteHTML($html);
}*/
$css = file_get_contents('../../assets/css/style-rel.css');
$mpdf->WriteHTML($css,1);
$mpdf->SetHTMLHeader($header);
$mpdf->WriteHTML($html,2);
$mpdf->SetHTMLFooter($footer);
$mpdf->Output();

?>