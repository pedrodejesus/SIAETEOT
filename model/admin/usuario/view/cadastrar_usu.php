<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 0)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'aluno';
include "../../../../base/head.php";
?>
<script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
</head>

<body class="sidebar-fixed header-fixed">
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">
            <?php include "../../../../base/sidebar/0_sidebar_admin.php" ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\siaeteot/model/admin/usuario/lista_usuario.php">Usuários</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h4>Adicionar usuário do sistema</h4>
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
                                                    <option>Selecione</option>
                                                    <option value="8" >Secretaria</option>
                                                    <option value="0" >Administrador</option>
                                                    <option value="7">Docente</option>		
                                                    <option value="5">Supervisão</option>		
                                                    <option value="6">Coordenação</option>		
                                                    <!--<option value="5">Orientação Educacional</option>	-->	
                                                    <option value="3">RH</option>		
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
                                                <input class="form-control" type="text" name="dt_cadastro" id="dt_cadastro" placeholder="<?php echo date('d/m/Y'); ?>" readonly />
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

    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>
