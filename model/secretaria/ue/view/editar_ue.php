<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'ue';
include "../../../../base/head.php";
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php
                include "../../../../base/sidebar/8_sidebar_secretaria.php";
                include("../../../../base/conexao.php");

                $id_ue = (int) $_GET['id_ue'];
                $sql = mysqli_query($conexao, "select * from unidade_estudantil where id_ue = '".$id_ue."';");
                $row = mysqli_fetch_array($sql);
            ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\siaeteot/model/secretaria/ue/lista_ue.php">Unidades Escolares</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Editar unidade escolar <?php echo $row["id_ue"]." - ".$row["nome_ue"];?></h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/atualiza_ue.php?id_ue=<?php echo $row["id_ue"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_ue" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text"name="id_ue" id="id_ue" value="<?php echo $row["id_ue"];?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_ue" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="20" name="nome_ue" id="nome_ue" value="<?php echo $row["nome_ue"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="tel_ue" class="form-control-label">Telefone</label>
                                                    <input class="form-control" type="text" name="tel_ue" id="tel_ue" value="<?php echo $row["tel_ue"];?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_ue.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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

    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
	<script src="\siaeteot/assets/js/script_mask.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>
