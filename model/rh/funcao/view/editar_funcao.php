<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 3)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'funcao';
include "../../../../base/head.php";
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php
                include "../../../../base/sidebar/3_sidebar_rh.php";
                include("../../../../base/conexao.php");
                $id_funcao = (int) $_GET['id_funcao'];
                $sql = mysqli_query($conexao, "select * from funcao where id_funcao = '".$id_funcao."';");
                $row = mysqli_fetch_array($sql);
            ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\projeto/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\projeto/model/rh/funcao/lista_funcao.php">Funções</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Editar função <?php echo $row["id_funcao"]." - ".$row["nome_funcao"];?></h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/atualiza_funcao.php?id_funcao=<?php echo $row["id_funcao"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_funcao" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text"name="id_funcao" id="id_funcao" value="<?php echo $row["id_funcao"];?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_funcao" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="20" name="nome_funcao" id="nome_funcao" value="<?php echo $row["nome_funcao"];?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_funcao.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
