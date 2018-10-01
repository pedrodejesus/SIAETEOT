<?php
include("../../../base/conexao.php"); // Incluir aquivo de conexão
//header("Content-Type: text/html; charset=utf-8",true); // Acentuação

$quantidade = 10;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;

$valor = $_GET['valor']; // Recebe o valor enviado
$sql = mysqli_query($conexao, "select * from funcionario where nome_func like '%".$valor."%' or sobrenome_func like '%".$valor."%' order by nome_func asc limit $inicio, $quantidade"); // Procura titulos no banco relacionados ao valor
 
while ($info = mysqli_fetch_array($sql)) { //Transforma o conte�do da vari�vel $data em um array na variável $info;
    echo "<tr scope='row'>";
    echo "<td>".$info['id_func']."</td>";
    echo "<td>".$info['nome_func']."</td>";
    echo "<td>".$info['sobrenome_func']."</td>"; 
    echo "<td>".$info['cpf_func']."</td>";
    echo "<td>".implode("/", array_reverse(explode("-", $info['dt_nasc_func'])))."</td>";
    echo "<td>".$info['cep']."</td>";
    echo "<td><div class='btn-group btn-group-sm' role='group'>
            <a class='btn btn-success' href=view/visualizar_func.php?id_func=".$info['id_func']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
            <a class='btn btn-warning' href=view/editar_func.php?id_func=".$info['id_func']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
            <a class='btn btn-danger' onclick='deletaFunc(".$info['id_func'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
          </div></td></tr>";
}

