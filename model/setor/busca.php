<?php
include("../../base/conexao.php"); // Incluir aquivo de conex�o

$quantidade = 10;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;

$valor = $_GET['valor']; // Recebe o valor enviado
$sql = mysql_query("select * from setor where nome_setor like '%".$valor."%' order by nome_setor asc limit $inicio, $quantidade"); // Procura titulos no banco relacionados ao valor
 
while($info = mysql_fetch_array($sql)){ //Transforma o conte�do da vari�vel $data em um array na vari�vel $info;
                                                                                                
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_setor']."</td>";
                                                echo "<td>".$info['nome_setor']."</td>";
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_setor.php?id_setor=".$info['id_setor']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
                                                            <a class='btn btn-warning' href=view/editar_setor.php?id_setor=".$info['id_setor']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                            <a class='btn btn-danger' onclick='deletaSetor(".$info['id_setor'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                          </div>
                                                        </td></tr>";
                                            }
 
header("Content-Type: text/html; charset=utf-8",true); // Acentua��o
?>