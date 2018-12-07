<?php
/*include "base/head.php";

function button($text, $icon, $link, $style){
    $btn = "<a class='btn btn-$style' href='$link'><i class='far fa-$icon'></i>&nbsp; $text</a>";
    return $btn; 
}

echo button("Voltar", "undo", "index.php", "light");
echo button("Adicionar", "plus", "index.php", "info");
echo button("Excluir", "trash", "index.php", "danger");*/
/*
function upper($a, $b){
    if(empty($b) or $a >= $b){
        $n = $a;
    }elseif ($b > $a){
        $n = $b;
    }
    return $n;
}
*/
/*$a = "<i class='fa fa-exclamation-triangle' style='color:red;'></i>";
if(gettype($a) == "string"){
    echo "OK";
}*/

/*function updateSituacaoFinal($situacao_pre_rf, $nota_rf, $situacao_pos_rf, $mat, $disc, $tur){ 
    global $conexao;
    
    $sql  = "update boletim set " ;
    $sql .= "situacao_pre_rf=$situacao_pre_rf, nota_rf=$nota_rf, situacao_pos_rf=$situacao_pos_rf ";
    $sql .= "where matricula_alu = $mat ";
    $sql .= "and id_disc = $disc ";
    $sql .= "and id_turma = $tur;";
    
    //$query = mysqli_query($conexao, $sql);
    return $sql;
}

echo updateSituacaoFinal("'REC'", "NULL", "NULL", 181014443100, 44, 1);*/

?>

