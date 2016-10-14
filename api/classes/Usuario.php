<?php
include 'db_conecta.php';

Class Usuario extends DB{

	private $id;
	private $email;
	private $nome;
	private $senha;

	function setId($id){

		$id = strip_tags(trim($id));
		// VERIFICA SE É UM NUMERO
		if(is_numeric($id)){
			$this->id = $id;
		}else{
			$this->getERROR('id');
		}
		
	}

	function getId(){
		return $this->id;
	}

	function setNome($nome){
		$nome = strip_tags(trim($nome));
		if($nome != ""){			
			$this->nome = $nome;
		}else{
			$this->getERROR('NOME');
		}
	}

	function getNome(){
		return $this->nome;
	}

	function setEmail($email){
		$email = strip_tags(trim($email));
		if($email != ""){
			// VALIDA E-MAIL
			if ($this->validaEmail($email)) {
				$this->email = $email;
			}else{
				$this->getERROR($email);
			}
		}else{
			$this->getERROR('E-MAIL');
		}
	}

	function getEmail(){
		return $this->email;
	}

	function setSenha($senha){
		$senha = strip_tags(trim($senha));
		if($senha != ""){
			$senha = md5($senha);
			$this->senha = $senha;
		}else{
			$this->getERROR('SENHA');
		}
	}

	function getSenha(){
		return $this->senha;
	}


	function setConfSenha($senha){
		$senha = strip_tags(trim($senha));
		$senha = md5($senha);
		if($senha != $this->getSenha()){			
			$this->getERROR('CONFIRMAÇÃO SENHA');
		}
	}


	function getERROR($str){
		$dados['ERROR']['erro']	= "Ops! As informações de <strong>".$str."</strong> não parecem ser validas! Tente novamente";
		$this->retornoDeLog($dados);
		die(json_encode($dados));
	}

	function validaEmail($email) {

		$conta = "^[a-zA-Z0-9\._-]+@";
		$domino = "[a-zA-Z0-9\._-]+.";
		$extensao = "([a-zA-Z]{2,4})$";
		$pattern = $conta.$domino.$extensao;
		if (ereg($pattern, $email)){
			return true;
		}else{
			return false;
		}		

	}
}
?>