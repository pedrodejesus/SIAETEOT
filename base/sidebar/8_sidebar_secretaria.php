<div class="sidebar">
                    <nav class="sidebar-nav">
                        <ul class="nav">
                            <li class="nav-title">Ações</li>
                            <li class="nav-item">
                                <a href="\projeto/index.php" class="nav-link <?php if($page=='dashboard'){echo'active';} ?>"><i class="far fa-home"></i> Dashboard</a>
                            </li>
                            <li class="nav-item nav-dropdown">
                                <a href="" class="nav-link nav-dropdown-toggle">
                                    <i class="far fa-user-graduate"></i> Alunos <i class="fa fa-caret-left"></i>
                                </a>
                                <ul class="nav-dropdown-items">
                                    <li class="nav-item ml-3">
                                        <a href="\projeto/model/secretaria/aluno/lista_aluno.php" class="nav-link <?php if($page=='aluno'){echo'active';} ?>"><i class="far fa-user-graduate"></i> Dados Pessoais</a>
                                    </li>
                                    <li class="nav-item ml-3">
                                        <a href="\projeto/model/secretaria/matriculado/lista_matriculado.php" class="nav-link <?php if($page=='matricula'){echo'active';} ?>"><i class="far fa-user-graduate"></i> Matrículas</a>
                                    </li>
                                    <li class="nav-item ml-3">
                                        <a href="\projeto/model/secretaria/remanejamento/remaneja_alu.php" class="nav-link <?php if($page=='remanejamento'){echo'active';} ?>"><i class="far fa-sync-alt"></i> Remanejamento</a>
                                    </li>
                                    <li class="nav-item ml-3">
                                        <a href="\projeto/model/secretaria/ape/lista_ape.php" class="nav-link <?php if($page=='ape'){echo'active';} ?>"><i class="far fa-clipboard-list"></i> APE</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="\projeto/model/secretaria/responsavel/lista_responsavel.php" class="nav-link <?php if($page=='resp'){echo'active';} ?>"><i class="far fa-user-friends"></i> Responsáveis</a>
                            </li>
                            <li class="nav-item">
                                <a href="\projeto/model/secretaria/turma/lista_turma.php" class="nav-link <?php if($page=='turma'){echo'active';} ?>"><i class="far fa-users-class"></i> Turmas</a>
                            </li>
                            <li class="nav-item">
                                <a href="\projeto/model/secretaria/nota/lanca_nota.php" class="nav-link <?php if($page=='nota'){echo'active';} ?>"><i class="far fa-list-ol"></i> Lançamento de notas</a>
                            </li>
                            <li class="nav-item nav-dropdown">
                                <a href="" class="nav-link nav-dropdown-toggle">
                                    <i class="far fa-clipboard-list"></i> Relatórios <i class="fa fa-caret-left"></i>
                                </a>
                                <ul class="nav-dropdown-items">
                                    <li class="nav-item ml-3">
                                        <a href="\projeto/model/secretaria/rel/alunos_turma/alunos_turma.php" class="nav-link <?php if($page=='rel_alunos_turma'){echo'active';} ?>"><i class="far fa-clipboard-list"></i> Alunos por turma</a>
                                    </li>
                                    <li class="nav-item ml-3">
                                        <a href="\projeto/model/secretaria/rel/boletim_geral/boletim_geral.php" class="nav-link <?php if($page=='rel_alunos_turma'){echo'active';} ?>"><i class="far fa-clipboard-list"></i> Boletim geral</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-dropdown">
                                <a href="" class="nav-link nav-dropdown-toggle">
                                    <i class="far fa-exchange-alt"></i> Transferências <i class="fa fa-caret-left"></i>
                                </a>
                                <ul class="nav-dropdown-items">
                                    <li class="nav-item ml-3">
                                        <a href="#" class="nav-link <?php if($page=='transf_tur'){echo'active';} ?>"><i class="far fa-exchange-alt"></i> Transferência de turma</a>
                                    </li>
                                    <li class="nav-item ml-3">
                                        <a href="\projeto/model/secretaria/transf_ue/lista_transf_ue.php" class="nav-link <?php if($page=='transf_ue'){echo'active';} ?>"><i class="far fa-exchange-alt"></i> Transferência de U.E.</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="\projeto/model/secretaria/disciplina/lista_disciplina.php" class="nav-link <?php if($page=='disciplina'){echo'active';} ?>"><i class="far fa-books"></i> Disciplinas</a>
                            </li>                            
                            <li class="nav-item">
                                <a href="\projeto/model/secretaria/ue/lista_ue.php" class="nav-link <?php if($page=='ue'){echo'active';} ?>"><i class="far fa-school"></i> Unidades Escolares</a>
                            </li>
                            <li class="nav-item">
                                <a href="\projeto/model/secretaria/sala/lista_sala.php" class="nav-link"><i class="far fa-door-closed"></i> Salas</a>
                            </li>                            
                        </ul>
                    </nav>
                </div>