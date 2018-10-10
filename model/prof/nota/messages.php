<?php 
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	
	switch($msg){
		case 1:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Notas lançadas com sucesso!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
        case 2:
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Erro no lançamento das notas!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
			break;
	$msg = 0;
        }
}
?>
