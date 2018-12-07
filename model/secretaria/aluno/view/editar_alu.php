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
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php
                include "../../../../base/sidebar/8_sidebar_secretaria.php";
                include "../../../../base/conexao.php";

                $matricula_alu = $_GET['matricula_alu'];
                $sql = "call select_dados_alu($matricula_alu)";
                $query = mysqli_query($conexao, $sql);
                $row   = mysqli_fetch_array($query);
            ?>
            <div class="content">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-light">
                        <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="\siaeteot/model/secretaria/aluno/lista_aluno.php">Alunos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar</li>
                    </ol>
                </nav>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#pess" role="tab" aria-controls="home" aria-expanded="true"><i class="fal fa-user-graduate"></i> Dados pessoais</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#docs" role="tab" aria-controls="profile" aria-expanded="false"><i class="fal fa-id-card"></i> Documentos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#comp" role="tab" aria-controls="test" aria-expanded="false"><i class="fal fa-info-circle"></i> Dados complementares</a>
                            </li>
                        </ul>
                        <form action="../controller/atualiza_alu.php?matricula_alu=<?php echo $row["matricula_alu"]; ?>" method="post">
                            <div class="tab-content">
                                <div class="tab-pane active" id="pess" role="tabpanel" aria-expanded="true">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h4>Editar aluno(a) <?php echo $row["matricula_alu"]." - ".$row["nome_alu"];?></h4>
                                        </div>
                                        <div class="card-body">
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
                                                            <label for="dt_nasc_alu" class="form-control-label">Data de nascimento</label>
                                                            <input class="form-control" type="date" name="dt_nasc_alu" id="dt_nasc_alu" value="<?php echo $row['dt_nasc_alu']; ?>" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="sexo_alu">Sexo</label>
                                                            <select id="sexo_alu" name="sexo_alu" class="form-control">
                                                                <option value="M"<?php if (!(strcmp('M', htmlentities($row['sexo_alu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Masculino</option>
                                                                <option value="F"<?php if (!(strcmp('F', htmlentities($row['sexo_alu'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Feminino</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nome_pai" class="form-control-label">Nome do pai</label>
                                                            <input class="form-control" type="text" maxlength="100" name="nome_pai" id="nome_pai" value="<?php echo $row["nome_pai"];?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="rg_pai" class="form-control-label">RG pai</label>
                                                            <input class="form-control" type="text" maxlength="12" name="rg_pai" id="rg_pai" value="<?php echo $row["rg_pai"];?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nome_mae" class="form-control-label">Nome da mãe</label>
                                                            <input class="form-control" type="text" maxlength="100" name="nome_mae" id="nome_mae" value="<?php echo $row["nome_mae"];?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="rg_mae" class="form-control-label">RG mãe</label>
                                                            <input class="form-control" type="text" maxlength="12" name="rg_mae" id="rg_mae" value="<?php echo $row["rg_mae"];?>"  />
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="resp" class="form-control-label">Responsável</label>
                                                            <input class="form-control" type="text" maxlength="100" name="resp" id="resp" value="<?php echo $row["responsavel"];?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="rg_resp" class="form-control-label">RG responsável</label>
                                                            <input class="form-control" type="text" maxlength="12" name="rg_resp" id="rg_resp" value="<?php echo $row["rg_resp"];?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="cel_alu" class="form-control-label">Celular</label>
                                                    <input class="form-control" type="text" name="cel_alu" id="cel_alu" />
                                                </div>
                                            </div> 
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="tel_alu" class="form-control-label">Telefone</label>
                                                    <input class="form-control" type="text" name="tel_alu" id="tel_alu" />
                                                </div>
                                            </div> 
                                                    <div class="col-md-2">
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
                                                            <a onclick="window.history.back();"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="docs" role="tabpanel" aria-expanded="false">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h4>Editar aluno(a) <?php echo $row["matricula_alu"]." - ".$row["nome_alu"];?></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="certidao_tipo" class="form-control-label">Tipo de Certidão</label>
                                                        <select id="sexo_alu" name="sexo_alu" class="form-control">
                                                            <option value="M"<?php if (!(strcmp('', htmlentities($row['certidao_tipo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Selecione</option>
                                                            <option value="M"<?php if (!(strcmp('1', htmlentities($row['certidao_tipo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Certidão de Nascimento</option>
                                                            <option value="F"<?php if (!(strcmp('2', htmlentities($row['certidao_tipo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Certidão de Casamento</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="certidao_termo">Termo</label>
                                                        <input id="certidao_termo" name="certidao_termo" class="form-control" value="<?php echo $row["certidao_termo"];?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="certidao_circ">Circunscrição</label>
                                                        <input id="certidao_circ" name="certidao_circ" class="form-control" value="<?php echo $row["certidao_circ"];?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="certidao_livro">Livro</label>
                                                        <input id="certidao_livro" name="certidao_livro" class="form-control" value="<?php echo $row["certidao_livro"];?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="certidao_folha">Folha</label>
                                                        <input id="certidao_folha" name="certidao_folha" class="form-control" value="<?php echo $row["certidao_folha"];?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="certidao_cidade">Cidade</label>
                                                        <input id="certidao_cidade" name="certidao_cidade" class="form-control" value="<?php echo $row["certidao_cidade"];?>" maxlength="20" />
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="certidao_uf">UF</label>
                                                        <input id="certidao_uf" name="certidao_uf" class="form-control" value="<?php echo $row["certidao_uf"];?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="identidade_rg">RG Identidade</label>
                                                        <input id="identidade_rg" name="identidade_rg" class="form-control" value="<?php echo $row["identidade_rg"];?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="identidade_dt_exp">Data Expedição Identidade</label>
                                                        <input type='date' id="identidade_dt_exp" name="identidade_dt_exp" class="form-control" value="<?php echo $row["identidade_dt_exp"]?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="identidade_org_exp">Orgão Emissor Identidade</label>
                                                        <input id="identidade_org_exp" name="identidade_org_exp" class="form-control" value="<?php echo $row["identidade_org_exp"];?>" maxlength="20" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="naturalidade">Naturalidade</label>
                                                        <input id="naturalidade" name="naturalidade" class="form-control" value="<?php echo $row["naturalidade"];?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="btn-group" role="group"> 
                                                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                            <a onclick="window.history.back();"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="comp" role="tabpanel" aria-expanded="false">
                                    <div class="card">
                                        <div class="card-header bg-light">
                                            <h4>Editar aluno(a) <?php echo $row["matricula_alu"]." - ".$row["nome_alu"]; ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="\siaeteot/assets/js/cep.js"></script>
	<script src="\siaeteot/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\siaeteot/assets/js/script_mask.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>

</html>
