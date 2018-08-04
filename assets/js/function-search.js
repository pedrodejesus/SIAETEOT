function SearchAlu(){
	var ajax = AjaxF();	
	
	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4){
			document.getElementById('table-list').innerHTML = ajax.responseText;
		}
	}
	
	// Variável com os dados que serão enviados ao PHP
	if(document.getElementById('search_alu').value!=''){
		var dados = "nome_alu="+document.getElementById('search_alu').value;
	
		ajax.open("GET", "filtro_alu.php?"+dados, false);
		ajax.setRequestHeader("Content-Type", "text/html");
		ajax.send();
	}

}