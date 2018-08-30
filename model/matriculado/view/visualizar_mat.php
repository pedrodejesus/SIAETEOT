<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
include "../../../base/head.php"
?>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                include "../../../base/sidebar.php";
                include("../../../base/conexao.php");
        
                $matricula_alu = (int) $_GET['matricula_alu'];
                $sql  = "select m.tipo_matricula, m.dt_matricula, m.ano_letivo, m.matricula_alu, m.id_turma, m.id_disc, m.dt_matricula,  ";
                $sql .= "a.matricula_alu, a.nome_alu, a.sobrenome_alu, ";
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
                
                /*$sql2 = mysql_query("select upper(tp_logradouro) as tp_logradouro, upper(logradouro) as logradouro, upper(bairro) as bairro, upper(cidade) as cidade, uf from localidade where cep = '".$row["cep"]."';");
                $row2 = mysql_fetch_array($sql2);
        
                $sexo_alu = $row["sexo_alu"];
                $tipo_alu = $row["tipo_alu"];*/
            ?>

            <div class="content">
                <div class="container-fluid">
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="matricula_alu" class="form-control-label"><strong>Matrícula</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["matricula_alu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nome_alu" class="form-control-label"><strong>Nome</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["nome_alu"]; ?></p>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sobrenome_alu" class="form-control-label"><strong>Sobrenome</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["sobrenome_alu"]; ?></p>
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
                                                <label for="rg_alu" class="form-control-label"><strong>Tipo da matricula</strong></label>
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
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Disciplinas realizadas por <?php echo $row["matricula_alu"]." - ".$row["nome_alu"]." ".$row["sobrenome_alu"].":" ?></h5>
                                        </div>
                                    </div> 
                                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="table-list" class="table-responsive">
                                                <table id="tabela_turma" class="table table-sm table-striped table hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Nome</th>
                                                            <!--<th scope="col">Ações</th>-->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $query_disc = mysqli_query($conexao, $sql);
                                                            while($row_disc = mysqli_fetch_array($query_disc)){
                                                                echo "<tr scope='row'>";
                                                                echo "<td>".$row_disc['id_disc']."</td>";
                                                                echo "<td>".$row_disc['nome_disc']."</td>";
                                                                /*echo "<td>1</td>";
                                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                                        <a class='btn btn-success' href=view/visualizar_turma.php?matricula_alu=".$info['matricula_alu']."><i class='fa fa-info-circle'></i>&nbsp; Visualizar matrícula</a>
                                                                        
                                                                        <a class='btn btn-warning' href=view/visualizar_turma.php?matricula_alu=".$info['matricula_alu']."><i class='fa fa-exchange-alt'></i>&nbsp; Transferir de turma</a>
                                                                      </div>
                                                                    </td></tr>";*/
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
                                                <a class='btn btn-success' href='../../boletim/boletim_alu.php?matricula_alu=<?php echo $matricula_alu ?>&id_turma=<?php echo $row["id_turma"] ?>'><i class='fa fa-list-ol'></i>&nbsp; Boletim</a> 
                                                
                                                <a class='btn btn-warning' href='editar_mat.php?matricula_alu=<?php echo $matricula_alu ?>'><i class='fa fa-edit'></i>&nbsp; Editar</a>   
                                                
                                                <a class='btn btn-danger' onclick='deletaAlu(<?php echo $matricula_alu ?>)' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                
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