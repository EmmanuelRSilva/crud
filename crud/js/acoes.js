//lista usuario quando carrega a pagina
listarUsuarios();


// AO SUBMETER O FORM CHAMA O SERVIÇO DE CADASTRO DO API
$("#form-cadastro").submit( function(){   
  servico($("#servico").val(),"#form-cadastro"); 
  return false;
}); 

// CHAMA SERVIÇO DE EXCLUSÃO DO API
function excluir(id){
  $("#id").val(id);
  var r = confirm("Deseja mesmo excluir este usuario?");
  if (r == true) {
    servico("excluir","#form-cadastro");
  }     
}

// CHAMA SERVIDO DE EDITAR DO API
function editar(id,nome,email){
  $("#id").val(id);
  $("#nome").val(nome);
  $("#email").val(email);
  $("#servico").val('alteracao');

  // ACAO DE MOVIMENTO DAS TELAS
  janelaCadastro(true,'edit');
}


// FUNCÃO PARA MOVIMENTAR AS TELAS DE LISTA E CADASTO
function janelaCadastro(bool,met){

	if(bool){
		$("#cadastro").css("left","5%");
		$("#user").css("left","-200%");		
	}else{
		$("#cadastro").css("left","200%");
		$("#user").css("left","5%");
		resetForm();
		$("#list-result").html(""); 
	}

	// MODIFICANDO O TIPO DE SERVIÇO SOLICITADO
	if(met == 'cad'){
		$("#servico").val('cadastro');
		$("#list-result").html(""); 
	}
}	

// SERVIÇO FANCYBOX
$('.fancybox').fancybox();

//



