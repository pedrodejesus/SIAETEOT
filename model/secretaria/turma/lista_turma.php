<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'turma';
require "../../../base/function.php";
include "../../../base/head.php";
?>
</head>

<body class="sidebar-fixed header-fixed">
    <?php include "modal.php" ?>
    <div class="page-wrapper">
    <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php 
                include "../../../base/sidebar/8_sidebar_secretaria.php" ;
                include("../../../base/conexao.php");
            ?>
            <div class="content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light">
                        <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Turmas</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="row">
                                    <div class="col-md-2">
                                        <h3>Turmas</h3>
                                    </div>
                                    <!--<div class="col-md-8">
                                    <div class="input-group">
                                            <input type="text" id="busca" onkeyup="searchTurma(this.value)" class="form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Pesquisar</button>
                                            </span>
                                        </div>
                                    </div>-->
                                    <div class="col-md-8">
                                        <form method="get" action="lista_turma.php">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select class="form-control form-inline" name="ano_letivo" id="ano_letivo">
                                                            <option value="">Ano letivo</option>
                                                            <?php ano_letivo() ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select class="form-control" name="id_cur" id="id_cur">
                                                            <option value="">Curso</option>
                                                            <?php curso() ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select class="form-control" name="modulo" id="modulo">
                                                            <option value="">Módulo/Ano</option>
                                                            <option value="1">1º</option>
                                                            <option value="2">2º</option>
                                                            <option value="3">3º</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="view/cadastrar_turma.php"><button id='add' type="submit" class="btn btn-primary col-sm-12"><i class="fa fa-filter"></i>&nbsp; Filtrar</button></a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="view/cadastrar_turma.php"><button id='add' type="button" class="btn btn-primary col-sm-12"><i class="fa fa-plus-circle"></i>&nbsp; Adicionar</button></a>
                                    </div>
                                </div>
                            </div>
                            <div id="card-body" class="card-body">
                            <?php include "messages.php"; ?>
                                <div id="table-list" class="table-responsive">
                                    <table id="tabela_turma" class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Número</th>
                                                <th scope="col">Ano letivo</th>
                                                <th scope="col">Situação</th>
                                                <th scope="col">Turno</th>
                                                <th scope="col">Curso</th>
                                                <th scope="col">Data de início</th>
                                                <th scope="col">Data de fim</th>
                                                <th scope="col">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_turma">
                                        <?php
                                                    
                                            $quantidade = 10;
                                            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                            $inicio = ($quantidade * $pagina) - $quantidade;
                                            
                                            $sql = "select * from turma order by ano_letivo desc, numero asc limit $inicio, $quantidade;";
                                            
                                            if((isset($_GET['ano_letivo'])) and ($_GET['ano_letivo'] <> "")){
                                                $sql = "select * from turma where ano_letivo = ".$_GET['ano_letivo']." order by numero asc limit $inicio, $quantidade";
                                            }elseif((isset($_GET['id_cur'])) and ($_GET['id_cur'] <> "")){
                                                $sql = "select * from turma where id_cur = ".$_GET['id_cur']." order by numero asc limit $inicio, $quantidade";
                                            }elseif((isset($_GET['modulo'])) and ($_GET['modulo'] <> "")){
                                                $sql = "select * from turma where numero like '".$_GET['modulo']."%' order by numero asc limit $inicio, $quantidade";
                                            }
                                            if((isset($_GET['ano_letivo'])) and ($_GET['ano_letivo'] <> "") and (isset($_GET['id_cur'])) and ($_GET['id_cur'] <> "")){
                                                $sql = "select * from turma where ano_letivo = ".$_GET['ano_letivo']." and id_cur = ".$_GET['id_cur']." order by numero asc limit $inicio, $quantidade";
                                            }elseif((isset($_GET['modulo'])) and ($_GET['modulo'] <> "") and (isset($_GET['id_cur'])) and ($_GET['id_cur'] <> "")){
                                                $sql = "select * from turma where numero like '".$_GET['modulo']."%' and id_cur = ".$_GET['id_cur']." order by numero asc limit $inicio, $quantidade";
                                            }elseif((isset($_GET['modulo'])) and ($_GET['modulo'] <> "") and (isset($_GET['ano_letivo'])) and ($_GET['ano_letivo'] <> "")){
                                                $sql = "select * from turma where numero like '".$_GET['modulo']."%' and ano_letivo = ".$_GET['ano_letivo']." order by numero asc limit $inicio, $quantidade";
                                            }
                                            if((isset($_GET['ano_letivo'])) and ($_GET['ano_letivo'] <> "") and (isset($_GET['id_cur'])) and ($_GET['id_cur'] <> "") and (isset($_GET['modulo'])) and ($_GET['modulo'] <> "")){
                                                $sql = "select * from turma where numero like '".$_GET['modulo']."%' and ano_letivo = ".$_GET['ano_letivo']." and id_cur = ".$_GET['id_cur']." order by numero asc limit $inicio, $quantidade";
                                            }
                                            
                                            $data = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
                                                
                                            while($info = mysqli_fetch_array($data)){                                   
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
                                                        echo "<td>Noite</td>";
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
                                        ?>
                                        </tbody>
                                    </table>
                                    <nav aria-label="Paginação">
                                        <ul class="pagination">
                                            <?php pagination("id_turma", "turma"); ?>
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
    
    <script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="search.js"></script>
    <script src="\siaeteot/assets/js/function-delete.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>
