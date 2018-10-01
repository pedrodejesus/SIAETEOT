$(document).ready(function(){
	$('#tel_fixo').inputmask("(99)9999-9999");
    $('#cel_resp').inputmask("(99)99999-9999");
    $('#tel_resp').inputmask("(99)9999-9999");
    $('#tel_ue').inputmask("(99)9999-9999");
	$('#celoufixo').inputmask("(99)9999[9]-9999");
	$('#data').inputmask("99/99/9999");
    
	$('#cpf').inputmask("999.999.999-99");
	$('#cpf_alu').inputmask("999.999.999-99");
	$('#cpf_func').inputmask("999.999.999-99");
	$('#cpf_resp').inputmask("999.999.999-99");
    
	$('#cep').inputmask("99999-999");
	$('#pcnj').inputmask("9999999-99.9999.9.99.9999");
	$('#placacarro').inputmask("aaa-9999");
	$('#numero_cartao').inputmask("9999 9999 9999 9999");
	$('#cnpj').inputmask("99.999.999/9999-99");
    
    $('#nota1').inputmask("9[9].9");
    $('#recu1').inputmask("9[9].9");
});



//Máscara de MOEDA com MaskMoney
$(document).ready(function(){
     $("#moeda_mm").maskMoney({
         prefix: "R$ ",
         decimal: ",",
         thousands: "."
     });
});


//Máscara de MOEDA com InputMask
 $(document).ready(function(){
    $("#moeda_im").inputmask( 'currency',{
		"autoUnmask": true,
		radixPoint:",",
		groupSeparator: ".",
		allowMinus: false,
		prefix: 'R$ ',
		digits: 2,
		digitsOptional: false,
		rightAlign: true,
		unmaskAsNumber: true
	});
});
