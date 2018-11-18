<?php 
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	
	switch($msg){
		case 1:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Aluno transferido com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
        case 2:
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Erro ao transferir aluno!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
		case 3:
			echo '<div class="alert alert-info alert-dismissible fade show" role="alert">Matrícula editada com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
        case 4:
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Erro na edição da matrícula do aluno!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
		case 5:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Registro de transferência excluído com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
        case 6:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Erro na exclusão do registro de transferência!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
		case 7:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Usuário sem permissão de acesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
        case 8:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Número de matrícula já existente!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
        case 9:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Número de CPF já existente!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
	}
	$msg = 0;
}
?>
