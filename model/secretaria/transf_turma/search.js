var req;
function searchAlu(valor) { // Função para buscar aluno
 
    if(window.XMLHttpRequest) { // Verificando Browser
       req = new XMLHttpRequest();
    }else if(window.ActiveXObject) {
       req = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    var url = "busca.php?valor=" + valor; // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    req.open("Get", url, true); // Chamada do método open para processar a requisição
    
    req.onreadystatechange = function() { // Quando o objeto recebe o retorno, chamamos a seguinte função;
        
        if(req.readyState == 1) { // Exibe a mensagem "Buscando..." enquanto carrega
            document.getElementById('tbody_alu').innerHTML = 'Buscando...';
        }else if(req.readyState == 4 && req.status == 200) { // Verifica se o Ajax realizou todas as operações corretamente
        
            var resposta = req.responseText; // Resposta retornada pelo busca.php        
            if(resposta){
                document.getElementById('tbody_alu').innerHTML = resposta; // Abaixo colocamos a(s) resposta(s) na div resultado
            } else{
                document.getElementById('nf_alu').innerHTML = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Aluno não encontrado! <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            } /*A FAZER: IMPLEMENTAR AVISO DE REGISTRO NÃO ENCONTRADO*/
        } 
    }
    req.send(null);
}