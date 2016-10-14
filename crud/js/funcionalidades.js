// DIRETORIO DA API
var url = 'http://localhost:8080/api/';
// 
var conexao = false;

// FUNÇÃO CHAMA A LISTA DE USUARIOS
function listarUsuarios(){

  var data = {};	  
  $.ajax({
    url: url+'listar',
    data: data,
    dataType: 'json',
    beforeSend : function() {
      $("#list-usuarios").html('<div class="carregando"><img src="img/spin.gif" alt="carregando"></div>');
   },
   statusCode: {
      // identifica algum erro  e mostra como alerta ou dentro da div desejada                    
      404: function() {$("#list-usuarios").html("Arquivo nao foi encontrado!");},
      500: function() {$("#list-usuarios").html("Falha de processamento!");}
   },
    success: function(data) {  
      conexao = true;
      console.debug(data);           
      $("#list-usuarios").html(""); 
      if(data.USUARIOS == undefined){
        var exibir = "<div>"+data.ERROR['erro']+"</div>";
      }else{         
        var exibir = "<ul>";
        // PERCORRENDO A LISTA DE USUARIOS
        for (var i = 0; i < data.USUARIOS.length; i++) {
          exibir += '<li>';
            exibir += '<div class="nome">'+data.USUARIOS[i].NOME.substring(0,30)+'</div>'; 
            exibir += '<div class="email">'+data.USUARIOS[i].EMAIL+'</div>'; 
            exibir += '<div class="button" onclick="excluir(\''+data.USUARIOS[i].ID+'\')"><img src="img/excluir.svg" alt="Excluir"></div>';
            exibir += '<div class="button" onclick="editar(\''+data.USUARIOS[i].ID+'\',\''+data.USUARIOS[i].NOME+'\',\''+data.USUARIOS[i].EMAIL+'\')"><img src="img/editar.svg" alt="Editar"></div>';
          exibir += "</li>";                           
        }  
        exibir += "</ul>";         
      } 
      // ADICIONA LISTA
      $('#list-usuarios').append(exibir);    
    },
    complete:function(){
      // SE A CONEXAO ESTIVER EM FALSO
      if(!conexao){
        // ESCONDE BOTAO
        $('#inscreverSe').hide();
        // ADICIONA MENSAGEM DE ERRO
        $('#list-usuarios').html("<h1>Ops! Houve um erro de conexão com o API! :( </h1>"); 
        $('#list-usuarios').append('<ul>');       
        $('#list-usuarios').append('<li><strong>1 -</strong>Verifique se diretório do <strong>"API"</strong> está correto!</li>');
        $('#list-usuarios').append('<li><strong>2 -</strong>O arquivo <strong>"crud/js/funcionalidades.js"</strong> seria um bom local pra verificar estas configurações ;)</li>');
        $('#list-usuarios').append('<li><strong>3 -</strong>O sistema foi preparado para encontrar o API em <strong> "http://localhost/api/".</strong> </li>');
        $('#list-usuarios').append('<ul>');
      }
    }

  });
}

// FUNCÇÃO ONDE DEFINE OS TIPOS DE SERVIÇOS (cadastar/editar/excuir)
function servico(tipo,formulario){
 
  $.ajax({
    url: url+tipo,
    data: $(formulario).serialize(),
    dataType: 'json',
    type : "POST",
    beforeSend : function() {
      $("#list-result").html('<div class="carregando"><img src="img/spin.gif" alt="carregando"></div>');
   },
   statusCode: {
      // identifica algum erro  e mostra como alerta ou dentro da div desejada                    
      404: function() {$("#list-result").html("Arquivo nao foi encontrado!");},
      500: function() {$("#list-result").html("Falha de processamento!");}
   },
    success: function(data) {  
        //console.debug(data);
         $("#list-result").html(""); 
         if(data.USUARIOS == undefined){
            var exibir = "<div class='erro'>"+data.ERROR['erro']+"</div>";            
         }else{
            var exibir = "<div>"+data.USUARIOS['result']+"</div>";
            //LIMPANDO O FORMULARIO
            resetForm();
         }         
         $('#list-result').append(exibir); 
    }

  });
  // ATUALIZANDO USUARIO EM 1 SEGUNDO APOS A EXECUÇÃO DE QUALQUER ALTERACAO
  window.setTimeout( listarUsuarios, 1000 );
}

// RESETANDO FORMULARIO
function resetForm(){
  $('#form-cadastro').each (function(){
    this.reset();
  });
}
