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
    <link href="\projeto/assets/js/jquery.autocomplete.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\projeto/assets/js/jquery-migrate-1.4.1"></script>
    <script src="\projeto/assets/js/jquery.autocomplete.js"></script>
    
    <script type="text/javascript">
            $().ready(function() {
                $("#id_func").autocomplete("filtra_func.php", {
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
			
			$().ready(function() {
                $("#id_disc").autocomplete("filtra_disc.php", {
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

            <?php include "../../../base/sidebar.php" ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    Cadastrar professor por disciplina
                                </div>

                                <div class="card-body">
                                    <form action="../controller/insere_ministra.php" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="id_func" class="form-control-label">Docente</label>
                                                <input class="form-control" name="id_func" id="id_func" />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="id_disc" class="form-control-label">Disciplina</label>
                                                <input class="form-control" name="id_disc" id="id_disc" />
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dt_inicio" class="form-control-label">Data de início</label>
                                                <input class="form-control" type="date" maxlength="70" name="dt_inicio" id="dt_inicio" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dt_fim" class="form-control-label">Data de fim</label>
                                                <input class="form-control" type="date" maxlength="70" name="dt_fim" id="dt_fim" />
                                                <small id="passwordHelpBlock" class="form-text text-muted">
                                                    Usar apenas para fim de um professor deixar de ministrar determinada matéria.
                                                </small>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group"> 
                                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                                                <a href="../lista_ministra.php"><button type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button></a>
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
    <script src="\projeto/assets/js/popper.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
	<script src="\projeto/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\projeto/assets/js/script_mask.js"></script>
    <script src="\projeto/assets/js/chart.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
    <script src="\projeto/assets/js/demo.js"></script>

</body>

</html>
