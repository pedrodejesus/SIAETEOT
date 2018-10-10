<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'matricula';
include "../../../../base/head.php";
?>
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                include "../../../../base/sidebar/8_sidebar_secretaria.php";
                include("../../../../base/conexao.php");
        
                $matricula_alu = $_GET['matricula_alu'];
                $sql  = "select m.tipo_matricula, m.ano_letivo, m.matricula_alu, m.id_turma, m.id_disc, m.dt_matricula, m.situacao as sit_pdg, ";
                $sql .= "a.matricula_alu, a.nome_alu, a.sobrenome_alu, a.situacao as sit_adm, ";
                $sql .= "d.id_disc, d.nome_disc, ";
                $sql .= "t.id_turma, t.numero, t.ano_letivo ";
                $sql .= "from matriculado m, aluno a, disciplina d, turma t ";
                $sql .= "where m.matricula_alu = a.matricula_alu ";
                $sql .= "and m.id_disc = d.id_disc ";
                $sql .= "and m.id_turma = t.id_turma ";
                $sql .= "and m.remat = '0' ";
                $sql .= "and m.matricula_alu = '".$matricula_alu."' ";
                $query = mysqli_query($conexao, $sql);
                $row = mysqli_fetch_array($query);
            ?>

            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\projeto/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\projeto/model/secretaria/matriculado/lista_matriculado.php">Matrículas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo $row["matricula_alu"]." - ".$row["nome_alu"]." ".$row["sobrenome_alu"]; ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="matricula_alu" class="form-control-label"><strong>Matrícula</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["matricula_alu"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_alu" class="form-control-label"><strong>Nome</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["nome_alu"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sobrenome_alu" class="form-control-label"><strong>Sobrenome</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["sobrenome_alu"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sobrenome_alu" class="form-control-label"><strong>Situação</strong></label>
                                                <p class="form-control-plaintext">
                                                    <?php 
                                                        switch($row['sit_adm']){
                                                                    case 1:
                                                                        echo "Cursando";
                                                                        break;
                                                                    case 2:
                                                                        echo "Desistente";
                                                                        break;
                                                                    case 3:
                                                                        echo "Trancado";
                                                                        break;
                                                                    case 4:
                                                                        echo "Concluinte";
                                                                        break;
                                                                    case 5:
                                                                        echo "Transferido";
                                                                        break;
                                                                }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cpf_alu" class="form-control-label"><strong>Turma</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["numero"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="rg_alu" class="form-control-label"><strong>Ano letivo</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["ano_letivo"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="rg_alu" class="form-control-label"><strong>Modalidade</strong></label>
                                                <p class="form-control-plaintext">
                                                    <?php
                                                        switch($row['tipo_matricula']){
                                                            case "1";
                                                                echo "<td>Integrado</td>";
                                                                break;
                                                            case "2";
                                                                echo "<td>Subsequente</td>";
                                                                break;
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dt_nasc_alu" class="form-control-label"><strong>Data de matrícula</strong></label>
                                                <p class="form-control-plaintext"><?php echo implode("/", array_reverse(explode("-", $row['dt_matricula']))) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <script> 
                                        $(document).ready(function(){
                                            $("#clicar").click(function(){
                                                $("#slide").slideToggle(400, function(){
                                                    $("#icon").toggleClass("fa-plus");
                                                    $("#icon").toggleClass("fa-minus");
                                                });
                                            });
                                        });
                                    </script>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <h5><button id='clicar' class="btn btn-rounded btn-sm btn-primary "><i id="icon" class="fa fa-plus"></i></button>&nbsp;Visualizar disciplinas <?php //echo $row["nome_alu"]." ".$row["sobrenome_alu"].":" ?></h5>
                                        </div>
                                    </div> 
                                
                                    <div class="row" id="slide" style="display:none !important;">
                                        <div class="col-md-12">
                                            <div id="table-list" class="table-responsive">
                                                <table id="tabela_turma" class="table table-sm table-striped table hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Nome</th>
                                                            <th scope="col">Situação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $sql2 = "select d.id_disc, d.nome_disc
                                                                    from matriculado m, aluno a, disciplina d, turma t 
                                                                    where m.matricula_alu = a.matricula_alu
                                                                    and m.id_disc = d.id_disc 
                                                                    and m.id_turma = t.id_turma 
                                                                    and m.remat = '0'
                                                                    and m.matricula_alu = $matricula_alu";
                                                            $query_disc = mysqli_query($conexao, $sql);
                                                            while($row_disc = mysqli_fetch_array($query_disc)){
                                                                echo "<tr scope='row'>";
                                                                echo "<td>".$row_disc['id_disc']."</td>";
                                                                echo "<td>".$row_disc['nome_disc']."</td>";
                                                                switch($row_disc['sit_pdg']){
                                                                    case 1:
                                                                        echo "<td>Regular</td>";
                                                                        break;
                                                                    case 2:
                                                                        echo "<td>Progressão Parcial (PPA)</td>";
                                                                        break;
                                                                    case 3:
                                                                        echo "<td>Aproveitamento de Estudos (APE)</td>";
                                                                        break;
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
<!--                                        <div class="col-md-6">
                                            <div id="table-list" class="table-responsive">
                                                <table id="tabela_turma" class="table table-sm table-striped table hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Nome</th>
                                                            <th scope="col">Situação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
//                                                            $query_disc = mysqli_query($conexao, $sql);
//                                                            while($row_disc = mysqli_fetch_array($query_disc)){
//                                                                echo "<tr scope='row'>";
//                                                                echo "<td>".$row_disc['id_disc']."</td>";
//                                                                echo "<td>".$row_disc['nome_disc']."</td>";
//                                                                switch($row_disc['sit_pdg']){
//                                                                    case 1:
//                                                                        echo "<td>Regular</td>";
//                                                                        break;
//                                                                    case 2:
//                                                                        echo "<td>Progressão Parcial (PPA)</td>";
//                                                                        break;
//                                                                    case 3:
//                                                                        echo "<td>Aproveitamento de Estudos (APE)</td>";
//                                                                        break;
//                                                                }
//                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>-->
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn-group" role="group"> 
                                                <a class='btn btn-success' href='../../boletim/boletim_alu.php?matricula_alu=<?php echo $matricula_alu ?>&id_turma=<?php echo $row["id_turma"] ?>'><i class='fa fa-list-ol'></i>&nbsp; Boletim</a> 
                                                
                                                <a class='btn btn-warning' href='../../aluno/view/visualizar_alu.php?matricula_alu=<?php echo $matricula_alu ?>'><i class='fa fa-user-graduate'></i>&nbsp; Dados Pessoais</a>   
                                                
                                                <a class='btn btn-danger' onclick='deletaAlu(<?php echo $matricula_alu ?>)' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                
                                                <a class='btn btn-light' href='../lista_matriculado.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="btn-group" role="group"> 
                                                <a class='btn btn-warning' onclick='deletaAlu(<?php echo $matricula_alu ?>)' data-toggle='modal' href='#delete-modal'><i class='fa fa-exchange'></i>&nbsp; Transferir</a>
                                                
                                                <a class='btn btn-danger' href='../../boletim/boletim_alu.php?matricula_alu=<?php echo $matricula_alu ?>&id_turma=<?php echo $row["id_turma"] ?>'><i class='fa fa-lock'></i>&nbsp; Trancar matrícula</a> 
                                                
                                                <a class='btn btn-secondary' href='../../aluno/view/visualizar_alu.php?matricula_alu=<?php echo $matricula_alu ?>'><i class='fa fa-times'></i>&nbsp; Desistente</a>   
                                                
                                                <a class='btn btn-info' href='../lista_matriculado.php'><i class='fa fa-redo'></i>&nbsp; Concluinte</a>
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
    
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>