<?php
if (!isset($_SESSION)) session_start(); // A sessão precisa ser iniciada em cada página diferente

if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != 0)) { // Verifica se não há a variável da sessão que identifica o usuário
	session_destroy(); // Destrói a sessão por segurança
	header("Location: ../../../../login.php?msg=4"); exit; // Redireciona o visitante de volta pro login
}
$page = 'user';
include "../../../../base/head.php";
?>
</head>

<body class="sidebar-fixed header-fixed">
    <?php include "../modal.php"; ?>
    <div class="page-wrapper">
        <?php include "../../../../base/nav.php" ?>
        <div class="main-container">            
            <?php
                include "../../../../base/sidebar/0_sidebar_admin.php";
                include "../../../../base/conexao.php";
        
                $id_usu = $_GET['id_usu'];
                $sql = mysqli_query($conexao, "select * from usuario where id_usu = '".$id_usu."';");
                $row = mysqli_fetch_array($sql);
            ?>
            <div class="content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-light">
                            <li class="breadcrumb-item"><a href="\siaeteot/index.php"><i class="far fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="\siaeteot/model/admin/usuario/lista_usuario.php">Usuários</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4><?php echo $row["id_usu"]." - ".$row["nome_usu"]; ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label for="id_usu" class="form-control-label"><strong>ID</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["id_usu"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="nome_usu" class="form-control-label"><strong>Nome do Usuário</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["nome_usu"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="usuario" class="form-control-label"><strong>Usuário</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["usuario"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="senha" class="form-control-label"><strong>Senha</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["senha"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_pai" class="form-control-label"><strong>E-mail</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["email"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nome_mae" class="form-control-label"><strong>Nível</strong></label>
                                                <p class="form-control-plaintext"><?php 
                                                    switch($row["nivel"]){
                                                        case 8:
                                                            echo "Secretaria";
                                                            break;
                                                        case 0:
                                                            echo "Administrador";
                                                            break;
                                                        case 7:
                                                            echo "Docente";
                                                            break;
                                                        case 5:
                                                            echo "Supervisão";
                                                            break;
                                                        case 6:
                                                            echo "Coordenação";
                                                            break;
                                                        case 3:
                                                            echo "RH";
                                                            break;
                                                    }                                                    
                                                ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="sexo_usu"><strong>Ativo</strong></label>
                                                <p class="form-control-plaintext"><?php if ("1" == $row["ativo"]){echo"Sim";}else if ("0" == $row["ativo"]){echo"Não";} ?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tipo_usu"><strong>Data de cadastro</strong></label>
                                                <p class="form-control-plaintext"><?php echo $row["dt_cadastro"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="btn-group" role="group">
                                                <a class='btn btn-warning' href='editar_usu.php?id_usu=<?php echo $id_usu ?>'><i class='fa fa-edit'></i>&nbsp; Editar</a>   
                                                
                                                <a class='btn btn-danger' onclick='deletaUsu(<?php echo $id_usu ?>)' data-toggle='modal' href='#delete-modal'><i class='fa fa-trash'></i>&nbsp; Excluir</a>
                                                
                                                <a class='btn btn-light' href='../lista_usuario.php'><i class='fa fa-undo'></i>&nbsp; Voltar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    <script src="\projeto/assets/js/jquery-3.3.1.min.js"></script>
    <script src="\projeto/assets/js/bootstrap.min.js"></script>
    <script src="\projeto/assets/js/function-delete.js"></script>
    <script src="\projeto/assets/js/carbon.js"></script>
</body>

</html>