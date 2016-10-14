<?php

include_once 'classes/Usuario.php';


Class Casdasto extends Usuario{

	function __construct($dados){
		$this->logar();
		$this->setNome($dados['nome']);
		$this->setEmail($dados['email']);
		$this->setSenha($dados['password']);
		$this->setConfSenha($dados['conf-password']);
	}


	function inserir(){

		// VERIFICA SE EMAIL JA EXISTE ANTES DE CADASTRAR		
		if(is_bool($this->procurarEmailExistente())){

			$sql_inserir = 'INSERT INTO USUARIO (NOME,EMAIL,PASSWORD)VALUES("'.$this->getNome().'","'.$this->getEmail().'","'.$this->getSenha().'")';
			try{
				$query_inserir= $this->getConecta()->prepare($sql_inserir);
				$query_inserir->bindValue('NOME',$this->getNome(),PDO::PARAM_STR);
				$query_inserir->bindValue('EMAIL',$this->getEmail(),PDO::PARAM_STR);
				$query_inserir->bindValue('PASSWORD',$this->getSenha(),PDO::PARAM_STR);	
				$query_inserir->execute();	
				$dados['USUARIOS']['result']	= "Usuário cadastrado com sucesso!";				
				return($dados);
			} catch (PDOexception $error_inserir){
				$dados['ERROR']['erro']	= "Erro ao Cadastrar".$error_inserir->getMessage();
				$this->retornoDeLog($dados);
				return($dados);
			}

		}else{
			return($this->procurarEmailExistente());
		}	

	}

	function procurarEmailExistente(){

		$sql_listar = 'SELECT EMAIL FROM USUARIO WHERE EMAIL="'.$this->getEmail().'"';
		try{
			$query_listar= $this->getConecta()->prepare($sql_listar);
			$query_listar->bindValue('EMAIL',$this->getEmail(),PDO::PARAM_STR);
			$query_listar->execute();
			$resultado_query = $query_listar->fetchALL(PDO::FETCH_ASSOC);
			$count = $query_listar->rowCount(PDO::FETCH_ASSOC);
			if($count == 0){
				return(true);
			}else{
				$dados['ERROR']['erro']	= "Este e-mail já existe em nosso cadastro!";
				$this->retornoDeLog($dados);
				return($dados);
			}
		} catch (PDOexception $error_listar){
			$dados['ERROR']['erro']	= "Erro ao Consultar: ".$error_listar->getMessage();
			$this->retornoDeLog($dados);
			return($dados);
		}

	}

}




?>