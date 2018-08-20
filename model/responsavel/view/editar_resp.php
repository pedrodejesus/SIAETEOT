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
<script src="\projeto/assets/js/jquery-migrate-1.4.1"></script>
<script src="\projeto/assets/js/jquery.autocomplete.js"></script>
<link href="\projeto/assets/js/jquery.autocomplete.css" rel="stylesheet">
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script type="text/javascript">
    $().ready(function() {
        $("#matricula_alu").autocomplete("filtra_alu.php", {
            width: 250,
            matchContains: true,
            //mustMatch: true,
            //minChars: 0,
            //multiple: true,
            //highlight: false,
            //multipleSeparator: ",",
            selectFirst: false
        });
    });
</script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php
                include "../../../base/sidebar.php";
                include("../../../base/conexao.php");

                $id_resp = (int) $_GET['id_resp'];
                $sql  = "select r.id_resp, r.nome_resp, r.sobrenome_resp, r.cpf_resp, r.rg_resp, ";
                $sql .= "r.cel_resp, r.tel_resp, r.email_resp, r.matricula_alu, ";
                $sql .= "a.matricula_alu, a.nome_alu, a.sobrenome_alu ";
                $sql .= "from responsavel r, aluno a ";
                $sql .= "where r.matricula_alu = a.matricula_alu ";
                $sql .= "and r.id_resp = '".$id_resp."';";
                $query = mysql_query($sql);
                $row = mysql_fetch_array($query);
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Editar responsável <?php echo $row["id_resp"]." - ".$row["nome_resp"]." ".$row["sobrenome_resp"];?></h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/atualiza_resp.php?id_resp=<?php echo $row["id_resp"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="id_resp" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text" name="id_resp" id="id_resp" value="<?php echo $row["id_resp"];?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_resp" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="30" name="nome_resp" id="nome_resp" value="<?php echo $row["nome_resp"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="sobrenome_resp" class="form-control-label">Sobrenome</label>
                                                    <input class="form-control" type="text" maxlength="70" name="sobrenome_resp" id="sobrenome_resp" value="<?php echo $row["sobrenome_resp"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cpf_resp" class="form-control-label">CPF</label>
                                                    <input class="form-control" type="text" name="cpf_resp" id="cpf_resp" value="<?php echo $row["cpf_resp"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="rg_resp" class="form-control-label">RG</label>
                                                    <input class="form-control" type="text" maxlength="20" name="rg_resp" id="rg_resp" value="<?php echo $row["rg_resp"];?>" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="cel_resp" class="form-control-label">Celular</label>
                                                    <input class="form-control" type="text" name="cel_resp" id="cel_resp" value="<?php echo $row["cel_resp"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="tel_resp" class="form-control-label">Telefone</label>
                                                    <input class="form-control" type="text" name="tel_resp" id="tel_resp" value="<?php echo $row["tel_resp"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email_resp" class="form-control-label">E-mail</label>
                                                    <input class="form-control" type="text" name="email_resp" id="email_resp" value="<?php echo $row['email_resp']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="matricula_alu" class="form-control-label">Aluno referente</label>
                                                    <input class="form-control" type="text" name="matricula_alu" id="matricula_alu" value="<?php echo $row['matricula_alu']." - ".$row['nome_alu']." ".$row['sobrenome_alu']; ?>" required />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_responsavel.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
	<script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
