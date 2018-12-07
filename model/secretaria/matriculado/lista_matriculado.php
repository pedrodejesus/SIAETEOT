<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'matricula';
include "../../../base/head.php";
?>
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.js" integrity="sha256-MCmDSoIMecFUw3f1LicZ/D/yonYAoHrgiep/3pCH9rw=" crossorigin="anonymous"></script>
<script src="\siaeteot/assets/js/jquery-migrate-1.4.1"></script>
<script>
    $(document).ready(function(){
        $('#modal-declaracao').on('show.bs.modal', function(e){
            var matricula_alu = $(e.relatedTarget).data('alu'); //Recebe o id do data-alu
            $.ajax({
                type: 'get', 
                url: 'modal_info.php', 
                data: 'matricula_alu='+ matricula_alu, 
                success: function(data){
                    $('.modal-body').html(data);
                } 
            });
        });
    });
</script>
</head>

<body class="sidebar-fixed header-fixed">
    <?php include "modal.php" ?>
    <div class="page-wrapper">
    <?php include "../../../base/nav.php" ?>
        <div class="main-container">
        <?php include "../../../base/sidebar/8_sidebar_secretaria.php" ?>
            <div class="content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light">
                        <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Matrículas</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="row">
                                    <div class="col-md-2">
                                        <h3>Matrículas</h3>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="text" id="busca" onkeyup="searchMatriculado(this.value)" class="form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Pesquisar</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="view/cadastrar_mat.php"><button id='add' type="button" class="btn btn-primary col-sm-12"><i class="fa fa-plus-circle"></i>&nbsp; Matricular Aluno</button></a>
                                    </div>
                                </div>
                            </div>
                            <div id="card-body" class="card-body">
                            <?php include "messages.php"; ?>
                                <div id="table-list" class="table-responsive">
                                    <table id="tabela_mat" class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Matrícula</th>
                                                <th scope="col">Nome</th>
                                                <!--<th scope="col">Data de Matrícula</th>-->
                                                <th scope="col">Turma</th>
                                                <th scope="col">Ano letivo</th>
                                                <th scope="col">Situação</th>
                                                <th scope="col">Modalidade</th>
                                                <th scope="col">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_mat">
                                        <?php
                                            include("../../../base/conexao.php");
                                                    
                                            $quantidade = 10;
                                            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                            $inicio = ($quantidade * $pagina) - $quantidade;
                                            
                                            $sql  = ("select distinct m.tipo_matricula, m.dt_matricula, m.matricula_alu, m.id_turma, ");
                                            $sql .= ("a.matricula_alu, a.nome_alu, a.sobrenome_alu, a.situacao, ");
                                            $sql .= ("t.id_turma, t.numero, t.ano_letivo ");
                                            $sql .= ("from matriculado m, aluno a, turma t ");
                                            $sql .= ("where m.matricula_alu = a.matricula_alu ");
                                            $sql .= ("and m.id_turma = t.id_turma ");
                                            $sql .= ("and m.remat = 0 ");
                                            $sql .= ("order by t.ano_letivo desc, a.nome_alu asc, a.sobrenome_alu asc limit $inicio, $quantidade;");
                                            
                                            $data = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
                                                
                                            while($info = mysqli_fetch_array($data)){
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['matricula_alu']."</td>";
                                                echo "<td>".$info['nome_alu']." ".$info['sobrenome_alu']."</td>";
                                                echo "<td>".$info['numero']."</td>";
                                                echo "<td>".$info['ano_letivo']."</td>";
                                                //echo "<td>".implode("/", array_reverse(explode("-", $info['dt_matricula'])))."</td>";
                                                switch($info['situacao']){
                                                    case 1:
                                                        echo "<td>Cursando</td>";
                                                        break;
                                                    case 2:
                                                        echo "<td>Desistente</td>";
                                                        break;
                                                    case 3:
                                                        echo "<td>Trancado</td>";
                                                        break;
                                                    case 4:
                                                        echo "<td>Concluinte</td>";
                                                        break;
                                                    case 5:
                                                        echo "<td>Desistente</td>";
                                                        break;
                                                }
                                                switch($info['tipo_matricula']){
                                                    case "1";
                                                        echo "<td>Integrado</td>";
                                                        break;
                                                    case "2";
                                                        echo "<td>Subsequente</td>";
                                                        break;
                                                }
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_mat.php?matricula_alu=".$info['matricula_alu']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                            
                                                            <a class='btn btn-primary' data-toggle='modal' data-alu='".$info['matricula_alu']."' href='#modal-declaracao'><i class='far fa-print'></i>&nbsp; Declaração</a>
                                                            
                                                            <!--<a target='_blank' class='btn btn-primary' href=rel/declaracao.php?matricula_alu=".$info['matricula_alu']."><i class='far fa-print'></i>&nbsp; Declaração</a>-->
                                                            
                                                            <a class='btn btn-danger' href='#'><i class='fa fa-lock'></i>&nbsp; Trancar Matrícula</a>
                                                                
                                                            <!--<a class='btn btn-warning' href=view/editar_mat.php?matricula_mat=".$info['matricula_alu']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                            <a class='btn btn-danger' onclick='deletaAlu(".$info['matricula_alu'].")' sql-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>-->
                                                          </div>
                                                        </td></tr>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <nav aria-label="Paginação">
                                        <ul class="pagination">
                                        <?php 
                                            $sqlTotal 		= "select distinct matricula_alu from matriculado;";
                                                
                                            $qrTotal  		= mysqli_query($conexao, $sqlTotal) or die (mysql_error());
                                            $numTotal 		= mysqli_num_rows($qrTotal);
                                            $totalpagina    = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

                                            $exibir = 3;
                                            $anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
                                            $posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;

                                            echo "<li class='page-item'><a class='page-link' href='?pagina=1'> Primeira</a></li> "; 
                                            echo "<li class='page-item'><a class='page-link' href=\"?pagina=$anterior\">&laquo;</a></li> ";
                                                
                                            echo '<li class="page-item"><a class="page-link" href="?pagina='.$pagina.'"><strong>'.$pagina.'</strong></a></li> ';

                                            for($i = $pagina+1; $i < $pagina+$exibir; $i++){
                                                if($i <= $totalpagina){
                                                    echo '<li class="page-item"><a class="page-link" href="?pagina='.$i.'"> '.$i.' </a></li> '; 
                                                }    
                                            }

                                            echo "<li class='page-item'><a class='page-link' href=\"?pagina=$posterior\">&raquo;</a></li> ";
                                            echo "<li class='page-item'><a class='page-link' href=\"?pagina=$totalpagina\">Última</a></li>";
                                        ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </div>    
    
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="search.js"></script>
    <script src="\siaeteot/assets/js/function-delete.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>
