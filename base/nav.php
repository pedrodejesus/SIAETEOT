<nav class="navbar page-header">
    <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto" id="resp-side"><i class="fa fa-bars"></i></a>
    <a class="navbar-brand" href="\projeto/index.php"><img class="img-fluid" width="20%" height="20%" src="\projeto/assets/img/logo.jpg" />&nbsp; E.T.E. Oscar Tenório</a>
    <a href="#" class="btn btn-link sidebar-toggle d-md-down-none"><i class="fa fa-bars"></i></a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-md-down-none">
            <a href="#"><i class="fa fa-bell"></i><span class="badge badge-pill badge-danger">5</span></a>
        </li>
        <li class="nav-item d-md-down-none">
            <a href="#"><i class="fa fa-envelope"></i><span class="badge badge-pill badge-danger">5</span></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="\projeto/assets/img/avatar-1.png" class="avatar avatar-sm" alt="logo">
                <span class="small ml-1 d-md-down-none"><?php echo $_SESSION['UsuarioNome'] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">Account</div>
                    <a href="#" class="dropdown-item"><i class="fa fa-user"></i> Perfil</a>
                    <a href="#" class="dropdown-item"><i class="fa fa-envelope"></i> Mensagens</a>
                <div class="dropdown-header">Settings</div>
                    <a href="#" class="dropdown-item"><i class="fa fa-bell"></i> Notificações</a>
                    <a href="#" class="dropdown-item"><i class="fa fa-wrench"></i> Configurações</a>
                    <a href="\projeto/base/logout.php" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
            </div>
        </li>
    </ul>
</nav>
