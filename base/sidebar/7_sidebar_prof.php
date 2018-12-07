<div class="sidebar">
                    <nav class="sidebar-nav">
                        <ul class="nav">
                            <li class="nav-title">Ações</li>
                            <li class="nav-item">
                                <a href="\siaeteot/index.php" class="nav-link <?php if($page=='dashboard'){echo'active';} ?>"><i class="far fa-home"></i> Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link <?php if($page=='diario'){echo'active';} ?>"><i class="far fa-book-open"></i> Diário eletrônico</a>
                            </li>
                            <li class="nav-item">
                                <a href="\siaeteot/model/prof/nota/lanca_nota.php" class="nav-link <?php if($page=='nota'){echo'active';} ?>"><i class="far fa-list-ol"></i> Lançamento de notas</a>
                            </li>
                            <li class="nav-item">
                                <a href="\siaeteot/model/prof/calendario_avaliativo/calendario_avaliativo.php" class="nav-link <?php if($page=='calendario_avaliativo'){echo'active';} ?>"><i class="far fa-calendar-alt"></i> Calendário avaliativo</a>
                            </li>
                            <li class="nav-item nav-dropdown">
                                <a href="" class="nav-link nav-dropdown-toggle">
                                    <i class="far fa-exclamation-circle"></i> Ocorrências <i class="fa fa-caret-left"></i>
                                </a>
                                <ul class="nav-dropdown-items">
                                    <li class="nav-item ml-3">
                                        <a href="#" class="nav-link <?php if($page=='ocorr_alu'){echo'active';} ?>"><i class="far fa-exclamation-circle"></i> Ocorrências de alunos</a>
                                    </li>
                                    <li class="nav-item ml-3">
                                        <a href="#" class="nav-link <?php if($page=='ocorr_turma'){echo'active';} ?>"><i class="far fa-exclamation-circle"></i> Ocorrências de turmas</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>