<?php
include("../../../base/conexao.php"); // Incluir aquivo de conexão

$quantidade = 10;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;

$valor = $_GET['valor']; // Recebe o valor enviado
$sql = mysqli_query($conexao, "select * from unidade_estudantil where nome_ue like '%".$valor."%' order by nome_ue asc limit $inicio, $quantidade"); // Procura titulos no banco relacionados ao valor
 
while($info = mysqli_fetch_array($sql)){ //Transforma o conteúdo da variável $data em um array na variável $info;
                                                                                                
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_ue']."</td>";
                                                echo "<td>".$info['nome_ue']."</td>";
                                                echo "<td>".$info['tel_ue']."</td>";
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_ue.php?id_ue=".$info['id_ue']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
                                                            <a class='btn btn-warning' href=view/editar_ue.php?id_ue=".$info['id_ue']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                            <a class='btn btn-danger' onclick='deletaUe(".$info['id_ue'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                          </div>
                                                        </td></tr>";
                                            }
?>