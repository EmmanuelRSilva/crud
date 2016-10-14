
<?php

class DB{

	private $conecta;
	private $conexao;
	private $conn = true;

	function logar(){

		if(!defined("HOST")){
			define('HOST','localhost');		
		}
		if(!defined("DB")){
			define('DB','job');
		}
		if(!defined("USER")){
			define('USER','root');
		}
		if(!defined("PASS")){
			define('PASS','');
		}	

		$this->conexao = 'mysql:host='.HOST.';dbname='.DB;									
		try{
			$this->conecta = new PDO($this->conexao,USER,PASS);
			$this->conecta->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);				
		} catch (PDOexception $error_conecta) {	
			
			if($this->conn){
				// TENTA CIRAR O BANCO CASO NÃO ENCONTRE
				$this->criarBanco();
			}else{
				$dados['ERROR']['erro']	= "Erro ao Conectar com <strong>Banco de Dados</strong>:".$error_conecta->getMessage()." </br> Verifique as configurações do banco em <strong>'api/classes/db_conecta.php'</strong>!";	
				$this->retornoDeLog($dados);	
				die(json_encode($dados));
			}

		} 	
	}


	function getConecta(){
		return $this->conecta;
	}

	function disconnect(){
		$this->conecta = null;
	}

	function criarBanco(){
		
		$this->conexao = 'mysql:host='.HOST.';';
		$this->conecta = new PDO($this->conexao,'root','');
		$verifica = $this->conecta->exec(
		    "CREATE DATABASE IF NOT EXISTS `job` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
			USE `job`;
			CREATE TABLE IF NOT EXISTS `usuario` (
			  `id` int(11) NOT NULL,
			  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
			  `email` varchar(100) COLLATE utf8_bin NOT NULL,
			  `password` varchar(100) COLLATE utf8_bin NOT NULL
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
			ALTER TABLE `usuario` ADD PRIMARY KEY (`id`);
			ALTER TABLE `usuario`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
			INSERT INTO `usuario` (`id`, `nome`, `email`, `password`) VALUES
			(1, 'Emmanuel Rodrigues', 'contato.emmanuel@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');");
		$this->conn = false;
		$this->logar();	
		return $verifica;
	}
 


	// FUNÇÃO PARA ARMAZENAMENTO DE LOG
	function retornoDeLog($texto,$titulo = "LogMonitoramento"){    
	 
	  date_default_timezone_set('America/Recife');
	  $fp = fopen($titulo.".txt", "a");    
	  $texto = print_r($texto,true);  
	  $escreve = fwrite($fp,$texto);
	  $linha  = "\n\n*-----------------------------------------------------------------------------------------------------------------------------------*\n";
	  $linha .= "*-----------------------------------------".date("D M j G:i:s T Y")."----------------------------------------------------------";
	  $linha .= "\n*-----------------------------------------------------------------------------------------------------------------------------------*\n \n";
	  $escreve = fwrite($fp,$linha);                     
	  fclose($fp);
	 
	}
	
}

?>
