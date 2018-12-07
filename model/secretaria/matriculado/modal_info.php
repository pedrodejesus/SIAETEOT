<?php
    $matricula_alu = $_GET['matricula_alu'];
?>
<form target="_blank" method="post" action="rel/declaracao.php">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="tipo">Tipo de declaração</label>
                    <select id="tipo" name="tipo" class="form-control">
                        <option value="1">Declaração comum</option>
                        <option value="2">Declaração PREVI-RIO</option>
                        <option value="3">Declaração com horário parcial</option>
                        <option value="4">Declaração cota UERJ</option>
                    </select>
                </div>
                <input type="hidden" name="matricula_alu" value="<?php echo $matricula_alu ?>">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Cancelar</button>
         <button type="submit" class="btn btn-primary" >Ir &nbsp;<i class="fa fa-arrow-right"></i></button>
    </div>
</form>
