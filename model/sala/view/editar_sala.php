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
</head>
<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            
            <?php
                include "../../../base/sidebar.php";
                include("../../../base/conexao.php");
                $id_sala = (int) $_GET['id_sala'];
                $sql = mysql_query("select * from sala where id_sala = '".$id_sala."';");
                $row = mysql_fetch_array($sql);
            ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    Editar sala <?php echo $row["id_sala"]." - ".$row["nome_sala"];?>
                                </div>

                                <div class="card-body">
                                    <form action="../controller/atualiza_sala.php?id_sala=<?php echo $row["id_sala"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_sala" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text" name="id_sala" id="id_sala" value="<?php echo $row["id_sala"]; ?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_sala" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="20" name="nome_sala" id="nome_sala" value="<?php echo $row["nome_sala"]; ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="situacao" class="form-control-label">Situação</label>
                                                    <input class="form-control" type="text" maxlength="100" name="situacao" id="situacao" value="<?php echo $row["situacao"]; ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="capacidade" class="form-control-label">Capacidade</label>
                                                    <input class="form-control" type="text" maxlength="10" name="capacidade" id="capacidade" value="<?php echo $row["capacidade"]; ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tipo" class="form-control-label">Tipo</label>
                                                    <input class="form-control" type="text" name="tipo" id="tipo" value="<?php echo $row["tipo"]; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_sala.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
    
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\projeto/assets/js/popper.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src="\projeto/assets/js/demo.js"></script>

</body>

</html>