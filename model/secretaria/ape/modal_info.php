<?php
include "../../../base/conexao.php";

$matricula_alu = $_GET['matricula_alu'];
$id_turma = $_GET['id_turma'];

$sql  = "call select_disciplinas_alu_ape($matricula_alu, $id_turma)";
//echo $sql;
$query = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
$row = mysqli_fetch_array($query);
mysqli_next_result($conexao);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <strong>Nome</strong>
                <p class="form-control-plaintext"><?php echo $row['nome_alu'].$row['sobrenome_alu'] ?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <strong>Turma</strong>
                <p class="form-control-plaintext"><?php echo $row['numero']?></p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <strong>Ano letivo</strong>
                <p class="form-control-plaintext"><?php echo $row['ano_letivo']?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h5>Retido nas seguintes disciplinas:</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="table-list" class="table-responsive">
                <table id="tabela_turma" class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                            $query_disc = mysqli_query($conexao, $sql);
                            while($row_disc = mysqli_fetch_array($query_disc)){
                                echo "<tr scope='row'>";
                                echo "<td>".$row_disc['id_disc']."</td>";
                                echo "<td>".$row_disc['nome_disc']."</td>";
                            }
                        ?>
                    </tbody>
                </table>
             </div>
        </div>
    </div>
</div>