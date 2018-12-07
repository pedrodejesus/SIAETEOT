<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'turma';
include "../../../../base/head.php";
?>
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="sidebar-fixed header-fixed">
    <?php include "../modal.php" ?>
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">            
            <?php
                include "../../../../base/sidebar/8_sidebar_secretaria.php";
                include("../../../../base/conexao.php");
                        
                $id_turma = $_GET['id_turma'];
                $sql  = "select distinct m.matricula_alu, m.id_turma, m.remat, ";
                $sql .= "a.matricula_alu, a.nome_alu, a.sobrenome_alu, a.situacao as situacao_aluno, ";
                $sql .= "t.id_turma, t.numero, t.ano_letivo, t.situacao as situacao_turma, t.turno, t.dt_inicio, t.dt_fim, t.id_cur ";
                $sql .= "from matriculado m, aluno a, turma t ";
                $sql .= "where m.matricula_alu = a.matricula_alu ";
                $sql .= "and m.id_turma = t.id_turma  ";
                //$sql .= "and and m.remat = 0 ";
                $sql .= "and t.id_turma = '".$id_turma."' order by nome_alu asc;";
        
                $query = mysqli_query($conexao, $sql);
                $row = mysqli_fetch_array($query);
                    
                if(empty($row)){ //Query para que, se não houverem alunos matriculados na turma, fazer um select simples ao invés de um completo
                    $sql = "select id_turma, numero, ano_letivo, situacao as situacao_turma, turno, dt_inicio, dt_fim, id_cur from turma where id_turma = '".$id_turma."'";
                    $query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));;
                    $row = mysqli_fetch_array($query);
                }
            ?>

            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\siaeteot/model/secretaria/turma/lista_turma.php">Turmas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4>Turma <?php echo $row["numero"]." / ".$row["ano_letivo"] ?></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>ID</strong>
                                                <p class="form-control-plaintext"><?php echo $row["id_turma"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Número</strong>
                                                <p class="form-control-plaintext"><?php echo $row["numero"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Ano letivo</strong>
                                                <p class="form-control-plaintext"><?php echo $row["ano_letivo"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Situação</strong>
                                                <p class="form-control-plaintext">
                                                    <?php
                                                        switch($row["situacao_turma"]){
                                                            case 1:
                                                                echo "Ativa";
                                                                break;
                                                            case 0:
                                                                echo "Encerrada";
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
                                                <strong>Turno</strong>
                                                <p class="form-control-plaintext">
                                                    <?php
                                                        switch($row["turno"]){
                                                            case 1:
                                                                echo "Manhã";
                                                                break;
                                                            case 2:
                                                                echo "Tarde";
                                                                break;
                                                            case 3:
                                                                echo "Noite";
                                                                break;
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Curso</strong>
                                                <p class="form-control-plaintext">
                                                    <?php
                                                        switch($row["id_cur"]){
                                                            case 0:
                                                                echo "Administração";
                                                                break;
                                                            case 3:
                                                                echo "Análises Clínicas";
                                                                break;
                                                            case 4:
                                                                echo "Gerência em Saúde";
                                                                break;
                                                            case 5:
                                                                echo "Informática para Internet";
                                                                break;
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Data de início</strong>
                                                <p class="form-control-plaintext"><?php echo implode("/", array_reverse(explode("-", $row['dt_inicio']))) ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <strong>Data de fim</strong>
                                                <p class="form-control-plaintext">
                                                    <?php
                                                        if(empty($row['dt_fim'])){
                                                            echo "Presente";
                                                        } else{
                                                            echo implode("/", array_reverse(explode("-", $row['dt_fim'])));
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Alunos da turma <?php //echo $row["numero"]." / ".$row["ano_letivo"].":"; ?></h5>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="table-list" class="table-responsive">
                                                <table id="tabela_turma" class="table table-sm table-hover">
                                                        <?php
                                                            if ($sql == "select id_turma, numero, ano_letivo, situacao as situacao_turma, turno, dt_inicio, dt_fim, id_cur from turma where id_turma = '".$id_turma."'"){
                                                                echo "<div class='alert alert-danger' role='alert'>
                                                                          Ainda não há alunos matriculados nesta turma!
                                                                        </div>";
                                                            }else{
                                                                echo "<thead>
                                                                        <tr>
                                                                            <th scope='col'>Matrícula</th>
                                                                            <th scope='col''>Nome</th>
                                                                            <th scope='col'>Situação</th>
                                                                            <th scope='col'>Ações</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>";
                                                                $query_alu = mysqli_query($conexao, $sql);
                                                                while($row_alu = mysqli_fetch_array($query_alu)){
                                                                    echo "<tr scope='row'>";
                                                                    echo "<td>".$row_alu['matricula_alu']."</td>";
                                                                    echo "<td>".$row_alu['nome_alu']." ".$row_alu['sobrenome_alu']."</td>";
                                                                    echo "<td>";
                                                                    switch($row_alu['situacao_aluno']){
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
                                                                    echo "</td>";
                                                                    echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                                            <a class='btn btn-success' href=../../matriculado/view/visualizar_mat.php?matricula_alu=".$row_alu['matricula_alu']."><i class='fa fa-info-circle'></i>&nbsp; Visualizar matrícula</a>";
                                                                    if  ($row_alu['situacao_aluno'] == 1 && $row['situacao_turma'] == 1) {
                                                                        echo"<a class='btn btn-warning' href=view/visualizar_turma.php?matricula_alu=".$row_alu['matricula_alu']."><i class='fa fa-exchange-alt'></i>&nbsp; Transferir de turma</a>"; 
                                                                    } 
                                                                    echo "</div></td></tr>";  
                                                                } 
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
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
                                        <div class="col-md-12">
                                            <h5><button id='clicar' class="btn btn-rounded btn-sm btn-primary "><i id="icon" class="fa fa-plus"></i></button>&nbsp; Visualizar disciplinas da turma <?php //echo $row["numero"]." / ".$row["ano_letivo"].":"; ?></h5>
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
                                                            <th scope="col">Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $sql_disc  = "select dpt.id_disc_pdr_turma, dpt.id_turma, dpt.id_disc, ";
                                                            $sql_disc .= "d.id_disc, d.nome_disc, d.sigla_disc ";
                                                            $sql_disc .= "from disc_pdr_tur dpt, disciplina d ";
                                                            $sql_disc .= "where dpt.id_disc = d.id_disc ";
                                                            $sql_disc .= "and id_turma = '".$id_turma."' order by nome_disc asc;";
                                                            $query_disc = mysqli_query($conexao, $sql_disc);
                                                            while($row_disc = mysqli_fetch_array($query_disc)){
                                                                echo "<tr scope='row'>";
                                                                echo "<td>".$row_disc['id_disc']."</td>";
                                                                echo "<td>".$row_disc['nome_disc']."</td>";
                                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                                        <a class='btn btn-danger' href='../controller/exclui_disc_pdr_tur.php?id_turma=$id_turma&id_disc=".$row_disc['id_disc']."'><i class='fa fa-trash'></i>&nbsp; Excluir disciplina</a>";
                                                                echo "</div></td></tr>";
                                                                    
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <a class='btn btn-warning' href='editar_turma.php?id_turma=<?php echo $id_turma ?>'><i class='fa fa-edit'></i>&nbsp; Editar</a>   
                                                
                                                <a class='btn btn-danger' onclick='deletaTurma(<?php echo $id_turma ?>)' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                
                                                <a class='btn btn-light' href='../lista_turma.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>
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
    
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="\siaeteot/assets/js/function-delete.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>