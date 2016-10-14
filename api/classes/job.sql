CREATE DATABASE IF NOT EXISTS `job` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `job`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
ALTER TABLE `usuario` ADD PRIMARY KEY (`id`);
ALTER TABLE `usuario`  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;