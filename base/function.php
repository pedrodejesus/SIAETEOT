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

function upper($a, $b){
    if(empty($b) or $a >= $b){
        $n = $a;
    }elseif ($b > $a){
        $n = $b;
    }
    return $n;
}

?>