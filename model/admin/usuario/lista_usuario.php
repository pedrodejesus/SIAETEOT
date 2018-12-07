<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 0)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'user';
require "../../../base/function.php";
include "../../../base/head.php";
?>
</head>

<body class="sidebar-fixed header-fixed">
    <?php include "modal.php" ?>
    <div class="page-wrapper">
    <?php include "../../../base/nav.php" ?>
        <div class="main-container">
        <?php include "../../../base/sidebar/0_sidebar_admin.php" ?>
            <div class="content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light">
                        <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-lg-12">
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
                                                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Pesquisar</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="view/cadastrar_usu.php"><button id='add' type="button" class="btn btn-primary col-sm-12"><i class="fa fa-plus-circle"></i>&nbsp; Adicionar</button></a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                            <?php include "messages.php"; ?>
                                <div class="table-responsive">
                                    <table class="table table-sm tablesorter">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Usuário</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Nível</th>
                                                <th scope="col">Ativo</th>
                                                <th scope="col">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_usu">
                                        <?php
                                            include("../../../base/conexao.php"); 
                                                    
                                            $quantidade = 10;
                                            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                            $inicio = ($quantidade * $pagina) - $quantidade;

                                            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                            $inicio = ($quantidade * $pagina) - $quantidade;

                                            $data = mysqli_query($conexao, "select * from usuario order by nome_usu asc limit $inicio, $quantidade;") or die(mysqli_error($conexao));
                                                
                                            while($info = mysqli_fetch_array($data)){
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['id_usu']."</td>";
                                                echo "<td>".$info['nome_usu']."</td>";
                                                echo "<td>".$info['usuario']."</td>"; 
                                                echo "<td>".$info['email']."</td>";
                                                switch($info["nivel"]){
                                                        case 8:
                                                            echo "<td>Secretaria</td>";
                                                            break;
                                                        case 0:
                                                            echo "<td>Administrador</td>";
                                                            break;
                                                        case 7:
                                                            echo "<td>Docente</td>";
                                                            break;
                                                        case 5:
                                                            echo "<td>Supervisão</td>";
                                                            break;
                                                        case 6:
                                                            echo "<td>Coordenação</td>";
                                                            break;
                                                        case 3:
                                                            echo "<td>RH</td>";
                                                            break;
                                                    } 
                                                if($info['ativo'] == 1){
									               echo "<td>SIM</td>";
								                }else if($info['ativo'] == 0){
									               echo "<td>NÃO</td>";
								                }
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
                                            <?php pagination("id_usu", "usuario"); ?>
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
    <script src="search.js"></script>
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="\siaeteot/assets/js/function-delete.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>
