<div class="modal fade" id="modal-event" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div id="modal-content" class="modal-content">
                          
                
            
        </div>
    </div>
</div>
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="controller/insere_evento.php" method="post">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dt_evento" class="form-control-label">Data do evento</label>
                                        <input class="form-control" type="date" name="dt_evento" id="dt_evento" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tipo">Tipo</label>
                                        <select id="tipo" name="tipo" class="form-control">
                                            <option value="1">Trabalho</option>
                                            <option value="2">Teste</option>
                                            <option value="3">Prova</option>
                                            <option value="4">Seminário</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cor" class="form-control-label">Cor</label>
                                        <input class="form-control" value="#ff0000" type="color" name="cor" id="cor" required />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_disc">Disciplina</label>
                                        <select id="id_disc" name="id_disc" class="form-control">
                                            <option value="">Selecione</option>
                                            <?php
                                                $sql_disc = "select * from disciplina order by nome_disc";
                                                $query_disc = mysqli_query($conexao, $sql_disc);
                                                while($array_disc = mysqli_fetch_array($query_disc)){
                                                    echo "<option value='".$array_disc['id_disc']."'>".$array_disc['nome_disc']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_turma">Turma</label>
                                        <select id="id_turma" name="id_turma" class="form-control">
                                            <option value="">Selecione</option>
                                            <?php
                                                $sql_turma = "select * from turma order by ano_letivo desc";
                                                $query_turma = mysqli_query($conexao, $sql_turma);
                                                while($array_turma = mysqli_fetch_array($query_turma)){
                                                    echo "<option value='".$array_turma['id_turma']."'>".$array_turma['numero']." / ".$array_turma['ano_letivo']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descricao">Descrição</label>
                                        <textarea style="height:200px !important;" id="descricao" name="descricao" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-4">
                        <div class="btn-group" role="group">
                            <button id="add-event" type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp; Salvar</button>
                            <button data-dismiss="modal" type="button" class="btn btn-light"><i class="fa fa-undo"></i>&nbsp; Cancelar</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>