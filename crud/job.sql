-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/04/2016 às 01:42
-- Versão do servidor: 5.6.25
-- Versão do PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `job`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `password`) VALUES
(1, 'Emmanuel Rodrigues', 'contato.emmanuel@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(2, 'Mariana Arruda', 'contato.mariana@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'Raquel Arruda', 'contato.raquel@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'Bernadete Dias', 'contato.bernadete@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(5, 'Manoel Rodrigues', 'contato.manoel@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b'),
(6, 'Fulano da Silva', 'contato.fulano@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
