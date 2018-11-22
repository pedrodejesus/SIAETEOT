<div class="sidebar">
                    <nav class="sidebar-nav">
                        <ul class="nav">
                            <li class="nav-title">Ações</li>
                            <li class="nav-item">
                                <a href="\siaeteot/index.php" class="nav-link <?php if($page=='dashboard'){echo'active';} ?>"><i class="far fa-home"></i> Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="\siaeteot/model/rh/funcionario/lista_funcionario.php" class="nav-link <?php if($page=='func'){echo'active';}?>"><i class="far fa-chalkboard-teacher"></i> Funcionários</a>
                            </li>
                            <li class="nav-item nav-dropdown">
                                <a href="" class="nav-link nav-dropdown-toggle">
                                    <i class="far fa-clipboard-list"></i> Relatórios <i class="fa fa-caret-left"></i>
                                </a>
                                <ul class="nav-dropdown-items">
                                    <li class="nav-item ml-3">
                                        <a href="#" class="nav-link <?php if($page=='aluno'){echo'active';} ?>"><i class="far fa-clipboard-list"></i> Relatório 1</a>
                                    </li>
                                    <li class="nav-item ml-3">
                                        <a href="#" class="nav-link <?php if($page=='matricula'){echo'active';} ?>"><i class="far fa-clipboard-list"></i> Relatório 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="\siaeteot/model/rh/setor/lista_setor.php" class="nav-link <?php if($page=='setor'){echo'active';}?>"><i class="far fa-building"></i> Setores</a>
                            </li>
                            <li class="nav-item">
                                <a href="\siaeteot/model/rh/cargo/lista_cargo.php" class="nav-link <?php if($page=='cargo'){echo'active';}?>"><i class="far fa-male"></i> Cargos</a>
                            </li>
                            <li class="nav-item">
                                <a href="\siaeteot/model/rh/funcao/lista_funcao.php" class="nav-link <?php if($page=='funcao'){echo'active';}?>"><i class="far fa-male"></i> Funções</a>
                            </li>
                   
                        </ul>
                    </nav>
                </div>