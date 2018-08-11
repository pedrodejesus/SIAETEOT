function deletaAlu(idDado){
    var href = "/projeto/model/aluno/controller/exclui_alu.php?matricula_alu=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaDisc(idDado){
    var href = "/projeto/model/disciplina/controller/exclui_disc.php?id_disc=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaSetor(idDado){
    var href = "/projeto/model/setor/controller/exclui_setor.php?id_setor=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaFunc(idDado){
    var href = "/projeto/model/funcionario/controller/exclui_func.php?id_func=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaResp(idDado){
    var href = "/projeto/model/responsavel/controller/exclui_resp.php?id_resp=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaUe(idDado){
    var href = "/projeto/model/ue/controller/exclui_ue.php?id_ue=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaCargo(idDado){
    var href = "/projeto/model/cargo/controller/exclui_cargo.php?id_cargo=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaFuncao(idDado){
    var href = "/projeto/model/funcao/controller/exclui_funcao.php?id_funcao=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaUsu(idDado){
    var href = "/projeto/model/usuario/controller/exclui_usu.php?id_usu=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaSala(idDado){
    var href = "/projeto/model/sala/controller/exclui_sala.php?id_sala=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaTurma(idDado){
    var href = "/projeto/model/turma/controller/exclui_turma.php?id_turma=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
