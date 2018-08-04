<?php

if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente
$nivel_necessario = 2;

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: index.php"); exit; // Redireciona o visitante de volta pro login
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ETEOT - Escola Técnica Estadual Oscar Tenório</title>

    <link href="\projeto/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">

        <?php include "../../../base/nav.php" ?>

        <div class="main-container">

            <?php include "../../../base/sidebar.php" ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    Adicionar usuário do sistema
                                </div>

                                <div class="card-body">
                                    <form action="../controller/insere_usu.php" method="post">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="id_usu" class="form-control-label">ID</label>
                                                <input class="form-control" type="text" name="id_usu" id="id_usu" placeholder="0" readonly />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nome_usu" class="form-control-label">Nome do Usuário</label>
                                                <input class="form-control" type="text" maxlength="30" name="nome_usu" id="nome_usu" />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="usuario" class="form-control-label">Usuário</label>
                                                <input class="form-control" type="text" name="usuario" id="usuario" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="senha" class="form-control-label">Senha</label>
                                                <input class="form-control" type="password" name="senha" id="senha" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email" class="form-control-label">E-mail</label>
                                                <input class="form-control" type="text" name="email" id="email" />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nivel" class="form-control-label">Nível</label>
                                                <select class="form-control" name="nivel" id="nivel">
                                                    <option value="1" >Secretaria</option>
                                                    <option value="2" >Administrador</option>
                                                    <option value="3">Docente</option>		
                                                    <option value="4">Aluno</option>		
                                                    <option value="5">Supervisão</option>		
                                                    <option value="6">Coordenação</option>		
                                                    <option value="7">Orientação Educacional</option>		
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="ativo" class="form-control-label">Ativo?</label><br>
                                                <div class="form-check form-check-inline ">
                                                    <input class="form-check-input" type="radio" name="ativo" id="ativo" value="1">
                                                    <label class="form-check-label" for="ativo">Sim</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="ativo" id="iativo" value="0">
                                                    <label class="form-check-label" for="ativo">Não</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dt_cadastro" class="form-control-label">Data do cadastro</label>
                                                <input class="form-control" type="text" name="dt_cadastro" id="dt_cadastro" placeholder="<?php echo date('d/m/Y'); ?> " readonly />
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
	<script src="\projeto/assets/js/cep.js"></script>
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\projeto/assets/js/popper.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
	<script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/chart.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src="\projeto/assets/js/demo.js"></script>

</body>

</html>
