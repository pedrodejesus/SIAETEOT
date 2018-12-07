<?php

function pagination($pk, $table){ //Função para exibir os controles de paginação na listagem;
    global $conexao, $quantidade, $pagina, $inicio;
    
    $sqlTotal 		= "select $pk from $table;";
                                                
    $qrTotal  		= mysqli_query($conexao, $sqlTotal) or die (mysql_error());
    $numTotal 		= mysqli_num_rows($qrTotal);
    $totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

    $exibir = 3;
    $anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
    $posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;

    echo "<li class='page-item'><a class='page-link' href='?pagina=1'> Primeira</a></li> "; 
    echo "<li class='page-item'><a class='page-link' href=\"?pagina=$anterior\">&laquo;</a></li> ";
    echo '<li class="page-item"><a class="page-link" href="?pagina='.$pagina.'"><strong>'.$pagina.'</strong></a></li> ';

    for($i = $pagina+1; $i < $pagina+$exibir; $i++){
        if($i <= $totalpagina){
            echo '<li class="page-item"><a class="page-link" href="?pagina='.$i.'"> '.$i.' </a></li> '; 
        }    
    }   

    echo "<li class='page-item'><a class='page-link' href=\"?pagina=$posterior\">&raquo;</a></li> ";
    echo "<li class='page-item'><a class='page-link' href=\"?pagina=$totalpagina\">Última</a></li>";
}

function ano_letivo(){ //Função para exibir todos os anos letivos da tabela matriculado
    global $conexao;
    
    $query = mysqli_query($conexao, "select distinct ano_letivo from turma order by ano_letivo desc");
    while($array = mysqli_fetch_array($query)){
        echo "<option value='".$array['ano_letivo']."'>".$array['ano_letivo']."</option>";
    }
}

function curso(){
    echo'<option value="0">Administração</option>
         <option value="3">Análises Clínicas</option>
         <option value="4">Gerência em Saúde</option>
         <option value="5">Informática para Internet</option>';
}

/* Funçoes do boletim
*/

function upper($a, $b){
    if(empty($b) or $a >= $b){
        $n = $a;
    }elseif ($b > $a){
        $n = $b;
    }
    return $n;
}

function rowBoletim($nota, $rec, $aulas, $faltas){

    if (empty($nota)){
        $retorno = "<td class='text-center'>-</td>";
    }else{
        if($nota < 6){
            $retorno = "<td style='background-color:#CC0000;color:#FFF;' class='text-center'>".number_format($nota,1,",",".")."</td>";
        }else{
            $retorno = "<td class='text-center'>".number_format($nota,1,",",".")."</td>"; 
        }                                                                  
    } //Checa nota normal
    
    if (empty($rec)){
        $retorno .= "<td class='text-center'>-</td>";
    }else{
        if($rec < 6){
            $retorno .= "<td style='background-color:#CC0000;color:#FFF;' class='text-center'>".number_format($rec,1,",",".")."</td>";
        }else{
            $retorno .= "<td class='text-center'>".number_format($rec,1,",",".")."</td>"; 
        }
    } //Checa recuperação
    
    if($aulas <> null and $faltas <> null){
        $percent_faltas1t = $faltas * 100 / $aulas;
    }                                                      
    $retorno .= "<td class='text-center'>";
        if($aulas <> null and $faltas <> null){
            $retorno .= number_format($percent_faltas1t,1,",",".")."%";
        }
    $retorno .= "</td>"; //Calcula e mostra percentual de faltas
    
    return $retorno;    
}

function totalFinal($faltas1t, $faltas2t, $faltas3t, $aulas1t, $aulas2t, $aulas3t){
    
    global $media_final, $media_final_round, $nota_final_1, $nota_final_2, $nota_final_3;
    
    if((empty($nota_final_1))||(empty($nota_final_2))||(empty($nota_final_2))){ //Se não houver nota para gerar média, mostra um alerta;
        $media_final = "<i class='fa fa-exclamation-triangle' style='color:red;'></i>";
    } else{
        $media_final_decimal = ($nota_final_1 + $nota_final_2 + $nota_final_3) / 3;
        $media_final_round = round($media_final_decimal / 0.5) * 0.5;
        $media_final = number_format($media_final_round,1,",",".");
    }
    
    $retorno = "<td><center>".$media_final."</center></td>";
    
    if(!empty($faltas1t) and !empty($faltas2t) and !empty($faltas3t) and !empty($aulas1t) and !empty($aulas2t) and !empty($aulas3t)){
        $totalFaltas = $faltas1t + $faltas2t + $faltas3t;
        $totalAulas = $aulas1t + $aulas2t + $aulas3t;
        $percentAnual = $totalFaltas * 100 / $totalAulas;
        $retorno .= "<td class='text-center'>";
        $retorno .= number_format($percentAnual,1,",",".")."%";
        $retorno .= "</td>"; //Faltas totais;
    }else{
        $retorno .= "<td></td>";
    }
    
    return $retorno;    
}

function updateSituacaoFinal($situacao_pre_rf, $nota_rf, $situacao_pos_rf, $mat, $disc, $tur){ 
    global $conexao;
    
    $sql  = "update boletim set " ;
    $sql .= "situacao_pre_rf=$situacao_pre_rf, nota_rf=$nota_rf, situacao_pos_rf=$situacao_pos_rf ";
    $sql .= "where matricula_alu = $mat ";
    $sql .= "and id_disc = $disc ";
    $sql .= "and id_turma = $tur;";
    
    $query = mysqli_query($conexao, $sql);
}

function totalFaltasTrim($mat, $tur, $trim){
    global $conexao;
    
    $sql  = "select sum(faltas_$trim) * 100 / sum(aulas_dadas_$trim)";
    $sql .= "from boletim where matricula_alu = $mat and id_turma = $tur";
    
    $query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    $array = mysqli_fetch_array($query);
    
    return $array[0];
}

function mediaGlobalTrim($mat, $tur, $trim){
    global $conexao;
    
    $sql  = "select round((sum(nota_$trim) / (select count(id_disc) from boletim where matricula_alu = $mat and id_turma = $tur)), 1)";
    $sql .= "from boletim where matricula_alu = $mat and id_turma = $tur";
    
    $query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
    $array = mysqli_fetch_array($query);
    
    return $array[0];
}
    
/* 
Fim funçoes do boletim*/

?>