<?php
include("../../base/conexao.php"); // Incluir aquivo de conexão

$quantidade = 10;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;

$valor = $_GET['valor']; // Recebe o valor enviado
$sql = mysql_query("select * from sala where nome_sala like '%".$valor."%' order by nome_sala asc limit $inicio, $quantidade"); // Procura titulos no banco relacionados ao valor
 
while($info = mysql_fetch_array($sql)){ //Transforma o conteúdo da variável $data em um array na variável $info;
                                                                                                
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_sala']."</td>";
                                                echo "<td>".$info['nome_sala']."</td>";
                                                echo "<td>".$info['situacao']."</td>";
                                                echo "<td>".$info['capacidade']."</td>"; 
                                                echo "<td>".$info['tipo']."</td>";
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_sala.php?id_sala=".$info['id_sala']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
                                                            <a class='btn btn-warning' href=view/editar_sala.php?id_sala=".$info['id_sala']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                            <a class='btn btn-danger' onclick='deletaSala(".$info['id_sala'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                          </div>
                                                        </td></tr>";
                                            }
 
header("Content-Type: text/html; charset=utf-8",true); // Acentuação
?>