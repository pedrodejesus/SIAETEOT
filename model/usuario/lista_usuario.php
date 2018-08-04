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
    <!--<link href="\projeto/assets/css/style-tablesorter.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script type="text/javascript" src="search.js"></script>
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
                                        <h3>Usuários</h3>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="text" id="search_alu" onkeyup="searchUsu(this.value)" name="search_alu" class="form-control">
                                            <span class="input-group-btn">
                                                <button type="submit" onclick="searchUsu(this.value)" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Pesquisar</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="view/cadastrar_usu.php"><button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp; Adicionar</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            <?php include "messages.php"; ?>
                                <div class="table-responsive">
                                    <table cellpadding="20" class="table table-sm tablesorter">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Usuário</th>
                                                <!--<th scope="col">Senha</th>-->
                                                <th scope="col">Email</th>
                                                <th scope="col">Nível</th>
                                                <th scope="col">Ativo</th>
                                                <!--<th scope="col">Data cadastro</th>-->
                                                <th scope="col">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_usu">
                                        <?php
                                            include("../../base/conexao.php"); //Chama o arquivo de conexão com o banco de dados;
                                                    
                                            $quantidade = 10;
							
                                            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                            $inicio = ($quantidade * $pagina) - $quantidade;

                                            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                            $inicio = ($quantidade * $pagina) - $quantidade;

                                            $data = mysql_query("select * from usuario order by nome_usu asc limit $inicio, $quantidade;") or die(mysql_error());
                                                
                                            while($info = mysql_fetch_array($data)){ //Transforma o conteúdo da variável $data em um array na variável $info;
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_usu']."</td>";
                                                echo "<td>".$info['nome_usu']."</td>";
                                                echo "<td>".$info['usuario']."</td>"; 
                                                //echo "<td>".$info['senha']."</td>";
                                                echo "<td>".$info['email']."</td>";
                                                echo "<td>".$info['nivel']."</td>";
                                                if($info['ativo'] == 1){
									               echo "<td>SIM</td>";
								                }else if($info['ativo'] == 0){
									               echo "<td>NÃO</td>";
								                }
                                                //echo "<td>".implode("/", array_reverse(explode("-", $info['dt_cadastro'])))."</td>";
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_usu.php?id_usu=".$info['id_usu']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
                                                            <a class='btn btn-warning' href=view/editar_usu.php?id_usu=".$info['id_usu']."><i class='fa fa-edit'></i>&nbsp; Editar</a>";
                                                if($info['ativo'] == 1){
									               echo "<a class='btn btn-danger' href=controller/block_ativa_usu.php?id_usu=".$info['id_usu']."&block_ativa=0><i class='fa fa-lock'></i>&nbsp; Bloquear</a>";
								                }else if($info['ativo'] == 0){
									               echo "<a class='btn btn-success' href=controller/block_ativa_usu.php?id_usu=".$info['id_usu']."&block_ativa=1><i class='fa fa-unlock'></i>&nbsp; Desbloquear</a>";
								                }
                                                echo "<a class='btn btn-danger' onclick='deletaUsu(".$info['id_usu'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a></div></td></tr>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <nav aria-label="Paginação">
                                        <ul class="pagination">
                                        <?php 
                                            $sqlTotal 		= "select id_usu from usuario;";
                                                
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
    <script src="\projeto/assets/js/popper.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/function-delete.js"></script>
    <script src="\projeto/assets/js/chart.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src="\projeto/assets/js/demo.js"></script>
</body>

</html>
