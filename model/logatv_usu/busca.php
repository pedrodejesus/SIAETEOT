<?php
include("../../base/conexao.php"); // Incluir aquivo de conexão

$quantidade = 10;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;

$valor = $_GET['valor']; // Recebe o valor enviado
$sql = mysql_query("select * from usuario where nome_usu like '%".$valor."%' or usuario like '%".$valor."%' order by nome_usu asc limit $inicio, $quantidade"); // Procura titulos no banco relacionados ao valor
 
while($info = mysql_fetch_array($sql)){ //Transforma o conteúdo da variável $data em um array na variável $info;
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_usu']."</td>";
                                                echo "<td>".$info['nome_usu']."</td>";
                                                echo "<td>".$info['usuario']."</td>"; 
                                                //echo "<td>".$info['senha']."</td>";
                                                echo "<td>".$info['email']."</td>";
                                                echo "<td>".$info['nivel']."</td>";
                                                if($info['ativo'] == 1){
									               echo "<td>SIM</td>";
								                }else if($info['ativo'] == 0){
									               echo "<td>NÃO</td>";
								                }
                                                //echo "<td>".implode("/", array_reverse(explode("-", $info['dt_cadastro'])))."</td>";
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_usu.php?id_usu=".$info['id_usu']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
                                                            <a class='btn btn-warning' href=view/editar_usu.php?id_usu=".$info['id_usu']."><i class='fa fa-edit'></i>&nbsp; Editar</a>";
                                                if($info['ativo'] == 1){
									               echo "<a class='btn btn-danger' href=controller/block_ativa_usu.php?id_usu=".$info['id_usu']."&block_ativa=0><i class='fa fa-lock'></i>&nbsp; Bloquear</a>";
								                }else if($info['ativo'] == 0){
									               echo "<a class='btn btn-success' href=controller/block_ativa_usu.php?id_usu=".$info['id_usu']."&block_ativa=1><i class='fa fa-unlock'></i>&nbsp; Desbloquear</a>";
								                }
                                                echo "<a class='btn btn-danger' onclick='deletaUsu(".$info['id_usu'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a></div></td></tr>";
                                            }
 
header("Content-Type: text/html; charset=utf-8",true); // Acentuação
?>