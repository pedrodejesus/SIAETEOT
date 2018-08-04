<?php

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();
$nivel_necessario = 2;

// Verifica se não há a variável da sessão que identifica o usuário
if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) {
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ETEOT - Escola Técnica Estadual Oscar Tenório</title>
    
    <link href="\projeto/assets/css/style.css" rel="stylesheet">
    <link href="\projeto/assets/js/jquery.autocomplete.css" rel="stylesheet">
    <!--<link href="\projeto/assets/css/style-tablesorter.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body class="sidebar-fixed header-fixed">
    <?php include "modal.php" ?>
    <div class="page-wrapper">
    <?php include "../../base/nav.php" ?>
        <div class="main-container">
        <?php include "../../base/sidebar.php" ?>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="row">
                                    <div class="col-md-2">
                                        <h3>Professor / Disciplina</h3>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="text" id="search_alu" name="search_alu" class="form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Pesquisar</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="view/cadastrar_ministra.php"><button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp; Adicionar</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            <?php include "messages.php"; ?>
                                <div class="table-responsive">
                                    <table cellpadding="20" id="tabela_alu" class="table table-sm tablesorter">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID Funcionário</th>
                                                <th scope="col">Data de início</th>
                                                <th scope="col">Data de fim</th>
                                                <th scope="col">ID Disciplina</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            include("../../base/conexao.php"); //Chama o arquivo de conexão com o banco de dados;
                                                    
                                            $quantidade = 10;
							
                                            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                            $inicio = ($quantidade * $pagina) - $quantidade;

                                            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                            $inicio = ($quantidade * $pagina) - $quantidade;

                                            $data      = mysql_query("select * from ministra limit $inicio, $quantidade;") or die(mysql_error());
                                            
                                            
                                            /*$data_disc = mysql_query("select * from disciplina;") or die(mysql_error());
                                            $info_disc = mysql_fetch_array($data_disc);*/
                                            
                                            while($info = mysql_fetch_array($data)){ 
                                                
                                                $data_func = mysql_query("select * from funcionario where id_func = '".$info["id_func"]."';") or die(mysql_error());
                                                $info_func = mysql_fetch_array($data_func);
                                                $data_disc = mysql_query("select * from disciplina where id_disc = '".$info["id_disc"]."';") or die(mysql_error());
                                                $info_disc = mysql_fetch_array($data_disc);
                                                
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_func']." - ".$info_func['nome_func']." ".$info_func['sobrenome_func']."</td>";
                                                echo "<td>".implode("/", array_reverse(explode("-", $info['dt_inicio'])))."</td>";
                                                //echo "<td>".implode("/", array_reverse(explode("-", $info['dt_fim'])))."</td>"; 
                                                if(0 == $info['dt_fim']){
                                                    echo "<td>Presente</td>";
                                                }else{
                                                    echo "<td>".implode("/", array_reverse(explode("-", $info['dt_fim'])))."</td>";
                                                }
                                                echo "<td>".$info['id_disc']." - ".$info_disc['nome_disc']."</td>";
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_alu.php?matricula_alu=".$info['matricula_alu']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
                                                            <a class='btn btn-warning' href=view/editar_alu.php?matricula_alu=".$info['matricula_alu']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                            <a class='btn btn-danger' onclick='deletaAlu(".$info['matricula_alu'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                          </div>
                                                        </td></tr>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <nav aria-label="Paginação">
                                        <ul class="pagination">
                                        <?php 
                                            $sqlTotal 		= "select matricula_alu from aluno;";
                                                
                                            $qrTotal  		= mysql_query($sqlTotal) or die (mysql_error());
                                            $numTotal 		= mysql_num_rows($qrTotal);
                                            $totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

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
    
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <!--<script src="\projeto/assets/js/jquery.tablesorter.min.js"></script>
	<script src="\projeto/assets/js/script_tablesorter.js"></script>-->
    <script src="\projeto/assets/js/jquery.autocomplete.js"></script>
    <script src="\projeto/assets/js/popper.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/function-delete.js"></script>
    <script src="\projeto/assets/js/chart.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src="\projeto/assets/js/demo.js"></script>
</body>

</html>
