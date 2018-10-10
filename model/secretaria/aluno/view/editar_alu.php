<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 8)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'aluno';
include "../../../../base/head.php";
?>
<style>input{text-transform: uppercase!important;}</style><!--Deixa inputs com letra maiúscula-->
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php
                include "../../../../base/sidebar/8_sidebar_secretaria.php";
                include "../../../../base/conexao.php";

                $matricula_alu = $_GET['matricula_alu'];
                $sql   = "select a.matricula_alu, a.nome_alu, a.sobrenome_alu, a.cpf_alu, a.rg_alu, a.dt_nasc_alu, ";
                $sql  .= "a.nome_pai, a.nome_mae, a.sexo_alu, a.tipo_alu, a.cep, a.num_resid_alu, a.complemento_alu, ";
                $sql  .= "l.cep, l.tp_logradouro, l.logradouro, l.bairro, l.cidade, l.uf ";
                $sql  .= "from aluno a, localidade l ";
                $sql  .= "where a.cep = l.cep ";
                $sql  .= "and a.matricula_alu = '".$matricula_alu."';";
                $query = mysqli_query($conexao, $sql);
                $row   = mysqli_fetch_array($query);
            ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\projeto/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\projeto/model/secretaria/aluno/lista_aluno.php">Alunos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Editar aluno(a) <?php echo $row["matricula_alu"]." - ".$row["nome_alu"];?></h4>
                                </div>
                                <div class="card-body">
                                    <form action="../controller/atualiza_alu.php?matricula_alu=<?php echo $row["matricula_alu"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <script>
                                                    function SomenteNumero(e){
                                                        var tecla=(window.event)?event.keyCode:e.which;   
                                                        if((tecla>47 && tecla<58)) return true;
                                                        else{
                                                            if (tecla==8 || tecla==0) return true;
                                                        else  return false;
                                                        }
                                                    }
                                                </script>
                                                <div class="form-group">
                                                    <label for="matricula_alu" class="form-control-label">Matrícula</label>
                                                    <input onkeypress='return SomenteNumero(event)' class="form-control" type="text" maxlength="18" name="matricula_alu" id="matricula_alu" value="<?php echo $row["matricula_alu"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_alu" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="30" name="nome_alu" id="nome_alu" value="<?php echo $row["nome_alu"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="sobrenome_alu" class="form-control-label">Sobrenome</label>
                                                    <input class="form-control" type="text" maxlength="70" name="sobrenome_alu" id="sobrenome_alu" value="<?php echo $row["sobrenome_alu"];?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cpf_alu" class="form-control-label">CPF</label>
                                                    <input class="form-control" type="text" name="cpf_alu" id="cpf_alu" value="<?php echo $row["cpf_alu"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="rg_alu" class="form-control-label">RG</label>
                                                    <input onkeypress='return SomenteNumero(event)' class="form-control" type="text" maxlength="20" name="rg_alu" id="rg_alu" value="<?php echo $row["rg_alu"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dt_nasc_alu" class="form-control-label">Data de nascimento</label>
                                                    <input class="form-control" type="date" name="dt_nasc_alu" id="dt_nasc_alu" value="<?php echo $row['dt_nasc_alu']; ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_pai" class="form-control-label">Nome do pai</label>
                                                    <input class="form-control" type="text" maxlength="100" name="nome_pai" id="nome_pai" value="<?php echo $row["nome_pai"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_mae" class="form-control-label">Nome da mãe</label>
                                                    <input class="form-control" type="text" maxlength="100" name="nome_mae" id="nome_mae" value="<?php echo $row["nome_mae"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="sexo_alu">Sexo</label>
                                                    <select id="sexo_alu" name="sexo_alu" class="form-control">
                                                        <option value="M"<?php if (!(strcmp('M', htmlentities($row['sexo_alu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Masculino</option>
                                                        <option value="F"<?php if (!(strcmp('F', htmlentities($row['sexo_alu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Feminino</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="tipo_alu">Tipo do aluno</label>
                                                    <select id="tipo_alu" name="tipo_alu" class="form-control">
                                                        <option value="S"<?php if (!(strcmp('S', htmlentities($row['tipo_alu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Ensino Subsequente</option>
                                                        <option value="I"<?php if (!(strcmp('I', htmlentities($row['tipo_alu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Ensino Integrado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cep" class="form-control-label">CEP</label>
                                                    <input class="form-control" type="text" name="cep" id="cep" value="<?php echo $row["cep"];?>" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="num_resid_alu">Número da residência</label>
                                                    <input id="num_resid_alu" name="num_resid_alu" class="form-control" value="<?php echo $row["num_resid_alu"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="complemento_alu">Complemento</label>
                                                    <input id="complemento_alu" name="complemento_alu" class="form-control" value="<?php echo $row["complemento_alu"];?>" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="logradouro" class="form-control-label">Logradouro</label>
                                                    <input class="form-control" type="text" name="logradouro" id="logradouro" value="<?php echo $row["tp_logradouro"]." ".$row["logradouro"];?>" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="bairro">Bairro</label>
                                                    <input id="bairro" name="bairro" class="form-control" value="<?php echo $row["bairro"]?>" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cidade">Cidade</label>
                                                    <input id="cidade" name="cidade" class="form-control" value="<?php echo $row["cidade"]?>" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="uf">UF</label>
                                                    <input id="uf" name="uf" class="form-control" value="<?php echo $row["uf"]?>" disabled />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_aluno.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
    
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/cep.js"></script>
	<script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
