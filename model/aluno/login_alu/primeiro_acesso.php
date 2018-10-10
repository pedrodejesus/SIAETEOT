<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if ($_SESSION['UsuarioNivel'] != 1) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'aluno';
include "../../../base/head.php";
?>
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="header-fixed">
    <div class="page-wrapper">
        <?php include "../../../base/nav.php" ?>
        <div class="main-container">
            <?php //include "../../../base/sidebar/1_sidebar_aluno.php" ?>
            <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Olá <?php echo $_SESSION['nome_alu'] ?>, este é o seu primeiro acesso. Seja bem vindo a ETEOT :)</h3>
                                    <p><h5>Por favor, complete os campos abaixo com seus dados. Após, você será redirecionado para a tela inicial.</h5></p>
                                    <p><h5>Futuramente, você poderá acessar o sistema utilizando a sua matrícula, seu nome de usuário ou o seu e-mail, em conjunto com a senha definida aqui.<br><br></h5></p>
                                    <form action="atualiza_login.php" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nome_alu" class="form-control-label">Nome do aluno</label>
                                                    <input class="form-control" type="text" name="nome_alu" id="nome_alu" value="<?php echo $_SESSION['UsuarioNome'] ?>" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="sobrenome_alu" class="form-control-label">E-mail</label>
                                                    <input class="form-control" type="email" maxlength="40" name="email_alu" id="email_alu" required />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="nome_alu" class="form-control-label">Nome de usuário</label>
                                                    <input class="form-control" type="text" name="usuario_alu" id="usuario_alu" value="<?php echo $_SESSION['matricula_alu'] ?>" required />
                                                </div>
                                            </div>
                                            <script>
                                                function Verifica(){
                                                    val1 = document.getElementById("senha_alu").value;
                                                    val2 = document.getElementById("confirma_senha_alu").value;
                                                    
                                                    if(val1!=val2){
                                                        document.getElementById("confirma_senha_alu").style.borderColor="#f00";
                                                        document.getElementById("aviso_senha").innerHTML = "As senhas não conferem!";
                                                        $("#teste").attr('disabled', 'disabled');
                                                    } else{
                                                        document.getElementById("confirma_senha_alu").style.borderColor="";
                                                        document.getElementById("aviso_senha").innerHTML = " ";
                                                        $("#teste").removeAttr('disabled');
                                                    }
                                                }
                                            </script>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="sobrenome_alu" class="form-control-label">Senha</label>
                                                    <input class="form-control" type="password" name="senha_alu" id="senha_alu" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="sobrenome_alu" class="form-control-label">Confirmar senha</label>
                                                    <input onblur="Verifica()" class="form-control" type="password" name="confirma_senha_alu" id="confirma_senha_alu" required />
                                                    <small id="aviso_senha" class="form-text text-danger"></small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="btn-group" role="group"> 
                                                    <button id="teste" type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
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
