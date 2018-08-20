<?php
include("../../base/conexao.php"); // Incluir aquivo de conexão

$quantidade = 10;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;

$valor = $_GET['valor']; // Recebe o valor enviado
$sql = mysql_query("select * from turma where numero like '%".$valor."%' or ano_letivo LIKE '%".$valor."%' order by numero asc limit $inicio, $quantidade"); // Procura titulos no banco relacionados ao valor
 
while($info = mysql_fetch_array($sql)){                                   
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_turma']."</td>";
                                                echo "<td>".$info['numero']."</td>";
                                                echo "<td>".$info['ano_letivo']."</td>";
                                                switch($info['situacao']){
                                                    case 1:
                                                        echo "<td>Ativa</td>"; 
                                                        break;
                                                    case 0:
                                                        echo "<td>Encerrada</td>";
                                                        break;
                                                }
                                                switch($info['turno']){
                                                    case 1:
                                                        echo "<td>Manhã</td>"; 
                                                        break;
                                                    case 2:
                                                        echo "<td>Tarde</td>";
                                                        break;
                                                    case 3:
                                                        echo "<td>Noite/td>";
                                                        break;
                                                }
                                                switch($info['id_cur']){
                                                    case 0:
                                                        echo "<td>Administração</td>"; 
                                                        break;
                                                    case 3:
                                                        echo "<td>Análises Clínicas</td>";
                                                        break;
                                                    case 4:
                                                        echo "<td>Gerência em Saúde</td>";
                                                        break;
                                                    case 5:
                                                        echo "<td>Informática para Internet</td>";
                                                        break;
                                                }
                                                echo "<td>".implode("/", array_reverse(explode("-", $info['dt_inicio'])))."</td>";
                                                switch($info['dt_fim']){
                                                    case 0:
                                                        echo "<td>Presente</td>";
                                                        break;
                                                    default:
                                                        echo "<td>".implode("/", array_reverse(explode("-", $info['dt_fim'])))."</td>";
                                                }  
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_turma.php?id_turma=".$info['id_turma']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                                                                        
                                                            <a class='btn btn-warning' href=view/editar_turma.php?id_turma=".$info['id_turma']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                            <a class='btn btn-danger' onclick='deletaTurma(".$info['id_turma'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                          </div>
                                                        </td></tr>";
                                            }
header("Content-Type: text/html; charset=utf-8",true); // Acentuação
?>