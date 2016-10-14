<?php
include_once 'classes/Usuario.php';

Class Exluir extends Usuario{

	function __construct($dados){
		$this->logar();
		$this->setId($dados['id']);		
	}


	function excluir(){
	
		$sql_alterar = 'DELETE FROM USUARIO WHERE ID='.$this->getId().';';
		try{
			$query_alterar= $this->getConecta()->prepare($sql_alterar);
			$query_alterar->bindValue('ID',$this->getId(),PDO::PARAM_INT);				
			$query_alterar->execute();
			$dados['USUARIOS']['result'] = "Exlcuido com sucesso!";						
			return($dados);
		} catch (PDOexception $error_inserir){
			$dados['ERROR']['erro']	= "Erro ao Excluir".$error_inserir->getMessage()."";
			$this->retornoDeLog($dados);	
			return($dados);
		}
		
	}

	

}




?>