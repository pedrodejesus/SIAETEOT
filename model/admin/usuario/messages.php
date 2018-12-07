<?php 
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	
	switch($msg){
		case 1:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Usuário cadastrado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
        case 2:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Erro ao cadastrar usuário!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
		case 3:
			echo '<div class="alert alert-info alert-dismissible fade show" role="alert">Usuário editado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
        case 4:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Erro ao editar usuário!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
		case 5:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Usuário excluído com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
        case 6:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Erro ao excluir usuário!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
		case 7:
			echo '<div class="message"><div class="alert alert-danger"><a href=" " class="close" data-dismiss="alert">&times</a>Usuário sem permissão de acesso para o conteúdo!<br>Por favor, acesse com a permissão necessária.</div></div>';
			break;
        case 8:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Usuário bloqueado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
        case 9:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Usuário ativado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
	}
	$msg = 0;
}
?>
