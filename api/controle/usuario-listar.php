<?php
include_once 'classes/Usuario.php';

Class Listar extends Usuario{

	function __construct(){
		$this->logar();
	}


	function listar(){

		$sql_listar = 'SELECT ID,NOME,EMAIL FROM USUARIO';
		try{
			$query_listar= $this->getConecta()->prepare($sql_listar);
			$query_listar->execute();
			$resultado_query = $query_listar->fetchALL(PDO::FETCH_ASSOC);
			$count = $query_listar->rowCount(PDO::FETCH_ASSOC);
			if($count != 0){
				$dados['USUARIOS'] = $resultado_query;
				return($dados);
			}else{
				$dados['USUARIOS']['result']	= "Nao houve resultado para esta consulta!";
				return($dados);
			}
		} catch (PDOexception $error_listar){
			$dados['ERROR']['erro']	= "Erro ao Listar: ".$error_listar->getMessage()."";
			$this->retornoDeLog($dados);
			return($dados);
		}	

	}

	function buscar($id){

		$this->setId($id);
		$sql_listar = 'SELECT ID,NOME,EMAIL FROM USUARIO WHERE ID='.$this->getId().'';
		try{
			$query_listar= $this->getConecta()->prepare($sql_listar);
			$query_listar->bindValue('ID',$this->getId(),PDO::PARAM_INT);
			$query_listar->execute();
			$resultado_query = $query_listar->fetchALL(PDO::FETCH_ASSOC);			
			$count = $query_listar->rowCount(PDO::FETCH_ASSOC);
			if($count != 0){
				$dados['USUARIOS'] = $resultado_query;
				return($dados);
			}else{
				$dados['USUARIOS']['result']	= "Nao houve resultado para esta consulta!";
				return($dados);
			}
		} catch (PDOexception $error_listar){
			$dados['ERROR']['erro']	= "Erro ao Listar: ".$error_listar->getMessage()."";
			$this->retornoDeLog($dados);
			return($dados);
		}	

	}

}




?>