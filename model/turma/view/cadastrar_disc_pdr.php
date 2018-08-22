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

                $numero = (int) $_GET['numero'];
                $ano_letivo = (int) $_GET['ano_letivo'];
                $sql = mysqli_query($conexao, "select * from turma where numero = '".$numero."' and ano_letivo='".$ano_letivo."';");
                $row = mysqli_fetch_array($sql);
            ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Cadastrar disciplinas da turma <?php echo $numero."/".$ano_letivo ?></h4>
                                </div> 
                                
                                <div class="card-body">
                                    <form name="form" action="../controller/insere_disc_pdr_tur.php" method="post"> 
                                        <div class="row">
                                            <div class="col-md-12">
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5>Disciplinas de Formação Geral</h5>
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' type='checkbox' id="checkTodos" name="checkTodos">
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#checkTodos').click(function() {
                                                                if(this.checked) {
                                                                    $('.checkbox').each(function() {
                                                                        this.checked = true;
                                                                    });
                                                                } else {
                                                                    $('.checkbox').each(function() {
                                                                        this.checked = false;
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                    <label class='form-check-label' for='tudo'>Marcar/Desmarcar tudo</label>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php
                                                $sql2 = mysqli_query($conexao, "select * from disciplina where id_cur='1';");
                                                while($row2 = mysqli_fetch_array($sql2)){
                                                    echo "<div class='col-md-1'>
                                                            <div class='form-check form-check-inline'>
                                                                <input class='form-check-input checkbox' type='checkbox' id='disc_pdr_tur' name='disc_pdr_tur[]' value='".$row2['id_disc']."' data-toggle='tooltip' data-placement='top' title='".$row2['nome_disc']."'>
                                                                <label class='form-check-label' for='checkbox' data-toggle='tooltip' data-placement='top' title='".$row2['nome_disc']."'>".$row2['sigla_disc']."</label>
                                                            </div>
                                                          </div>";
                                                }
                                            ?>
                                        </div>
                                        <br><br>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5>
                                                    Disciplinas de 
                                                    <?php switch($row['id_cur']){
                                                        case 0:
                                                            echo "Administração";
                                                            break;
                                                        case 3:
                                                            echo "Análises Clínicas";
                                                            break;
                                                        case 4:
                                                            echo "Gerência em Saúde";
                                                            break;
                                                        case 5:
                                                            echo "Informática para Internet";
                                                            break;
                                                    }?>
                                                </h5>
                                                <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' type='checkbox' id="checkTodos_tecnico" name="checkTodos_tecnico">
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#checkTodos_tecnico').click(function() {
                                                                if(this.checked) {
                                                                    $('.checkbox_tecnico').each(function() {
                                                                        this.checked = true;
                                                                    });
                                                                } else {
                                                                    $('.checkbox_tecnico').each(function() {
                                                                        this.checked = false;
                                                                    });
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                    <label class='form-check-label' for='tudo'>Marcar/Desmarcar tudo</label>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <?php
                                                $sql3 = mysqli_query($conexao, "select * from disciplina where id_cur='".$row['id_cur']."';");
                                                
                                                while($row3 = mysqli_fetch_array($sql3)){
                                                    echo "<div class='col-md-1'>
                                                            <div class='form-check form-check-inline'>
                                                                <input class='form-check-input checkbox_tecnico' type='checkbox' id='disc_pdr_tur' name='disc_pdr_tur[]' value='".$row3['id_disc']."' data-toggle='tooltip' data-placement='top' title='".$row3['nome_disc']."'>
                                                                <label class='form-check-label' for='checkbox' data-toggle='tooltip' data-placement='top' title='".$row3['nome_disc']."'>".$row3['sigla_disc']."</label>
                                                            </div>
                                                          </div>";
                                                    //echo "<input type='hidden' name='id_turma' id='id_turma' value='".$id_turma."' />"; ??????????
                                                }
                                            ?>
                                        </div>
                                        <br>
                                        <input type="hidden" name="id_turma" id="id_turma" value="<?php echo $row['id_turma']; ?>" />
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
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
