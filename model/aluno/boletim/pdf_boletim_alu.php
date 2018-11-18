<script src="https://use.fontawesome.com/5c09ce9350.js"></script>
<?php
require_once '../../../assets/vendor/autoload.php';
//if (!isset($_SESSION)) session_start();
include "../../../base/conexao.php";

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'orientation' => 'P',
	'default_font_size' => 10,
	'default_font' => 'arial'
    //'debug' => true
]);

$matricula_alu = $_GET['matricula_alu'];
$id_turma = $_GET['id_turma'];
$sql = "call select_disciplinas_aluno_boletim(".$matricula_alu.", ".$id_turma.")";
$query = mysqli_query($conexao, $sql);
mysqli_next_result($conexao);
$row = mysqli_fetch_array($query);

$mpdf->DefHTMLHeaderByName('MyHeader1',
  '<div><table width="100%"><tr>
	<td width="20%"><img class="logo_rj" src="../../../assets/img/logo_rj.jpg" /></td>
	<td width="60%" align="center"><h3>ESCOLA TÉCNICA ESTADUAL OSCAR TENÓRIO <br> FICHA INDIVIDUAL DE RENDIMENTOS '.$row['ano_letivo'].'</h3></td>
	<td width="20%" align="right"><img class="logo_eteot" class="logo_eteot" src="../../../assets/img/logo.jpg" /></td>
	</tr></table></div>');

$mpdf->DefHTMLFooterByName('MyFooter1',
  '<div class="rodape"><!--<div class="pag">Página {PAGENO} de {nbpg}</div>--><div class="emiss">Emissão: '.date("d/m/Y  -  H:i:s").' </div></div>');

$mpdf->SetHTMLHeaderByName('MyHeader1');
$mpdf->SetHTMLFooterByName('MyFooter1');

$css = file_get_contents('../../../assets/css/style-rel.css');
$mpdf->WriteHTML($css,1);

$titulo = 'BOLETIM '.$row['nome_alu'].$row['sobrenome_alu'].' - '.$row['numero'];
$mpdf->SetTitle($titulo);

// Área do html PDF
$html ='<table class="info-alu" width="100%" cellpadding="7">
		<tr style="background:#CFCFCF"><td>Aluno(a): <b>'.$row['nome_alu']." ".$row['sobrenome_alu'].'</b> </td><td>Nr.: <b>01</b> </td><td> Turma: <b>'.$row['numero'].'</b></td></tr>
		<tr style="background:#CFCFCF"><td colspan="2">Matrícula: <b>'.$row['matricula_alu'].'</b></td><td> Ano Letivo: <b>'.$row['ano_letivo'].'</b></td></tr>
	</table>';

$html .= '<table width="100%" id="body_bol" class="total-bol" cellpadding="5">
	<thead>
		<tr class="ref">
			<th scope="col" rowspan="2">DISCIPLINAS</th>
			<th scope="col" colspan="3">1ª ETAPA</th>
			<th scope="col" colspan="3">2ª ETAPA</th>
			<th scope="col" colspan="3">3ª ETAPA</th>
			<th scope="col" colspan="3">TOTAL ANUAL</th>
			<th scope="col" rowspan="2">REC. FINAL</th>
			<th scope="col" rowspan="2">SIT. FINAL</th>
		</tr>
		<tr class="ref">
			<th scope="col">NOTA</th>
			<th scope="col">REC.</th>
			<th scope="col">% FALTAS</th>
			<th scope="col">NOTA</th>
			<th scope="col">REC.</th>
			<th scope="col">% FALTAS</th>
			<th scope="col">NOTA</th>
			<th scope="col">REC.</th>
			<th scope="col">% FALTAS</th>
			<th scope="col">MÉDIA</th>
			<th scope="col">% FALTAS</th>
            <th scope="col">SIT. 3ª ETAPA</th>
	</thead>';

	$html .= '<tbody>';                                              
            

			$sql_bol = "call select_disciplinas_aluno_boletim(".$matricula_alu.", ".$id_turma.")";
			$query_bol = mysqli_query($conexao, $sql_bol) or die(mysqli_error($conexao));
			mysqli_next_result($conexao);
			$cont = 1;
			while($row_bol = mysqli_fetch_array($query_bol)){  
				$disc_len = strlen($row_bol['nome_disc']);
				if($disc_len > 15){
					$row_bol['nome_disc'] = $row_bol['sigla_disc'];
				}
				// Zebrar o relatório
				if($cont % 2 == 0){
					$html.= "<tr scope='row' style='background:#e4e4e4;'>";
				}else{
					$html.= "<tr scope='row'>";
				}
				// Fim zebrar
				$html.= "<td align='left' width='20%'>".$row_bol['nome_disc']."</td>";

				if (empty($row_bol['nota_1t'])){
					$html.= "<td>-</td>";
				}else{
					if( $row_bol['nota_1t'] < 6){
						$html.= "<td class='red-not'>".$row_bol['nota_1t']."</td>";
					}else{
					   $html.= "<td>".$row_bol['nota_1t']."</td>"; 
					}                                                                  
				}
				if (empty($row_bol['nota_rec_1t'])){
					$html.= "<td>-</td>";
				}else{
					if( $row_bol['nota_rec_1t'] < 6){
						$html.= "<td class='red-not'>".$row_bol['nota_rec_1t']."</td>";
					}else{
					   $html.= "<td>".$row_bol['nota_rec_1t']."</td>"; 
					}
				}
				$html.= "<td></td>";
				if (empty($row_bol['nota_2t'])){
					$html.= "<td>-</td>";
				}else{
					if( $row_bol['nota_2t'] < 6){
						$html.= "<td class='red-not'>".$row_bol['nota_2t']."</td>";
					}else{
					   $html.= "<td>".$row_bol['nota_2t']."</td>"; 
					} 
				}
				if (empty($row_bol['nota_rec_2t'])){
					$html.= "<td>-</td>";
				}else{
					if( $row_bol['nota_rec_2t'] < 6){
						$html.= "<td class='red-not'>".$row_bol['nota_rec_2t']."</td>";
					}else{
					   $html.= "<td>".$row_bol['nota_rec_2t']."</td>"; 
					}
				}
				$html.= "<td></td>";
				if (empty($row_bol['nota_3t'])){
					$html.= "<td>-</td>";
				}else{
					if( $row_bol['nota_3t'] < 6){
						$html.= "<td class='red-not'>".$row_bol['nota_3t']."</td>";
					}else{
					   $html.= "<td>".$row_bol['nota_3t']."</td>"; 
					} 
				}
				if (empty($row_bol['nota_rec_3t'])){
					$html.= "<td>-</td>";
				}else{
					if( $row_bol['nota_rec_3t'] < 6){
						$html.= "<td class='red-not'>".$row_bol['nota_rec_3t']."</td>";
					}else{
					   $html.= "<td>".$row_bol['nota_rec_3t']."</td>"; 
					}
				}


				$html.= "<td></td>";

				if (empty($row_bol['nota_rec_1t'])){
					$nota_final_1 = $row_bol['nota_1t'];
				}else if ($row_bol['nota_rec_1t'] >= $row_bol['nota_1t']){
					$nota_final_1 = $row_bol['nota_rec_1t'];
				}else if ($row_bol['nota_rec_1t'] < $row_bol['nota_1t']){
					$nota_final_1 = $row_bol['nota_1t'];
				}
				if (empty($row_bol['nota_rec_2t'])){
					$nota_final_2 = $row_bol['nota_2t'];
				}else if ($row_bol['nota_rec_2t'] >= $row_bol['nota_2t']){
					$nota_final_2 = $row_bol['nota_rec_2t'];
				}else if ($row_bol['nota_rec_2t'] < $row_bol['nota_2t']){
					$nota_final_2 = $row_bol['nota_2t'];
				}
				if (empty($row_bol['nota_rec_3t'])){
					$nota_final_3 = $row_bol['nota_3t'];
				}else if ($row_bol['nota_rec_3t'] >= $row_bol['nota_3t']){
					$nota_final_3 = $row_bol['nota_rec_3t'];
				}else if ($row_bol['nota_rec_3t'] < $row_bol['nota_3t']){
					$nota_final_3 = $row_bol['nota_3t'];
				}

				$media_final_decimal = ($nota_final_1 + $nota_final_2 + $nota_final_3) / 3;

				$media_final = number_format($media_final_decimal,1,",",".");

				if((empty($row_bol['nota_1t']))||(empty($row_bol['nota_2t']))||(empty($row_bol['nota_3t']))){
					$media_final = "<i class='fa fa-exclamation-triangle' style='color:red;'></i>";
				}

				$html.= "<td>".$media_final."</td>";

				$html.= "<td></td>";
                
                //Situação na 3ª etapa;
                if ($row_bol['situacao_pre_rf'] == NULL){
                    $html.= "<td class='text-center'>-</td>";
                 }else{
                    $html.= "<td class='text-center'>".$row_bol['situacao_pre_rf']."</td>"; 
                }

				if($media_final == "<i class='fa fa-exclamation-triangle' style='color:red;'></i>"){
					$html.= "<td>-</td>";
					$html.= "<td>-</td>";
				}elseif ($media_final >= 6){
				    $sql_insert_sf     = "update boletim set " ;
				    $sql_insert_sf    .= "situacao_pre_rf='APR', nota_rf=NULL, situacao_pos_rf='APR' ";
					$sql_insert_sf    .= "where matricula_alu = '".$row_bol['matricula_alu']."' ";
					$sql_insert_sf    .= "and id_disc = '".$row_bol['id_disc']."' ";
					$sql_insert_sf    .= "and id_turma = '".$row_bol['id_turma']."'; ";

					$query_insert_sf   = mysqli_query($conexao, $sql_insert_sf);

					$html.= "<td>-</td>";

					if ($query_insert_sf){
						$html.= "<td>".$row_bol['situacao_pos_rf']."</td>"; 
					}else{
						$html.= "<td>ERRO</td></tr>"; 
					}
				}elseif ($media_final < 6){
                                                                        $sql_insert_sf     = "update boletim set " ;
                                                                        $sql_insert_sf    .= "situacao_pre_rf='REC', nota_rf=NULL, situacao_pos_rf=NULL ";
                                                                        $sql_insert_sf    .= "where matricula_alu = '".$matricula_alu."' ";
                                                                        $sql_insert_sf    .= "and id_disc = '".$row_bol['id_disc']."' ";
                                                                        $sql_insert_sf    .= "and id_turma = '".$row_bol['id_turma']."'; ";
                                                                    
                                                                        $query_insert_sf   = mysqli_query($conexao, $sql_insert_sf) /*or die(mysqli_error($conexao))*/;
                                                                        
                                                                        if($row_bol['nota_rf'] == NULL){ //NOTA RECUPERAÇÃO FINAL
                                                                            $html.= "<td class='text-center'>-</td>";
                                                                            $html.= "<td class='text-center'>-</td>";
                                                                        }else{
                                                                            $html.= "<td class='text-center'>".$row_bol['nota_rf']."</td>"; 
                                                                            
                                                                            if ($row_bol['nota_rf'] >= 6){
                                                                                $sql_insert_sf2    = "update boletim set " ;
                                                                                $sql_insert_sf2   .= "situacao_pre_rf='REC', nota_rf='".$row_bol['nota_rf']."', situacao_pos_rf='APR' ";
                                                                                $sql_insert_sf2   .= "where matricula_alu = '".$matricula_alu."' ";
                                                                                $sql_insert_sf2   .= "and id_disc = '".$row_bol['id_disc']."' ";
                                                                                $sql_insert_sf2   .= "and id_turma = '".$row_bol['id_turma']."'; ";

                                                                                $query_insert_sf2  = mysqli_query($conexao, $sql_insert_sf2) /*or die(mysqli_error($conexao))*/;
                                                                                
                                                                                $html.= "<td class='text-center'>".$row_bol['situacao_pos_rf']."</td>";
                                                                            }else{
                                                                               $sql_insert_sf2    = "update boletim set " ;
                                                                                $sql_insert_sf2   .= "situacao_pre_rf='REC', nota_rf='".$row_bol['nota_rf']."', situacao_pos_rf='REP' ";
                                                                                $sql_insert_sf2   .= "where matricula_alu = '".$matricula_alu."' ";
                                                                                $sql_insert_sf2   .= "and id_disc = '".$row_bol['id_disc']."' ";
                                                                                $sql_insert_sf2   .= "and id_turma = '".$row_bol['id_turma']."'; ";

                                                                                $query_insert_sf2  = mysqli_query($conexao, $sql_insert_sf2);
                                                                                
                                                                                $html.= "<td class='text-center'>".$row_bol['situacao_pos_rf']."</td>";
                                                                            }
                                                                        }     
                                                                }                                                 

	$cont++;
	} // Final do While

$html.= '</tbody></table>';
// Fim da Área do HTML PDF
$mpdf->AddPage(
    '','','','','','','','40','','','', 
    '', '', '', '', 
    1, 1, 0, 0
);
$mpdf->WriteHTML($html,2);
$mpdf->Output('boletim.pdf', 'I');
?>