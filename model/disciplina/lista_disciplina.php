<?php
header("Content-Type: text/html; charset=utf-8",true); // Acentuação
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { //Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança 
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
include "../../base/head.php";
?>
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
<script src="\projeto/assets/js/jquery-migrate-1.4.1"></script>
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
                                        <h3>Disciplinas</h3>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="text" id="busca" onkeyup="searchDisc(this.value)" class="form-control">
                                            <span class="input-group-btn">
                                                <button type="submit" onclick="searchDisc(this.value)" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Pesquisar</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="view/cadastrar_disc.php"><button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp; Adicionar</button></a>
                                    </div>
                                </div>
                            </div>
                            <div id="card-body" class="card-body">
                            <?php include "messages.php"; ?>
                                <div id="table-list" class="table-responsive">
                                    <table cellpadding="20" id="tabela_disc" class="table table-sm tablesorter">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Sigla</th>
                                                <th scope="col">Curso</th>
                                                <th scope="col">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_disc">
                                        <?php
                                            include("../../base/conexao.php"); //Chama o arquivo de conexão com o banco de dados;
                                                    
                                            $quantidade = 10;
							
                                            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                            $inicio = ($quantidade * $pagina) - $quantidade;

                                            $data = mysql_query("select * from disciplina order by id_disc asc limit $inicio, $quantidade;") or die(mysql_error());
                                                
                                            while($info = mysql_fetch_array($data)){ //Transforma o conteúdo da variável $data em um array na variável $info;
                                                
                                                $data_cur = mysql_query("select * from curso where id_cur = '".$info["id_cur"]."';") or die(mysql_error());
                                                $info_cur = mysql_fetch_array($data_cur);
                                                
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_disc']."</td>";
                                                echo "<td>".$info['nome_disc']."</td>";
                                                echo "<td>".$info['sigla_disc']."</td>";
                                                echo "<td>".$info_cur['nome_cur']."</td>";
                                                echo "<td><div class='btn-group btn-group-sm' role='group'>
                                                            <a class='btn btn-success' href=view/visualizar_disc.php?id_disc=".$info['id_disc']."><i class='fa fa-info-circle'></i>&nbsp; Detalhes</a>
                                                                
                                                            <a class='btn btn-warning' href=view/editar_disc.php?id_disc=".$info['id_disc']."><i class='fa fa-edit'></i>&nbsp; Editar</a>
                                                                
                                                            <a class='btn btn-danger' onclick='deletaDisc(".$info['id_disc'].")' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                          </div>
                                                        </td></tr>";
                                            }
                                            header("Content-Type: text/html; charset=utf-8",true); // Acentuação
                                        ?>
                                        </tbody>
                                    </table>
                                    <nav aria-label="Paginação">
                                        <ul class="pagination">
                                        <?php 
                                            $sqlTotal 		= "select id_disc from disciplina;";
                                                
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
    
    
    <!--<script src="\projeto/assets/js/jquery.tablesorter.min.js"></script>
	<script src="\projeto/assets/js/script_tablesorter.js"></script>-->
    <script src="\projeto/assets/js/popper.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/function-delete.js"></script>
    <script src="\projeto/assets/js/function-search.js"></script>
    <script src="\projeto/assets/js/chart.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src="\projeto/assets/js/demo.js"></script>
</body>

</html>
