$(document).ready(function() {
	
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});

	$("#enviar").click(function() {
		enviar();		
	});

});


function enviar() {

	var nome 		= $("#nome").val();
	var email 		= $("#email2").val();
	var telefone 	= $("#fone").val();
	var assunto 	= $("#assunto").val();
	var mensagem 	= $("#mensagem").val();

	if (nome == "" || email == "" || assunto == "" || mensagem == "") {

		if (nome == "" || nome == undefined) {
			nomeFunc();		
		}
		if (email == "" || email == undefined) {
			emailFunc();
		}
		if (assunto == "" || assunto == undefined) {
			assuntoFunc();
		}if (mensagem == "" || email == undefined) {
			mensagemFunc();
		}

	const toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		toast({
			type: 'error',
			title: "Os campos em destacados em vermelho são de preenchimento obrigatório."
		});	

	}else{
		emailReq(nome, email, assunto, mensagem, telefone);
		var msg = nome+', sua mensagem foi enviada com sucesso!';
		alert(msg);
	}

}


function emailReq(nome, email, assunto, mensagem, telefone) {	

	$.ajax({
		url: 'php/service.php',
		type: 'POST',
		dataType: 'json',
		data: {tipo: 'enviar', nome: nome, email: email, assunto: assunto, mensagem: mensagem, telefone: telefone},
	})
	.done(function(res) {

		const toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		toast({
			type: 'success',
			title: res
		});

	})
	.fail(function(res) {
		console.log("error");
	});	

}


function nomeFunc() {
	$("#nome").addClass('alert-danger');
}
function emailFunc() {
	$("#email2").addClass('alert-danger');
}
function assuntoFunc() {
	$("#assunto").addClass('alert-danger');;
}
function mensagemFunc() {
	$("#mensagem").addClass('alert-danger');;
}

