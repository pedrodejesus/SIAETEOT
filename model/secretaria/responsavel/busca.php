<?php
include("../../../base/conexao.php"); // Incluir aquivo de conex�o

$quantidade = 10;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;

$valor = $_GET['valor']; // Recebe o valor enviado
$sql = mysqli_query($conexao, "select * from responsavel where concat(nome_resp, sobrenome_resp) like '%".$valor."%' order by nome_resp asc limit $inicio, $quantidade"); // Procura titulos no banco relacionados ao valor
 
while($info = mysqli_fetch_array($sql)){
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_resp']."</td>";
                                                echo "<td>".$info['nome_resp']."</td>";
                                                echo "<td>".$info['sobrenome_resp']."</td>"; 
                                                echo "<td>".$info['cpf_resp']."</td>";
                                                echo "<td>".$info['cel_resp']."</td>";
                                                echo "<td>".$info['tel_resp']."</td>";
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_resp.php?id_resp=".$info['id_resp']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
                                                            <a class='btn btn-warning' href=view/editar_resp.php?id_resp=".$info['id_resp']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                            <a class='btn btn-danger' onclick='deletaResp(".$info['id_resp'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                          </div>
                                                        </td></tr>";
                                            }
?>