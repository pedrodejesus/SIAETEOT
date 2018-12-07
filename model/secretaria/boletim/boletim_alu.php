<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'matricula';
include "../../../base/head.php";
require "../../../base/function.php";
?>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                include "../../../base/sidebar/8_sidebar_secretaria.php";
                include("../../../base/conexao.php");
        
                $matricula_alu = $_GET['matricula_alu'];
                $id_turma = $_GET['id_turma'];
                $sql = "call select_disciplinas_aluno_boletim(".$matricula_alu.", ".$id_turma.")";
                $query = mysqli_query($conexao, $sql);
                mysqli_next_result($conexao);
                $row = mysqli_fetch_array($query);
            ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Aluno(a): <b><?php echo $row["nome_alu"]." ".$row["sobrenome_alu"]; ?></b> / Nr.: <b>1</b> - Turma: <b><?php echo $row["numero"] ?></b></h4>
                                            <h5>Matrícula: <b><?php echo $matricula_alu ?></b> - Ano Letivo: <b><?php echo $row["ano_letivo"] ?></b></h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="table-list" class="table-responsive">
                                                <table id="tabela_turma" class="table table-sm table-striped table hover table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" rowspan="2" class="text-center align-middle">Disciplinas</th>
                                                            <th scope="col" colspan="3" class="text-center">1ª Etapa</th>
                                                            <th scope="col" colspan="3" class="text-center">2ª Etapa</th>
                                                            <th scope="col" colspan="3" class="text-center">3ª Etapa</th>
                                                            <th scope="col" colspan="3" class="text-center">Total Anual</th>
                                                            <th scope="col" rowspan="2" class="text-center align-middle">Rec. Final</th>
                                                            <th scope="col" rowspan="2" class="text-center align-middle">Sit. Final</th>
                                                        </tr>
                                                        <tr>
                                                            <th scope="col" class="text-center">Nota</th>
                                                            <th scope="col" class="text-center">Rec.</th>
                                                            <th scope="col" class="text-center">% Faltas</th>
                                                            <th scope="col" class="text-center">Nota</th>
                                                            <th scope="col" class="text-center">Rec.</th>
                                                            <th scope="col" class="text-center">% Faltas</th>
                                                            <th scope="col" class="text-center">Nota</th>
                                                            <th scope="col" class="text-center">Rec.</th>
                                                            <th scope="col" class="text-center">% Faltas</th>
                                                            <th scope="col" class="text-center">Média</th>
                                                            <th scope="col" class="text-center">% Faltas</th>
                                                            <th scope="col" class="text-center">Sit. 3ª etapa</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            mysqli_free_result($query);
                                                
                                                            $sql_bol = "call select_disciplinas_aluno_boletim(".$matricula_alu.", ".$id_turma.")";
                                                            $query_bol = mysqli_query($conexao, $sql_bol) or die(mysqli_error($conexao));
                                                            mysqli_next_result($conexao);
                                                            $mf = 0;
                                                
                                                            while($row_bol = mysqli_fetch_array($query_bol)){  
                                                                
                                                                //Disciplinas
                                                                $disc_len = strlen($row_bol['nome_disc']);
                                                                if($disc_len > 15){ //Se nome_disc tiver mais do que 15 caracteres, mostra a sigla;
                                                                    $row_bol['nome_disc'] = $row_bol['sigla_disc'];
                                                                }
                                                                echo "<tr scope='row'>";
                                                                echo "<td>".$row_bol['nome_disc']."</td>";
                                                                
                                                                //Mostra notas e calcula percentual de faltas
                                                                echo rowBoletim($row_bol['nota_1t'], $row_bol['nota_rec_1t'], $row_bol['aulas_dadas_1t'], $row_bol['faltas_1t']);
                                                                echo rowBoletim($row_bol['nota_2t'], $row_bol['nota_rec_2t'], $row_bol['aulas_dadas_2t'], $row_bol['faltas_2t']);
                                                                echo rowBoletim($row_bol['nota_3t'], $row_bol['nota_rec_3t'], $row_bol['aulas_dadas_3t'], $row_bol['faltas_3t']);
                                                                
                                                                //Define notas finais
                                                                $nota_final_1 = upper($row_bol['nota_1t'], $row_bol['nota_rec_1t']);
                                                                $nota_final_2 = upper($row_bol['nota_2t'], $row_bol['nota_rec_2t']);
                                                                $nota_final_3 = upper($row_bol['nota_3t'], $row_bol['nota_rec_3t']);
                                                                                                                            
                                                                echo totalFinal($row_bol['faltas_1t'], $row_bol['faltas_2t'], $row_bol['faltas_3t'], $row_bol['aulas_dadas_1t'], $row_bol['aulas_dadas_2t'], $row_bol['aulas_dadas_3t']);
                                                                
                                                                if(isset($media_final_round)){
                                                                    $mf += $media_final_round;
                                                                } 
                                                                
                                                                //Situação na 3ª etapa;
                                                                if ($row_bol['situacao_pre_rf'] == NULL){
                                                                    echo "<td class='text-center'>-</td>";
                                                                }else{
                                                                    echo "<td class='text-center'>".$row_bol['situacao_pre_rf']."</td>"; 
                                                                }
                                                                
                                                                if($media_final == "<i class='fa fa-exclamation-triangle' style='color:red;'></i>"){
                                                                    
                                                                    echo "<td class='text-center'>-</td>";
                                                                    echo "<td class='text-center'>-</td>";  
                                                                    
                                                                }elseif ($media_final >= 6){
                                                                    
                                                                    updateSituacaoFinal("'APR'", "NULL", "'APR'", $matricula_alu, $row_bol['id_disc'], $row_bol['id_turma']);
                                                                    echo "<td class='text-center'>-</td>";
                                                                    echo "<td class='text-center'>".$row_bol['situacao_pos_rf']."</td>";
                                                                    
                                                                }elseif ($media_final < 6){
                                                                    
                                                                    updateSituacaoFinal("'REC'", "NULL", "NULL", $matricula_alu, $row_bol['id_disc'], $row_bol['id_turma']);   
                                                                        
                                                                    if($row_bol['nota_rf'] == NULL){ //NOTA RECUPERAÇÃO FINAL
                                                                        
                                                                        echo "<td class='text-center'>-</td>";
                                                                        echo "<td class='text-center'>-</td>";
                                                                        
                                                                    }else{
                                                                        echo "<td class='text-center'>".$row_bol['nota_rf']."</td>"; 
                                                                            
                                                                        if ($row_bol['nota_rf'] >= 6){                                                                              
                                                                            updateSituacaoFinal("'REC'", $row_bol['nota_rf'], "'APR'", $matricula_alu, $row_bol['id_disc'], $row_bol['id_turma']);
                                                                                
                                                                            echo "<td class='text-center'>".$row_bol['situacao_pos_rf']."</td>";
                                                                            
                                                                        }else{
                                                                                
                                                                            updateSituacaoFinal("'REC'", $row_bol['nota_rf'], "'REP'", $matricula_alu, $row_bol['id_disc'], $row_bol['id_turma']);
                                                                                
                                                                            echo "<td class='text-center'>".$row_bol['situacao_pos_rf']."</td>";
                                                                            
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                
                                                            echo "<tr><td><b>SITUAÇÃO GLOBAL DO ALUNO</b></td>";
                                                
                                                            echo "<td class='text-center'>".mediaGlobalTrim($matricula_alu, $id_turma, "1t")."</td>";
                                                            echo "<td class='text-center'>-</td>";
                                                            
                                                            echo "<td class='text-center'>".number_format(totalFaltasTrim($matricula_alu, $id_turma, "1t"),1,",",".")."%</td>";
                                                
                                                            echo "<td class='text-center'>".mediaGlobalTrim($matricula_alu, $id_turma, "3t")."</td>";
                                                            echo "<td class='text-center'>-</td>";
                                                
                                                            echo "<td class='text-center'>".number_format(totalFaltasTrim($matricula_alu, $id_turma, "2t"),1,",",".")."%</td>";
                                                
                                                            echo "<td class='text-center'>".mediaGlobalTrim($matricula_alu, $id_turma, "3t")."</td>";
                                                            echo "<td class='text-center'>-</td>";
                                                
                                                            echo "<td class='text-center'>".number_format(totalFaltasTrim($matricula_alu, $id_turma, "3t"),1,",",".")."%</td>";   
                                                
                                                            $media_global = $mf / mysqli_num_rows($query_bol);
                                                
                                                            $faltas_global = (totalFaltasTrim($matricula_alu, $id_turma, "1t") + totalFaltasTrim($matricula_alu, $id_turma, "2t") + totalFaltasTrim($matricula_alu, $id_turma, "3t")) / 3;
                                                
                                                            //echo "<td class='text-center'>".$media_final."</td>";
                                                            echo "<td class='text-center'>".number_format($media_global,1,",",".")."</td>";
                                                            echo "<td class='text-center'>".number_format($faltas_global, 1, ",", ".")."%</td>";
                                                            echo "<td class='text-center'>-</td>";
                                                            echo "<td class='text-center'>-</td>";
                                                            echo "<td class='text-center'>-</td>"; //TODO: Média global de médias e de faltas;
                                                
                                                            echo "</tr>";
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <a class='btn btn-primary' target="_blank" <?php echo"href='pdf_boletim_alu.php?matricula_alu=".$matricula_alu."&id_turma=".$id_turma."'"; ?> ><i class='fal fa-print'></i>&nbsp; Imprimir</a>   
                                                
                                                <a class='btn btn-light' href='../matriculado/view/visualizar_mat.php?matricula_alu=<?php echo $matricula_alu ?>'><i class='fa fa-undo'></i>&nbsp; Voltar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>