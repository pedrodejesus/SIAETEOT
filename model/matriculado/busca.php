<?php
include("../../base/conexao.php"); // Incluir aquivo de conexão

$quantidade = 10;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;

$valor = $_GET['valor']; // Recebe o valor enviado
$sql  = ("select distinct m.tipo_matricula, m.dt_matricula, m.matricula_alu, m.id_turma, ");
$sql .= ("a.matricula_alu, a.nome_alu, a.sobrenome_alu, ");
$sql .= ("t.id_turma, t.numero, t.ano_letivo ");
$sql .= ("from matriculado m, aluno a, turma t ");
$sql .= ("where m.matricula_alu = a.matricula_alu ");
$sql .= ("and m.id_turma = t.id_turma ");
$sql .= ("and m.remat = 0 ");
$sql .= ("and (a.nome_alu like '%".$valor."%' or sobrenome_alu like '%".$valor."%') order by ano_letivo desc, nome_alu asc, sobrenome_alu asc limit $inicio, $quantidade"); // Procura titulos no banco relacionados ao valor
$query = mysqli_query($conexao, $sql);
 
while ($info = mysqli_fetch_array($query)) { // Exibe todos os valores encontrados
	echo "<tr scope='row'>";
                                                echo "<td>".$info['matricula_alu']."</td>";
                                                echo "<td>".$info['nome_alu']." ".$info['sobrenome_alu']."</td>";
                                                echo "<td>".implode("/", array_reverse(explode("-", $info['dt_matricula'])))."</td>";
                                                switch($info['tipo_matricula']){
                                                    case "1";
                                                        echo "<td>Integrado</td>";
                                                        break;
                                                    case "2";
                                                        echo "<td>Subsequente</td>";
                                                        break;
                                                }
                                                echo "<td>".$info['numero']."</td>";
                                                echo "<td>".$info['ano_letivo']."</td>";
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_mat.php?matricula_alu=".$info['matricula_alu']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
                                                            <a class='btn btn-warning' href=view/editar_mat.php?matricula_mat=".$info['matricula_alu']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                            <a class='btn btn-danger' onclick='deletaAlu(".$info['matricula_alu'].")' sql-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                          </div>
                                                        </td></tr>";
}
?>