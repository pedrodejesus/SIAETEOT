<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if ($_SESSION['UsuarioNivel'] != 1) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'boletim';
require "../../../base/function.php";
include "../../../base/head.php";
?>
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
<script src="\siaeteot/assets/js/jquery-migrate-1.4.1"></script>
<script type="text/javascript" src="search.js"></script>
</head>
<body class="sidebar-fixed header-fixed">
    <?php //include "modal.php" ?>
    <div class="page-wrapper">
    <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                include "../../../base/conexao.php";
                include "../../../base/sidebar/1_sidebar_aluno.php";
    
                $matricula_alu = $_GET['matricula_alu'];
                $sql  = "select distinct ano_letivo, id_turma from matriculado where matricula_alu = $matricula_alu order by ano_letivo desc";
                $query = mysqli_query($conexao, $sql); 
            ?>
            <div class="content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light">
                        <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Boletim</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php
                                while($row = mysqli_fetch_array($query)){
                                    echo '<li class="nav-item">';
                                    echo '<a class="nav-link ';
                                    if(!isset($primeiro)){
                                        echo 'active';
                                    }
                                    echo '" data-toggle="tab" href="#'.$row['ano_letivo'].'" role="tab" aria-controls="'.$row['ano_letivo'].'">'.$row['ano_letivo'].'</a>';
                                    echo '</li>';
                                    $primeiro = 1;
                                }
                                unset($primeiro);
                            ?>
                            <!--<li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#home" role="tab" aria-controls="home">Frequência</a>
                            </li>-->
                        </ul>

                        <div class="tab-content">
                            <?php
                                $query2 = mysqli_query($conexao, $sql);
                                while($row2 = mysqli_fetch_array($query2)){
                                    echo '<div class="tab-pane '; if(!isset($primeiro)){echo'active';} echo '" id="'.$row2['ano_letivo'].'" role="tabpanel">';
                                    
                                    $sql_bol = "call select_disciplinas_aluno_boletim($matricula_alu, ".$row2['id_turma'].")";
                                    $query_bol = mysqli_query($conexao, $sql_bol) or die(mysqli_error($conexao));
                                    mysqli_next_result($conexao);
                                    $row_bol = mysqli_fetch_array($query_bol);
                                    //echo $sql_bol;
                                    $id_turma = $row2['id_turma'];
                            ?>
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h4>Aluno(a): <b><?php echo $row_bol["nome_alu"]." ".$row_bol["sobrenome_alu"]; ?></b> / Nr.: <b>1</b> - Turma: <b><?php echo $row_bol["numero"] ?></b></h4>
                                                    <h5>Matrícula: <b><?php echo $matricula_alu ?></b> - Ano Letivo: <b><?php echo $row_bol["ano_letivo"] ?></b></h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <a <?php echo"href='pdf_boletim_alu.php?matricula_alu=".$matricula_alu."&id_turma=".$row_bol["id_turma"]."'"; ?>  target="_blank"><button id='add' type="button" class='btn btn-sm btn-primary'><i class="fal fa-print"></i>&nbsp; Imprimir</button></a>
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
                                                                    mysqli_free_result($query_bol);
                                                
                                                                    $sql_bol2 = "call select_disciplinas_aluno_boletim($matricula_alu, ".$row2['id_turma'].")";
                                                                    $query_bol2 = mysqli_query($conexao, $sql_bol2) or die(mysqli_error($conexao));
                                                                    mysqli_next_result($conexao);
                                                                    
                                                                    while ($row_bol2 = mysqli_fetch_array($query_bol2)) {
                                                                        //Disciplinas
                                                                        $disc_len = strlen($row_bol2['nome_disc']);
                                                                        if($disc_len > 15){ //Se nome_disc tiver mais do que 15 caracteres, mostra a sigla;
                                                                            $row_bol2['nome_disc'] = $row_bol2['sigla_disc'];
                                                                        }
                                                                        echo "<tr scope='row'>";
                                                                        echo "<td>".$row_bol2['nome_disc']."</td>";

                                                                        //Mostra notas e calcula percentual de faltas
                                                                        echo rowBoletim($row_bol2['nota_1t'], $row_bol2['nota_rec_1t'], $row_bol2['aulas_dadas_1t'], $row_bol2['faltas_1t']);
                                                                        echo rowBoletim($row_bol2['nota_2t'], $row_bol2['nota_rec_2t'], $row_bol2['aulas_dadas_2t'], $row_bol2['faltas_2t']);
                                                                        echo rowBoletim($row_bol2['nota_3t'], $row_bol2['nota_rec_3t'], $row_bol2['aulas_dadas_3t'], $row_bol2['faltas_3t']);

                                                                        //Define notas finais
                                                                        $nota_final_1 = upper($row_bol2['nota_1t'], $row_bol2['nota_rec_1t']);
                                                                        $nota_final_2 = upper($row_bol2['nota_2t'], $row_bol2['nota_rec_2t']);
                                                                        $nota_final_3 = upper($row_bol2['nota_3t'], $row_bol2['nota_rec_3t']);

                                                                        echo totalFinal($row_bol2['faltas_1t'], $row_bol2['faltas_2t'], $row_bol2['faltas_3t'], $row_bol2['aulas_dadas_1t'], $row_bol2['aulas_dadas_2t'], $row_bol2['aulas_dadas_3t']);
                                                                        
                                                                        if(isset($media_final_round)){
                                                                            $mf += $media_final_round;
                                                                        }

                                                                        //Situação na 3ª etapa;
                                                                        if ($row_bol2['situacao_pre_rf'] == NULL){
                                                                            echo "<td class='text-center'>-</td>";
                                                                        }else{
                                                                            echo "<td class='text-center'>".$row_bol2['situacao_pre_rf']."</td>"; 
                                                                        }

                                                                        if($media_final == "<i class='fa fa-exclamation-triangle' style='color:red;'></i>"){

                                                                            echo "<td class='text-center'>-</td>";
                                                                            echo "<td class='text-center'>-</td>";  

                                                                        }elseif ($media_final >= 6){

                                                                            updateSituacaoFinal("'APR'", "NULL", "'APR'", $matricula_alu, $row_bol2['id_disc'], $row_bol2['id_turma']);
                                                                            echo "<td class='text-center'>-</td>";
                                                                            echo "<td class='text-center'>".$row_bol2['situacao_pos_rf']."</td>";

                                                                        }elseif ($media_final < 6){

                                                                            updateSituacaoFinal("'REC'", "NULL", "NULL", $matricula_alu, $row_bol2['id_disc'], $row_bol2['id_turma']);   

                                                                            if($row_bol2['nota_rf'] == NULL){ //NOTA RECUPERAÇÃO FINAL

                                                                                echo "<td class='text-center'>-</td>";
                                                                                echo "<td class='text-center'>-</td>";

                                                                            }else{
                                                                                echo "<td class='text-center'>".$row_bol2['nota_rf']."</td>"; 

                                                                                if ($row_bol2['nota_rf'] >= 6){                                                                              
                                                                                    updateSituacaoFinal("'REC'", $row_bol2['nota_rf'], "'APR'", $matricula_alu, $row_bol2['id_disc'], $row_bol2['id_turma']);

                                                                                    echo "<td class='text-center'>".$row_bol2['situacao_pos_rf']."</td>";

                                                                                }else{

                                                                                    updateSituacaoFinal("'REC'", $row_bol2['nota_rf'], "'REP'", $matricula_alu, $row_bol2['id_disc'], $row_bol2['id_turma']);

                                                                                    echo "<td class='text-center'>".$row_bol2['situacao_pos_rf']."</td>";

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
                                                
                                                            $media_global = $mf / mysqli_num_rows($query_bol2);
                                                
                                                            $faltas_global = (totalFaltasTrim($matricula_alu, $id_turma, "1t") + totalFaltasTrim($matricula_alu, $id_turma, "2t") + totalFaltasTrim($matricula_alu, $id_turma, "3t")) / 3;
                                                
                                                            //echo "<td class='text-center'>".$media_final."</td>";
                                                            echo "<td class='text-center'>".number_format($media_global,1,",",".")."</td>";
                                                            echo "<td class='text-center'>".number_format($faltas_global, 1, ",", ".")."%</td>";
                                                            echo "<td class='text-center'>-</td>";
                                                            echo "<td class='text-center'>-</td>";
                                                            echo "<td class='text-center'>-</td>"; //TODO: Média global de médias e de faltas;      
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="row">
                                                <div class="col-md-4">
                                                    <div class="btn-group" role="group"> 
                                                        <a class='btn btn-primary' target="_blank" <?php echo"href='pdf_boletim_alu.php?matricula_alu=".$matricula_alu."&id_turma=".$id_turma."'"; ?> ><i class='fal fa-print'></i>&nbsp; Imprimir</a>   

                                                        <a class='btn btn-light' href='../lista_matriculado.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>
                                                    </div>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                            <?php
                                    
                                    echo '</div>';
                                    $primeiro = 1;
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </div>    
    
    <script src="\siaeteot/assets/js/popper.min.js"></script>
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="\siaeteot/assets/js/function-delete.js"></script>
    <script src="\siaeteot/assets/js/function-search.js"></script>
    <script src="\siaeteot/assets/js/chart.min.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
    <script src="\siaeteot/assets/js/demo.js"></script>
</body>

</html>
