<?php
include 'controle/usuario-listar.php';
include 'controle/usuario-cadastro.php';
include 'controle/usuario-alteracao.php';
include 'controle/usuario-excluir.php';



if(isset($_GET['page']) && $_GET['page'] == "listar"){

	

	if(isset($_GET['model']) && $_GET['model'] == "usuario"){
		/*BUSCAR ID*/
		$usuario = new Listar();
		$return = $usuario->buscar($_GET['id']);
		$usuario->disconnect();
	}else{
		/*LISTAR*/
		$usuario = new Listar();
		$return = $usuario->listar();
		$usuario->disconnect();

	}


}else if(isset($_GET['page']) && $_GET['page'] == "alteracao"){

	/* ALTERAÇÃO */
	if(isset($_POST) && count($_POST) > 3){
		$usuario = new Alteracao($_POST);
		$return = $usuario->alterar();
		$usuario->disconnect();
	}else{
		$return['ERROR']['erro']	= "Erro ao tentar Editar";
	}

}else if(isset($_GET['page']) && $_GET['page'] == "cadastro"){

	/* CADASTRRAR */
	if(isset($_POST) && count($_POST) > 3){
		$usuario = new Casdasto($_POST);
		$return = $usuario->inserir();
		$usuario->disconnect();
	}else{
		$return['ERROR']['erro'] = "Não existem dados suficiente para o cadastro!";
	}

}else if(isset($_GET['page']) && $_GET['page'] == "excluir"){

	/* EXCLUIR */
	if(isset($_POST['id'])){
		$usuario = new Exluir($_POST);
		$return = $usuario->excluir();
		$usuario->disconnect();
	}else{
		$return['ERROR']['erro']	= "Erro ao tentar excluir!";
	}
	
}else{
	$return['ERROR']['erro'] = "Não foi possivel encontar página solicitada!";
}


echo json_encode($return);





?>