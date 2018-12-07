

<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if ($_SESSION['UsuarioNivel'] != 1) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'aluno';
include "../../../base/head.php";
?>
<script src="\siaeteot/assets/js/jquery-3.3.1.min.js"></script>
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
</head>
<body>
    <div class="page-wrapper flex-row align-items-center">
        <div class="container">
            <form action="atualiza_login.php" method="post">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card p-4">
                        <div class="card-header text-center text-uppercase h3 font-weight-light">
                            Registro
                        </div>
                        <div class="card-body py-5">
                            <h4>Olá <?php echo $_SESSION['nome_alu'] ?>, este é o seu primeiro acesso. Seja bem vindo ao SIAETEOT :)</h4>
                                    <p><h6>Por favor, complete os campos abaixo com seus dados. Após, você será redirecionado para a tela inicial.</h6></p>
                                    <p><h6>Futuramente, você poderá acessar o sistema utilizando a sua matrícula, seu nome de usuário ou o seu e-mail, em conjunto com a senha definida aqui.<br><br></h6></p>
                            
                            <div class="form-group">
                                <label class="form-control-label">Nome de usuário</label>
                                <input class="form-control" type="text" name="usuario_alu" id="usuario_alu" value="<?php echo $_SESSION['matricula_alu'] ?>" required />
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">E-mail</label>
                                <input class="form-control" type="email" maxlength="40" name="email_alu" id="email_alu" required />
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <input class="form-control" type="password" name="senha_alu" id="senha_alu" required />
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Confirm Password</label>
                                <input onblur="Verifica()" class="form-control" type="password" name="confirma_senha_alu" id="confirma_senha_alu" required />
                                <small id="aviso_senha" class="form-text text-danger"></small>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button id="teste" type="submit" class="btn btn-success btn-block">Registrar</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script src="\siaeteot/assets/js/bootstrap.min.js"></script>
	<script src="\siaeteot/assets/js/cep.js"></script>
	<script src="\siaeteot/assets/js/jquery.inputmask.bundle.js"></script>
	<script src="\siaeteot/assets/js/script_mask.js"></script>
    <script src="\siaeteot/assets/js/carbon.js"></script>
</body>
</html>

