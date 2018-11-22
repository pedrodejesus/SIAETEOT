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
                                                            
                                                            while($row_bol = mysqli_fetch_array($query_bol)){  
                                                                
                                                                //Disciplinas
                                                                $disc_len = strlen($row_bol['nome_disc']);
                                                                if($disc_len > 15){ //Se nome_disc tiver mais do que 15 caracteres, mostra a sigla;
                                                                    $row_bol['nome_disc'] = $row_bol['sigla_disc'];
                                                                }
                                                                echo "<tr scope='row'>";
                                                                echo "<td>".$row_bol['nome_disc']."</td>";
                                                                
                                                                //Primeiro Trimestre
                                                                if (empty($row_bol['nota_1t'])){
                                                                    echo "<td class='text-center'>-</td>";
                                                                }else{
                                                                    if( $row_bol['nota_1t'] < 6){
                                                                        echo "<td style='background-color:red;color:#FFF;' class='text-center'>".$row_bol['nota_1t']."</td>";
                                                                    }else{
                                                                       echo "<td class='text-center'>".$row_bol['nota_1t']."</td>"; 
                                                                    }                                                                  
                                                                }
                                                                if (empty($row_bol['nota_rec_1t'])){
                                                                    echo "<td class='text-center'>-</td>";
                                                                }else{
                                                                    if( $row_bol['nota_rec_1t'] < 6){
                                                                        echo "<td style='background-color:red;color:#FFF;' class='text-center'>".$row_bol['nota_rec_1t']."</td>";
                                                                    }else{
                                                                       echo "<td class='text-center'>".$row_bol['nota_rec_1t']."</td>"; 
                                                                    }
                                                                }
                                                                
                                                                if($row_bol['aulas_dadas_1t'] <> null and $row_bol['faltas_1t'] <> null){
                                                                    $percent_faltas1t = $row_bol['faltas_1t'] * 100 / $row_bol['aulas_dadas_1t'];
                                                                }
                                                                
                                                                echo "<td class='text-center'>";
                                                                if($row_bol['aulas_dadas_1t'] <> null and $row_bol['faltas_1t'] <> null){
                                                                    echo number_format($percent_faltas1t,1,",",".")."%";
                                                                }
                                                                echo"</td>"; //Presença 1T
                                                                
                                                                //Segundo Trimestre
                                                                if (empty($row_bol['nota_2t'])){
                                                                    echo "<td class='text-center'>-</td>";
                                                                }else{
                                                                    if( $row_bol['nota_2t'] < 6){
                                                                        echo "<td style='background-color:red;color:#FFF;' class='text-center'>".$row_bol['nota_2t']."</td>";
                                                                    }else{
                                                                       echo "<td class='text-center'>".$row_bol['nota_2t']."</td>"; 
                                                                    } 
                                                                }
                                                                if (empty($row_bol['nota_rec_2t'])){
                                                                    echo "<td class='text-center'>-</td>";
                                                                }else{
                                                                    if( $row_bol['nota_rec_2t'] < 6){
                                                                        echo "<td style='background-color:red;color:#FFF;' class='text-center'>".$row_bol['nota_rec_2t']."</td>";
                                                                    }else{
                                                                       echo "<td class='text-center'>".$row_bol['nota_rec_2t']."</td>"; 
                                                                    }
                                                                }
                                                                
                                                                if($row_bol['aulas_dadas_2t'] <> null and $row_bol['faltas_2t'] <> null){
                                                                    $percent_faltas2t = $row_bol['faltas_2t'] * 100 / $row_bol['aulas_dadas_2t'];
                                                                }
                                                                echo "<td class='text-center'>";
                                                                if($row_bol['aulas_dadas_2t'] <> null and $row_bol['faltas_2t'] <> null){
                                                                    echo number_format($percent_faltas2t,1,",",".")."%";
                                                                }
                                                                echo"</td>"; //Presença 2T
                                                                
                                                                //Terceiro Trimestre
                                                                if (empty($row_bol['nota_3t'])){
                                                                    echo "<td class='text-center'>-</td>";
                                                                }else{
                                                                    if( $row_bol['nota_3t'] < 6){
                                                                        echo "<td style='background-color:red;color:#FFF;' class='text-center'>".$row_bol['nota_3t']."</td>";
                                                                    }else{
                                                                       echo "<td class='text-center'>".$row_bol['nota_3t']."</td>"; 
                                                                    } 
                                                                }
                                                                if (empty($row_bol['nota_rec_3t'])){
                                                                    echo "<td class='text-center'>-</td>";
                                                                }else{
                                                                    if( $row_bol['nota_rec_3t'] < 6){
                                                                        echo "<td style='background-color:red;color:#FFF;' class='text-center'>".$row_bol['nota_rec_3t']."</td>";
                                                                    }else{
                                                                       echo "<td class='text-center'>".$row_bol['nota_rec_3t']."</td>"; 
                                                                    }
                                                                }
                                                                if($row_bol['aulas_dadas_3t'] <> null and $row_bol['faltas_3t'] <> null){
                                                                    $percent_faltas3t = $row_bol['faltas_3t'] * 100 / $row_bol['aulas_dadas_3t'];
                                                                }
                                                                echo "<td class='text-center'>";
                                                                if($row_bol['aulas_dadas_3t'] <> null and $row_bol['faltas_3t'] <> null){
                                                                    echo number_format($percent_faltas3t,1,",",".")."%";
                                                                }
                                                                echo"</td>"; //Presença 3T
                                                                

                                                                $nota_final_1 = upper($row_bol['nota_1t'], $row_bol['nota_rec_1t']);
                                                                $nota_final_2 = upper($row_bol['nota_2t'], $row_bol['nota_rec_2t']);
                                                                $nota_final_3 = upper($row_bol['nota_3t'], $row_bol['nota_rec_3t']);
                                                                
                                                                //Cálculo média final
                                                                $media_final_decimal = ($nota_final_1 + $nota_final_2 + $nota_final_3) / 3;
                                                                $media_final = number_format($media_final_decimal,1,",",".");
                                                                if((empty($row_bol['nota_1t']))||(empty($row_bol['nota_2t']))||(empty($row_bol['nota_3t']))){
                                                                    $media_final = "<i class='fa fa-exclamation-triangle' style='color:red;'></i>";
                                                                } //Se média não houver nota para gerar média, mostra um alerta;
                                                                echo "<td><center>".$media_final."</center></td>";
                                                                echo "<td></td>"; //Faltas totais;
                                                                
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
                                                                        $sql_insert_sf     = "update boletim set " ;
                                                                        $sql_insert_sf    .= "situacao_pre_rf='APR', nota_rf=NULL, situacao_pos_rf='APR' ";
                                                                        $sql_insert_sf    .= "where matricula_alu = '".$matricula_alu."' ";
                                                                        $sql_insert_sf    .= "and id_disc = '".$row_bol['id_disc']."' ";
                                                                        $sql_insert_sf    .= "and id_turma = '".$row_bol['id_turma']."'; ";

                                                                        $query_insert_sf   = mysqli_query($conexao, $sql_insert_sf) /*or die(mysqli_error($conexao))*/;
                                                                            
                                                                        echo "<td class='text-center'>-</td>";
                                                                        //echo "<td class='text-center'>".$row_bol['situacao_pos_rf']."</td>";  
                                                                        if ($query_insert_sf){
                                                                            echo "<td class='text-center'>".$row_bol['situacao_pos_rf']."</td>"; 
                                                                        }else{
                                                                           echo "<td class='text-center'>ERRO</td>"; 
                                                                        }
                                                                }elseif ($media_final < 6){
                                                                        $sql_insert_sf     = "update boletim set " ;
                                                                        $sql_insert_sf    .= "situacao_pre_rf='REC', nota_rf=NULL, situacao_pos_rf=NULL ";
                                                                        $sql_insert_sf    .= "where matricula_alu = '".$matricula_alu."' ";
                                                                        $sql_insert_sf    .= "and id_disc = '".$row_bol['id_disc']."' ";
                                                                        $sql_insert_sf    .= "and id_turma = '".$row_bol['id_turma']."'; ";
                                                                    
                                                                        $query_insert_sf   = mysqli_query($conexao, $sql_insert_sf) /*or die(mysqli_error($conexao))*/;
                                                                        
                                                                        if($row_bol['nota_rf'] == NULL){ //NOTA RECUPERAÇÃO FINAL
                                                                            echo "<td class='text-center'>-</td>";
                                                                            echo "<td class='text-center'>-</td>";
                                                                        }else{
                                                                            echo "<td class='text-center'>".$row_bol['nota_rf']."</td>"; 
                                                                            
                                                                            if ($row_bol['nota_rf'] >= 6){
                                                                                $sql_insert_sf2    = "update boletim set " ;
                                                                                $sql_insert_sf2   .= "situacao_pre_rf='REC', nota_rf='".$row_bol['nota_rf']."', situacao_pos_rf='APR' ";
                                                                                $sql_insert_sf2   .= "where matricula_alu = '".$matricula_alu."' ";
                                                                                $sql_insert_sf2   .= "and id_disc = '".$row_bol['id_disc']."' ";
                                                                                $sql_insert_sf2   .= "and id_turma = '".$row_bol['id_turma']."'; ";

                                                                                $query_insert_sf2  = mysqli_query($conexao, $sql_insert_sf2) /*or die(mysqli_error($conexao))*/;
                                                                                
                                                                                echo "<td class='text-center'>".$row_bol['situacao_pos_rf']."</td>";
                                                                            }else{
                                                                               $sql_insert_sf2    = "update boletim set " ;
                                                                                $sql_insert_sf2   .= "situacao_pre_rf='REC', nota_rf='".$row_bol['nota_rf']."', situacao_pos_rf='REP' ";
                                                                                $sql_insert_sf2   .= "where matricula_alu = '".$matricula_alu."' ";
                                                                                $sql_insert_sf2   .= "and id_disc = '".$row_bol['id_disc']."' ";
                                                                                $sql_insert_sf2   .= "and id_turma = '".$row_bol['id_turma']."'; ";

                                                                                $query_insert_sf2  = mysqli_query($conexao, $sql_insert_sf2);
                                                                                
                                                                                echo "<td class='text-center'>".$row_bol['situacao_pos_rf']."</td>";
                                                                            }
                                                                        }     
                                                                }
                                                            }
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
    
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>

<?php
/*function TestaNota($coluna){
    if (empty($row_bol["\'".$coluna."\'"])){
        $jesus = "<td class='text-center'>-</td>";
    }else{
        if( $row_bol["\'".$coluna."\'"] < 6){
        $jesus = "<td style='background-color:red;color:#FFF;' class='text-center'>".$row_bol["\'".$coluna."\'"]."</td>";
    }else{
        $jesus = "<td class='text-center'>".$row_bol["\'".$coluna."\'"]."</td>"; 
    }                                                                  
    }
    return $jesus;
}*/
?>