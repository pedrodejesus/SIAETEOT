<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'aluno';
require "../../../base/function.php";
include "../../../base/head.php";
?>
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
                        <li class="breadcrumb-item active" aria-current="page">Alunos</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <div class="row">
                                    <div class="col-md-2">
                                        <h3>Alunos</h3>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="text" id="busca" onkeyup="searchAlu(this.value)" class="form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Pesquisar</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="view/cadastrar_alu.php"><button id='add' type="button" class="btn btn-primary col-sm-12"><i class="fa fa-plus-circle"></i>&nbsp; Adicionar</button></a>
                                    </div>
                                </div>
                            </div>
                            <div id="card-body" class="card-body">
                            <?php include "messages.php"; ?>
                                <div id="table-list" class="table-responsive">
                                    <table cellpadding="20" id="tabela_alu" class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Matrícula&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th scope="col">Nome</th>
                                                <th scope="col">Sobrenome&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th scope="col">CPF</th>
                                                <th scope="col">Nascimento&nbsp;&nbsp;&nbsp;</th>
                                                <th scope="col">Modalidade</th>
                                                <th scope="col">CEP</th>
                                                <th scope="col">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody_alu">
                                        <?php
                                            include("../../../base/conexao.php");
                                                    
                                            $quantidade = 10; //Quantidade de registros exibidos
                                            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
                                            $inicio = ($quantidade * $pagina) - $quantidade;

                                            $data = mysqli_query($conexao, "select * from aluno order by nome_alu asc limit $inicio, $quantidade;")/* or die(mysql_error())*/;
                                                
                                            while($info = mysqli_fetch_array($data)){
                                                echo "<tr scope='row'>";
                                                echo "<td>".$info['matricula_alu']."</td>";
                                                echo "<td>".$info['nome_alu']."</td>";
                                                echo "<td>".$info['sobrenome_alu']."</td>"; 
                                                echo "<td>".$info['cpf_alu']."</td>";
                                                echo "<td>".implode("/", array_reverse(explode("-", $info['dt_nasc_alu'])))."</td>";
                                                switch($info['tipo_alu']){
                                                    case "I";
                                                        echo "<td>Ensino Integrado</td>";
                                                        break;
                                                    case "S";
                                                        echo "<td>Ensino Subsequente</td>";
                                                        break;
                                                }
                                                echo "<td>".$info['cep']."</td>";
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
                                            <?php pagination("matricula_alu", "aluno"); ?>
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
