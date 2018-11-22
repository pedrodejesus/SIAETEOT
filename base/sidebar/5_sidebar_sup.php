<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">Ações</li>
            <li class="nav-item">
                <a href="\siaeteot/index.php" class="nav-link <?php if($page=='dashboard'){echo'active';} ?>"><i class="far fa-home"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link <?php if($page=='ppa'){echo'active';} ?>"><i class="far fa-clipboard-list"></i> PPA</a>
            </li>
            <li class="nav-item nav-dropdown">
                                <a href="" class="nav-link nav-dropdown-toggle">
                                    <i class="far fa-exclamation-circle"></i> Ocorrências <i class="fa fa-caret-left"></i>
                                </a>
                                <ul class="nav-dropdown-items">
                                    <li class="nav-item ml-3">
                                        <a href="\siaeteot/model/sup/ocorr_alu/lista_ocorr_alu.php" class="nav-link <?php if($page=='ocorr_alu'){echo'active';} ?>"><i class="far fa-exclamation-circle"></i> Ocorrências de alunos</a>
                                    </li>
                                    <li class="nav-item ml-3">
                                        <a href="#" class="nav-link <?php if($page=='ocorr_turma'){echo'active';} ?>"><i class="far fa-exclamation-circle"></i> Ocorrências de turmas</a>
                                    </li>
                                </ul>
                            </li>
        </ul>
    </nav>
</div>