<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
include "../../../base/head.php"
?>
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php
                include "../../../base/sidebar.php";
                include("../../../base/conexao.php");

                $id_usu = (int) $_GET['id_usu'];
                $sql = mysqli_query($conexao, "select * from usuario where id_usu = '".$id_usu."';");
                $row = mysqli_fetch_array($sql);
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Editar usuário <?php echo $row["id_usu"]." - ".$row["nome_usu"];?></h4>
                                </div>

                                <div class="card-body">
                                    <form action="../controller/atualiza_usu.php?id_usu=<?php echo $row["id_usu"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_usu" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text" name="id_usu" id="id_usu" value="<?php echo $row["id_usu"];?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_usu" class="form-control-label">Nome do Usuário</label>
                                                    <input class="form-control" type="text" maxlength="30" name="nome_usu" id="nome_usu" value="<?php echo $row["nome_usu"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="usuario" class="form-control-label">Usuário</label>
                                                    <input class="form-control" type="text" name="usuario" id="usuario" value="<?php echo $row["usuario"];?>" />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="senha" class="form-control-label">Senha</label>
                                                    <input class="form-control" type="text" name="senha" id="senha" value="<?php echo $row["senha"];?>" readonly/>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email" class="form-control-label">E-mail</label>
                                                    <input class="form-control" type="text" name="email" id="email" value="<?php echo $row["email"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nivel" class="form-control-label">Nível</label>
                                                    <select class="form-control" name="nivel" id="nivel">
                                                        <option value="1"<?php if (!(strcmp(1, htmlentities($row['nivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Secretaria</option>
                                                        <option value="2"<?php if (!(strcmp(2, htmlentities($row['nivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Administrador</option>
                                                        <option value="3"<?php if (!(strcmp(3, htmlentities($row['nivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Docente</option>
                                                        <option value="4"<?php if (!(strcmp(4, htmlentities($row['nivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Aluno</option>
                                                        <option value="5"<?php if (!(strcmp(5, htmlentities($row['nivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Supervisão</option>
                                                        <option value="6"<?php if (!(strcmp(6, htmlentities($row['nivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Coordenação</option>
                                                        <option value="7"<?php if (!(strcmp(7, htmlentities($row['nivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Orientação Educacional</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="dt_cadastro" class="form-control-label">Data do cadastro</label>
                                                    <input class="form-control" type="text" name="dt_cadastro" id="dt_cadastro" value="<?php echo $row["dt_cadastro"];?>" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_usuario.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
