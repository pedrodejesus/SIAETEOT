<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 3)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'func';
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
                $id_func = (int) $_GET['id_func'];
                $sql = mysqli_query($conexao, "select * from funcionario where id_func = '".$id_func."';");
                $row = mysqli_fetch_array($sql);
                
                $sql2 = mysqli_query($conexao, "select * from localidade where cep = '".$row["cep"]."';");
                $row2 = mysqli_fetch_array($sql2);
            ?>

            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\siaeteot/model/rh/funcionario/lista_funcionario.php">Funcionários</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <h4>Editar Funcionário <?php echo $row["id_func"]." - ".$row["nome_func"]." ".$row["sobrenome_func"];?></h4>
                                        </div>
                                    </div>  
                                </div>

                                <div class="card-body">
                                    <form action="../controller/atualiza_func.php?id_func=<?php echo $row["id_func"]; ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_func" class="form-control-label">ID</label>
                                                    <input class="form-control" type="text" size="15" maxlength="256" name="id_func" id="id_func" value="<?php echo $row["id_func"];?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="nome_func" class="form-control-label">Nome</label>
                                                    <input class="form-control" type="text" maxlength="30" name="nome_func" id="nome_func" value="<?php echo $row["nome_func"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="sobrenome_func" class="form-control-label">Sobrenome</label>
                                                    <input class="form-control" type="text" maxlength="70" name="sobrenome_func" id="sobrenome_func" value="<?php echo $row["sobrenome_func"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="id_setor">Setor</label>
                                                    <select id="id_setor" name="id_setor" class="form-control">
                                                        <?php
                                                            $data = mysqli_query($conexao, "select * from setor") or die(mysql_error());
                                                            while($info = mysqli_fetch_array($data)){
                                                                echo "<option value='".$info['id_setor']."'>".$info['nome_setor']."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cpf_func" class="form-control-label">CPF</label>
                                                    <input class="form-control" type="text" name="cpf_func" id="cpf_func" value="<?php echo $row["cpf_func"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="rg_func" class="form-control-label">RG</label>
                                                    <input class="form-control" type="text" maxlength="20" name="rg_func" id="rg_func" value="<?php echo $row["rg_func"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="dt_nasc_func" class="form-control-label">Data de nascimento</label>
                                                    <input class="form-control" type="date" name="dt_nasc_func" id="dt_nasc_func" value="<?php echo $row['dt_nasc_func']; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cep" class="form-control-label">CEP</label>
                                                    <input class="form-control" type="text" name="cep" id="cep" value="<?php echo $row["cep"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="num_resid_func">Número da residência</label>
                                                    <input id="num_resid_func" name="num_resid_func" class="form-control" value="<?php echo $row["num_resid_func"];?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="complemento_func">Complemento</label>
                                                    <input id="complemento_func" name="complemento_func" class="form-control" value="<?php echo $row["complemento_func"];?>" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="logradouro" class="form-control-label">Logradouro</label>
                                                    <input class="form-control" type="text" name="logradouro" id="logradouro" value="<?php echo $row2["tp_logradouro"]." ".$row2["logradouro"];?>" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="bairro">Bairro</label>
                                                    <input id="bairro" name="bairro" class="form-control" value="<?php echo $row2["bairro"]?>" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cidade">Cidade</label>
                                                    <input id="cidade" name="cidade" class="form-control" value="<?php echo $row2["cidade"]?>" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="uf">UF</label>
                                                    <input id="uf" name="uf" class="form-control" value="<?php echo $row2["uf"]?>" disabled />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                    <a href="../lista_funcionario.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
    
    <script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\siaeteot/assets/js/popper.min.js"></script>
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
    <script src="\siaeteot/assets/js/cep.js"></script>
	<script src="\siaeteot/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\siaeteot/assets/js/script_mask.js"></script>
    <script src="\siaeteot/assets/js/chart.min.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
    <script src="\siaeteot/assets/js/demo.js"></script>

</body>

</html>
