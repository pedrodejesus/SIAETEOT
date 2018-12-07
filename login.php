<?php
include "base/head.php"
?>
</head>
<body>
    <div class="page-wrapper flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <form action="base/validacao.php" method="post" class="col-lg-8"> 
                    <div class="card p-4">
                        <?php 
                            if(isset($_GET['msg'])){
                                $msg = $_GET['msg'];
                                switch($msg){
                                    case 1:
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Usuário ou senha incorretos ou inexistentes!
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>';
                                        break;
                                    case 2:
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Usuário bloqueado!
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>';
                                        break;
                                    case 3:
                                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Usuário inexistente!
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>';
                                        break;
                                    case 3:
                                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Usuário sem permissão de acesso!
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>';
                                        break;
                                }
                                $msg = 0;
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <img src="assets/img/logo.jpg" class="img-fluid" />
                                <div class="card-header text-center text-uppercase h4 font-weight-light">SIAETEOT</div>
                                <h5 class="text-center">LOGIN</h5>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-control-label">Usuário</label>
                                        <input type="text" id="usuario" name="usuario" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Senha</label>
                                        <input type="password" id="senha" name="senha" class="form-control">
                                    </div>

                                    <div class="custom-control custom-checkbox mt-4">
                                        <input type="checkbox" class="custom-control-input" id="aluno" name="aluno">
                                        <label class="custom-control-label" for="aluno">Sou aluno</label>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary px-5">Login</button>
                                        </div>

                                        <div class="col-6">
                                            <a href="#" class="btn btn-link">Esqueci minha senha</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
</body>

</html>
