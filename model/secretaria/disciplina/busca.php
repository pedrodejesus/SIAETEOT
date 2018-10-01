<?php
include("../../../base/conexao.php"); // Incluir aquivo de conexão

$quantidade = 10;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;

$valor = $_GET['valor']; // Recebe o valor enviado
$sql = mysqli_query($conexao, "select * from disciplina where nome_disc like '%".$valor."%' order by nome_disc asc limit $inicio, $quantidade"); // Procura titulos no banco relacionados ao valor
 
while($info = mysqli_fetch_array($sql)){ //Transforma o conteúdo da variável $data em um array na variável $info;
                                                
                                                $data_cur = mysqli_query($conexao, "select * from curso where id_cur = '".$info["id_cur"]."';") or die(mysql_error());
                                                $info_cur = mysqli_fetch_array($data_cur);
                                                
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_disc']."</td>";
                                                echo "<td>".$info['nome_disc']."</td>";
                                                echo "<td>".$info['sigla_disc']."</td>";
                                                echo "<td>".$info_cur['nome_cur']."</td>";
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_disc.php?id_disc=".$info['id_disc']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
                                                            <a class='btn btn-warning' href=view/editar_disc.php?id_disc=".$info['id_disc']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                            <a class='btn btn-danger' onclick='deletaDisc(".$info['id_disc'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                          </div>
                                                        </td></tr>";
                                            }
?>