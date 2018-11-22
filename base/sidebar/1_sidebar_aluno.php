<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">Ações</li>
            <li class="nav-item">
                <a href="\siaeteot/index.php" class="nav-link <?php if($page=='dashboard'){echo'active';} ?>"><i class="far fa-home"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="\siaeteot/model/aluno/boletim/boletim_alu.php?matricula_alu=<?php echo $_SESSION['matricula_alu'] ?>" class="nav-link <?php if($page=='boletim'){echo'active';} ?>"><i class="far fa-list-ol"></i> Boletim</a>
            </li>
            <li class="nav-item nav-dropdown">
                <a href="" class="nav-link nav-dropdown-toggle">
                    <i class="far fa-calendar-alt"></i> Calendários <i class="fa fa-caret-left"></i>
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item ml-3">
                        <a href="#" class="nav-link <?php if($page=='calendario_geral'){echo'active';} ?>"><i class="far fa-calendar-alt"></i> Calendário geral</a>
                    </li>
                    <li class="nav-item ml-3">
                        <a href="\siaeteot/model/aluno/calendario/calendario_turma/calendario_turma.php" class="nav-link <?php if($page=='calendario_turma'){echo'active';} ?>"><i class="far fa-calendar-alt"></i> Calendário de turma</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a href="" class="nav-link nav-dropdown-toggle">
                    <i class="far fa-comments"></i> Comunicados <i class="fa fa-caret-left"></i>
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item ml-3">
                        <a href="#" class="nav-link <?php if($page=='aluno'){echo'active';} ?>"><i class="far fa-comments"></i> Comunicados disciplinares</a>
                    </li>
                    <li class="nav-item ml-3">
                        <a href="#" class="nav-link <?php if($page=='matricula'){echo'active';} ?>"><i class="far fa-comments"></i> Comunicados gerais</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a href="" class="nav-link nav-dropdown-toggle">
                    <i class="far fa-reply"></i> Requerimentos <i class="fa fa-caret-left"></i>
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item ml-3">
                        <a href="#" class="nav-link <?php if($page=='matricula'){echo'active';} ?>"><i class="far fa-reply"></i> Declaração</a>
                    </li>
                    <li class="nav-item ml-3">
                        <a href="#" class="nav-link <?php if($page=='matricula'){echo'active';} ?>"><i class="far fa-reply"></i> Histórico</a>
                    </li>
                    <li class="nav-item ml-3">
                        <a href="#" class="nav-link <?php if($page=='aluno'){echo'active';} ?>"><i class="far fa-reply"></i> Alteração de nota</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>