function deletaAlu(idDado){
    var href = "/siaeteot/model/secretaria/aluno/controller/exclui_alu.php?matricula_alu=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaDisc(idDado){
    var href = "/siaeteot/model/secretaria/disciplina/controller/exclui_disc.php?id_disc=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaSetor(idDado){
    var href = "/siaeteot/model/rh/setor/controller/exclui_setor.php?id_setor=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaFunc(idDado){
    var href = "/siaeteot/model/rh/funcionario/controller/exclui_func.php?id_func=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaResp(idDado){
    var href = "/siaeteot/model/secretaria/responsavel/controller/exclui_resp.php?id_resp=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaUe(idDado){
    var href = "/siaeteot/model/secretaria/ue/controller/exclui_ue.php?id_ue=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaCargo(idDado){
    var href = "/siaeteot/model/rh/cargo/controller/exclui_cargo.php?id_cargo=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaFuncao(idDado){
    var href = "/siaeteot/model/rh/funcao/controller/exclui_funcao.php?id_funcao=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaUsu(idDado){
    var href = "/siaeteot/model/usuario/controller/exclui_usu.php?id_usu=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaSala(idDado){
    var href = "/siaeteot/model/sala/controller/exclui_sala.php?id_sala=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaTurma(idDado){
    var href = "/siaeteot/model/secretaria/turma/controller/exclui_turma.php?id_turma=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
function deletaTransfUe(idDado){
    var href = "/siaeteot/model/secretaria/transf_ue/controller/exclui_transf_ue.php?id_trans=" + idDado; //Seta o caminho para quando clicar em "Sim"
    $('#confirmDelete').prop("href", href); //Adiciona atributo de deleção ao link
}
