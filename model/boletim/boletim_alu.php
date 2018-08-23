<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
include "../../base/head.php"
?>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                include "../../base/sidebar.php";
                include("../../base/conexao.php");
        
                $matricula_alu = (int) $_GET['matricula_alu'];
                $id_turma = (int) $_GET['id_turma'];
                $sql = "call select_disciplinas_aluno_boletim(".$matricula_alu.", ".$id_turma.")";
                $query = mysqli_query($conexao, $sql);
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
                                            <h5>Matricula: <b><?php echo $matricula_alu ?></b> - Ano Letivo: <b><?php echo $row["ano_letivo"] ?></b></h5>
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
                                                            <th scope="col" colspan="2" class="text-center">Total Anual</th>
                                                            <th scope="col" rowspan="2" class="text-center align-middle">Rec. Final</th>
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
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            mysqli_free_result($query);
                                                            mysqli_next_result($conexao);
                                                
                                                            $sql_bol = "call select_disciplinas_aluno_boletim(".$matricula_alu.", ".$id_turma.")";
                                                            $query_bol = mysqli_query($conexao, $sql_bol) or die(mysqli_error($conexao));;
                                                
                                                            while($row_bol = mysqli_fetch_array($query_bol)){                                                                
                                                                $disc_len = strlen($row_bol['nome_disc']);
                                                                if($disc_len > 15){
                                                                    $row_bol['nome_disc'] = $row_bol['sigla_disc'];
                                                                }
                                                                echo "<tr scope='row'>";
                                                                echo "<td>".$row_bol['nome_disc']."</td>";
                                                                
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
                                                                echo "<td></td>";
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
                                                                echo "<td></td>";
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
                                                                
                                                                /*TestaNota('nota_1t');
                                                                TestaNota('nota_rec_1t');
                                                                TestaNota('nota_2t');
                                                                TestaNota('nota_rec_2t');
                                                                TestaNota('nota_3t');
                                                                TestaNota('nota_rec_3t');*/
                                                                
                                                                echo "<td></td>";
                                                                $resultado_decimal = ($row_bol['nota_1t'] + $row_bol['nota_2t'] + $row_bol['nota_3t']) / 3;
                                                                
                                                                $resultado = number_format($resultado_decimal,1,",",".");
                                                                //$resultado = round($resultado_decimal, 1);
                                                                
                                                                if((empty($row_bol['nota_1t']))||(empty($row_bol['nota_2t']))||(empty($row_bol['nota_3t']))){
                                                                    $resultado = "<i class='fa fa-exclamation-triangle' style='color:red;'></i>";
                                                                }
                                                                
                                                                echo "<td><center>".$resultado."</center></td>";
                                                                echo "<td></td>";
                                                                echo "<td></td>";
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
                                                <a class='btn btn-primary' href='editar_mat.php?matricula_alu=<?php echo $matricula_alu ?>'><i class='fal fa-print'></i>&nbsp; Imprimir</a>   
                                                
                                                <a class='btn btn-light' href='../lista_matriculado.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>
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