<?php
include_once 'classes/Usuario.php';

Class Alteracao extends Usuario{

	function __construct($dados){
		$this->logar();
		$this->setId($dados['id']);
		$this->setNome($dados['nome']);
		$this->setEmail($dados['email']);
		$this->setSenha($dados['password']);
		$this->setConfSenha($dados['conf-password']);
	}


	function alterar(){

		// VERIFICA SE EMAIL JA EXISTE COM OUTRA ID	
		if(is_bool($this->procurarEmailExistente())){

			$sql_alterar = 'UPDATE USUARIO SET NOME="'.$this->getNome().'", EMAIL="'.$this->getEmail().'", PASSWORD="'.$this->getSenha().'" WHERE ID='.$this->getId().';';

			try{
				$query_alterar= $this->getConecta()->prepare($sql_alterar);
				$query_alterar->bindValue('ID',$this->getId(),PDO::PARAM_INT);
				$query_alterar->bindValue('NOME',$this->getNome(),PDO::PARAM_STR);
				$query_alterar->bindValue('EMAIL',$this->getEmail(),PDO::PARAM_STR);
				$query_alterar->bindValue('PASSWORD',$this->getSenha(),PDO::PARAM_STR);	
				$query_alterar->execute();				
				$dados['USUARIOS']['result'] = "Usuário Alterado com sucesso!";	
				return($dados);
			} catch (PDOexception $error_inserir){
				$dados['ERROR']['erro'] = "Erro ao Alterar".$error_inserir->getMessage()."";
				$this->retornoDeLog($dados);	
				return($dados);
			}

		}else{

			return($this->procurarEmailExistente());
		}	

	}

	function procurarEmailExistente(){

		$sql_listar = 'SELECT NOME,EMAIL FROM USUARIO WHERE EMAIL="'.$this->getEmail().'" AND ID != '.$this->getId().';';

		try{
			$query_listar= $this->getConecta()->prepare($sql_listar);
			$query_listar->bindValue('ID',$this->getId(),PDO::PARAM_INT);
			$query_listar->bindValue('EMAIL',$this->getEmail(),PDO::PARAM_STR);
			$query_listar->execute();			
			//$resultado_query = $query_listar->fetchALL(PDO::FETCH_ASSOC);
			$count = $query_listar->rowCount(PDO::FETCH_ASSOC);
			
			if($count == 0){
				return(true);
			}else{
				$dados['USUARIOS']['result'] = "Já existe usuario com este e-mail!";
				return($dados);
			}
			
		} catch (PDOexception $error_listar){
			$dados['ERROR']['erro'] = "Erro ao Consultar: ".$error_listar->getMessage()."";
			$this->retornoDeLog($dados);
			return($dados);
		}
	}

	


}




?>