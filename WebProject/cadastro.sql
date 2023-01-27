-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Jan-2023 às 20:12
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `empresas`
--

INSERT INTO `empresas` (`id`, `nome`, `email`, `usuario`, `senha`) VALUES
(1, 'BNDS', 'bnds.prise@gmail.com', 'bnds.prise', '123'),
(2, 'JBS', 'jbs.interprise@gmail.com', 'jbs.prise', '1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `desenvolvedor` varchar(11) NOT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `instagram` varchar(30) DEFAULT NULL,
  `html` int(1) DEFAULT NULL,
  `css` int(1) DEFAULT NULL,
  `php` int(1) DEFAULT NULL,
  `javascript` int(1) DEFAULT NULL,
  `perfilgithub` varchar(100) NOT NULL,
  `FotoUsuario` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `usuario`, `senha`, `desenvolvedor`, `descricao`, `instagram`, `html`, `css`, `php`, `javascript`, `perfilgithub`, `FotoUsuario`) VALUES
(12, 'João Pedro', 'joaopedrobraga.07@gmail.com.br', 'jp.dicarvalho', '123', 'Front-End', 'olá, meu nome é João Pedro e tenho 21 anos sou desenvolvedor Front-End há mais de 5 anos, possuo bastante experiência nesta área...', '@jp.dicarvalho', 1, 1, 1, 1, 'https://github.com/jpdicarvalho', 'img1.jpg'),
(13, 'zuck', 'zuck@gmail.com', 'zuck.berg', '12345', 'Full Stack', 'dfbdfbfbfbfbabfab', 'sgsg', 1, 1, NULL, NULL, 'sgsg', '1581974.jpg'),
(14, 'steve', 'stevejobs@gmail.com', 'steve.jobs', '1234', 'Back-End', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(15, 'apollo', 'apollo.hi@gmail.com', 'apollo.18', '123456', 'Front-End', NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(16, 'Jarlysson Auzier', 'jarlysson@gmail.com', 'jarlysso.az', '147', 'Front-End', NULL, NULL, NULL, NULL, NULL, NULL, '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
