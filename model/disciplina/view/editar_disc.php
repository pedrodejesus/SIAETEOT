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
                $id_disc = (int) $_GET['id_disc'];
                $sql = mysqli_query($conexao, "select * from disciplina where id_disc = '".$id_disc."';");
                $row = mysqli_fetch_array($sql);
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Editar disciplina <?php echo $row["id_disc"]." - ".$row["nome_disc"];?></h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/atualiza_disc.php?id_disc=<?php echo $row["id_disc"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_disc" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text"name="id_disc" id="id_disc" value="<?php echo $row["id_disc"];?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_disc" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="100" name="nome_disc" id="nome_disc" value="<?php echo $row["nome_disc"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="sigla_disc" class="form-control-label">Sigla</label>
                                                    <input class="form-control" type="text" maxlength="10" name="sigla_disc" id="sigla_disc" value="<?php echo $row["sigla_disc"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_cur">Curso</label>
                                                    <select id="id_cur" name="id_cur" class="form-control">
                                                        <option value="0"<?php if (!(strcmp(0, htmlentities($row["id_cur"], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Administração</option>
                                                        <option value="1"<?php if (!(strcmp(1, htmlentities($row["id_cur"], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Formação Geral</option>
                                                        <option value="3"<?php if (!(strcmp(3, htmlentities($row["id_cur"], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Análises Clínicas</option>
                                                        <option value="4"<?php if (!(strcmp(4, htmlentities($row["id_cur"], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Gerência em Saúde</option>
                                                        <option value="5"<?php if (!(strcmp(5, htmlentities($row["id_cur"], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Informática para Internet</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_disciplina.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
