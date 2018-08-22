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

                $id_turma = (int) $_GET['id_turma'];
                $sql = mysqli_query($conexao, "select * from turma where id_turma = '".$id_turma."';");
                $row = mysqli_fetch_array($sql);
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Editar turma <?php echo $row["numero"]." / ".$row["ano_letivo"];?></h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/atualiza_turma.php?id_turma=<?php echo $row["id_turma"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_turma" class="form-control-label">Matrícula</label>
                                                    <input class="form-control" type="text"name="id_turma" id="id_turma" value="<?php echo $row["id_turma"];?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_disc" class="form-control-label">Número</label>
                                                    <input class="form-control" type="text" maxlength="4" name="numero" id="numero" value="<?php echo $row["numero"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="ano_letivo" class="form-control-label">Ano letivo</label>
                                                    <input class="form-control" type="text" maxlength="4" name="ano_letivo" id="ano_letivo" value="<?php echo $row["ano_letivo"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="situacao" class="form-control-label">Situação</label>
                                                    <select class="form-control" name="situacao" id="situacao">
                                                        <option value="0"<?php if (!(strcmp(0, htmlentities($row['situacao'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Encerrada</option>
                                                        <option value="1"<?php if (!(strcmp(1, htmlentities($row['situacao'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Ativa</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="turno" class="form-control-label">Turno</label>
                                                    <select class="form-control" name="turno" id="turno">
                                                        <option value="1"<?php if (!(strcmp(1, htmlentities($row['turno'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Manhã</option>
                                                        <option value="2"<?php if (!(strcmp(2, htmlentities($row['turno'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Tarde</option>
                                                        <option value="3"<?php if (!(strcmp(3, htmlentities($row['turno'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Noite</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_cur" class="form-control-label">Curso</label>
                                                    <select class="form-control" name="id_cur" id="id_cur">
                                                        <option value="0" <?php if (!(strcmp(0, htmlentities($row['id_cur'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Administração</option>
                                                        <option value="3" <?php if (!(strcmp(3, htmlentities($row['id_cur'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Análises Clínicas</option>
                                                        <option value="4" <?php if (!(strcmp(4, htmlentities($row['id_cur'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Gerência em Saúde</option>
                                                        <option value="5" <?php if (!(strcmp(5, htmlentities($row['id_cur'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Informática para Internet</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="dt_inicio" class="form-control-label">Data de início</label>
                                                    <input class="form-control" type="date" name="dt_inicio" id="dt_inicio" value="<?php echo $row["dt_inicio"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="dt_fim" class="form-control-label">Data de fim</label>
                                                    <input class="form-control" type="date" name="dt_fim" id="dt_fim" value="<?php echo $row["dt_fim"];?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_turma.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
