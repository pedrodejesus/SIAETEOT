<?php 
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	
	switch($msg){
		case 1:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Aluno cadastrado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
		case 2:
			echo '<div class="alert alert-info alert-dismissible fade show" role="alert">Aluno editado com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
		case 3:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Aluno excluído com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
		case 4:
			echo '<div class="message"><div class="alert alert-danger"><a href=" " class="close" data-dismiss="alert">&times</a>Usuário sem permissão de acesso para o conteúdo!<br>Por favor, acesse com a permissão necessária.</div></div>';
			break;
	}
	$msg = 0;
}
?>
