<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ETEOT - Escola Técnica Estadual Oscar Tenório</title>
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="page-wrapper flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <form action="base/validacao.php" method="post" class="col-md-5">
                    <div class="card p-4">
                        <div class="col-sm-4 offset-sm-4"><img src="assets/img/logo.png" class="img-fluid" /></div>
                        <div class="card-header text-center text-uppercase h4 font-weight-light">
                            Login
                        </div>

                        <div class="card-body py-5">
                            <div class="form-group">
                                <label class="form-control-label">Usuário</label>
                                <input type="text" id="usuario" name="usuario" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Senha</label>
                                <input type="password" id="senha" name="senha" class="form-control">
                            </div>

                            <div class="custom-control custom-checkbox mt-4">
                                <input type="checkbox" class="custom-control-input" id="login">
                                <label class="custom-control-label" for="login">Lembre-me</label>
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
                </form>
            </div>
        </div>
    </div>
</body>
<!-- Referenciando as classes com scripts jQuery e bootstrap (http://getbootstrap.com/) -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/login.js"></script>

</html>
