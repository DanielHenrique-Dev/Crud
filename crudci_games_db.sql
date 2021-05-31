-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/02/2021 às 22:52
-- Versão do servidor: 10.4.14-MariaDB
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crudci_games_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_category`
--

CREATE TABLE `tb_category` (
  `id_category` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `tb_category`
--

INSERT INTO `tb_category` (`id_category`, `category`, `user_id`) VALUES
(8, 'RPG eletrônico de ação', 1),
(10, 'Jogo eletrônico de ação', 1),
(11, 'Moba', 1),
(14, 'MMO-RPG', 1),
(15, 'Japanese role-playing game', 1),
(18, 'luta online', 1),
(19, 'Jogo eletrônico de batalha real', 1),
(20, 'Adventure', 30),
(21, 'Sobrevivência ', 17);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_games`
--

CREATE TABLE `tb_games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `developer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `release_date` date NOT NULL DEFAULT '1111-11-11',
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `tb_games`
--

INSERT INTO `tb_games` (`id`, `name`, `description`, `price`, `developer`, `release_date`, `user_id`, `category_id`) VALUES
(13, 'Cyberpunk 2077', 'Cyberpunk 2077 é um jogo eletrônico de RPG de ação desenvolvido e publicado pela CD Projekt. Lançado em 10 de dezembro de 2020 para Google Stadia, Microsoft Windows, PlayStation 4 e Xbox One, e previsto para 2021 para PlayStation 5 e Xbox Series X/S. ', '210.00', 'CD Projekt, CD Projekt RED', '1111-11-11', 1, 10),
(14, 'Mafia III', 'Mafia III é um jogo eletrônico de ação e aventura produzido pelo estúdio Hangar 13 e lançado pela 2K Games em 7 de outubro de 2016 para as plataformas Microsoft Windows, PlayStation 4 e Xbox One. É o terceiro jogo da série Mafia e o primeiro desenvolvido pela Hangar 13. ', '59.00', ' Hangar 13, 2K Czech, Aspyr Media', '1111-11-11', 1, NULL),
(15, 'Grand Theft Auto V', 'Grand Theft Auto V é um jogo eletrônico de ação-aventura desenvolvido pela Rockstar North e publicado pela Rockstar Games', '50.00', 'Rockstar Games', '1111-11-11', 1, 10),
(16, 'The Witcher 3: Wild Hunt', 'The Witcher 3: Wild Hunt é um jogo eletrônico de ação do subgênero RPG desenvolvido pela CD Projekt RED e lançado no dia 19 de maio de 2015 para as plataformas Microsoft Windows, PlayStation 4, Xbox One e em outubro de 2019 para o Nintendo Switch, sendo o terceiro título da série de jogos The Witcher.', '69.90', 'CD Projekt, CD Projekt RED', '1111-11-11', 1, NULL),
(17, 'Red Dead Redemption 2', 'Red Dead Redemption 2 é um jogo eletrônico de ação-aventura desenvolvido e publicado pela Rockstar Games. É o terceiro título da série Red Dead e uma prequela de Red Dead Redemption, tendo sido lançado em outubro de 2018 para PlayStation 4 e Xbox One e em novembro de 2019 para Microsoft Windows e Google Stadia', '200.00', 'Rockstar Advanced Game Engine', '1111-11-11', 1, NULL),
(18, 'The Sims 4', 'The Sims 4 é o quarto título da franquia de jogos eletrônicos de simulação de vida The Sims, desenvolvido pela Maxis e publicado pela Electronic Arts. The Sims 4 foi originalmente anunciado em 6 de maio de 2013, e lançado nos Estados Unidos, Brasil e Portugal em 2 de setembro de 2014, para o Microsoft Windows', '255.90', 'Maxis', '1111-11-11', 1, NULL),
(59, 'Chrono Trigger', 'Chrono Trigger é um jogo de RPG eletrônico desenvolvido pela Square Co. Foi lançado para o console Super Nintendo no Japão em março de 1995, e uma versão aprimorada para PlayStation foi lançada em novembro de 1999', '10000.00', 'Square Enix, Square Co., Tose, SQUARE ENIX CO., LTD.', '1111-11-11', 1, 15),
(60, 'League of Legends', 'League of Legends é um jogo eletrônico online gratuito, do gênero batalha multijogador, desenvolvido e publicado pela Riot Games em 2009, para os sistemas Microsoft Windows e Mac OS X, inspirado no modo Defense of the Ancients do jogo Warcraft III: The Frozen Throne', '0.00', 'Riot Games', '1111-11-11', 1, NULL),
(62, 'Final Fantasy VI', 'Final Fantasy VI é um jogo eletrônico de RPG desenvolvido e publicado pela SquareSoft para o Super Nintendo Entertainment System. Lançado em 1994, é o sexto título principal da série Final Fantasy', '888.00', 'Square Enix, Square Co., Tose', '1111-11-11', 27, NULL),
(65, 'Counter-Strike 2', 'Counter-Strike é uma série de jogos eletrônicos de tiro em primeira pessoa multiplayer, no qual times de terroristas e contra-terroristas batalham entre si, respectivamente, realizando um ato de terror e prevenindo-os. A série iniciou-se no Windows em 1999 com a primeira versão do Counter-Strike.', '0.00', 'Valve Corporation, Nexon, MAIS', '1111-11-11', 1, 10),
(66, 'Minecraft', 'Minecraft é um jogo eletrônico sandbox de sobrevivência criado pelo desenvolvedor sueco Markus \"Notch\" Persson e posteriormente desenvolvido e publicado pela Mojang Studios, cuja propriedade intelectual foi obtida pela Microsoft em 2014.', '150.00', 'Mojang Studios, Other Ocean Interactive', '1111-11-11', 17, 21),
(69, 'Dark Souls', 'Dark Souls é um jogo eletrônico de RPG de ação desenvolvido pela FromSoftware e publicado pela Namco Bandai Games. Lançado originalmente em setembro de 2011 para PlayStation 3 e Xbox 360, é um sucessor espiritual de Demon\'s Souls e a segundo título da série Souls', '85.00', 'FromSoftware', '1111-11-11', 1, 8),
(70, 'Naruto Shippuden: Ultimate Ninja Storm 4', 'Naruto Shippuden: Ultimate Ninja Storm 4, é o quarto jogo da série Ultimate Ninja Storm. É um jogo de luta, desenvolvido pelo CyberConect2 e publicado pela Namco-Bandai games para PC, PlayStation 4, Xbox One e Nintendo Switch baseado na franquia de anime e mangá Naruto', '50.00', 'CyberConnect2', '1111-11-11', 24, 20);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nivel` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `ativo` tinyint(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `tb_users`
--

INSERT INTO `tb_users` (`id`, `name`, `email`, `password`, `country`, `nivel`, `ativo`) VALUES
(1, 'Administrador Master', 'daniel@curso.com.br', '81dc9bdb52d04dc20036dbd8313ed055', 'Brazil', 1, 1),
(17, 'Erick', 'erick@curso.com.br', 'a0649bf525af3c71de0f26a45bbfdf8a', 'Canada', 0, 1),
(24, 'Logan', 'logan@curso.com.br', '35379031d2605e03d49977f32ae73c30', 'USA', 0, 1),
(27, 'Lucca Tonny', 'lucca@curso.com.br', '6cf82ee1020caef069e753c67a97a70d', 'Italy', 0, 1),
(28, 'Jhonatan', 'jhonatan@curso.com.br', 'd964173dc44da83eeafa3aebbee9a1a0', 'Brazil', 0, 1),
(29, 'James', 'james@curso.com.br', '5aca404939840d649859659c44883aed', 'USA', 1, 0),
(30, 'Gabigol', 'gabigol@curso.com.br', '838311e27df06b0ef2f0340eff1d56a3', 'Brasil', 0, 0),
(34, 'Rei', 'rei@curso.com.br', 'dbc4d84bfcfe2284ba11beffb853a8c4', 'Brazil', 0, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `tb_games`
--
ALTER TABLE `tb_games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Índices de tabela `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `tb_games`
--
ALTER TABLE `tb_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_category`
--
ALTER TABLE `tb_category`
  ADD CONSTRAINT `tb_category_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`);

--
-- Restrições para tabelas `tb_games`
--
ALTER TABLE `tb_games`
  ADD CONSTRAINT `tb_games_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id`),
  ADD CONSTRAINT `tb_games_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `tb_category` (`id_category`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
