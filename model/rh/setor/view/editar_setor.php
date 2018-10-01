<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
include "../../../base/head.php"
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container"> 
            <?php
                include "../../../base/sidebar.php";
                include("../../../base/conexao.php");

                $id_setor = (int) $_GET['id_setor'];
                $sql = mysql_query("select * from setor where id_setor = '".$id_setor."';");
                $row = mysql_fetch_array($sql);
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Editar setor <?php echo $row["id_setor"]." - ".$row["nome_setor"];?></h4>
                                </div>

                                <div class="card-body">
                                    <form action="../controller/atualiza_setor.php?id_setor=<?php echo $row["id_setor"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_setor" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text"name="id_setor" id="id_setor" value="<?php echo $row["id_setor"];?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_setor" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="20" name="nome_setor" id="nome_setor" value="<?php echo $row["nome_setor"];?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_setor.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
    </div>

    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
