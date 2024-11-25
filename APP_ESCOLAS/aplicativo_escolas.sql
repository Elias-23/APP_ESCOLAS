-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/12/2023 às 02:28
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aplicativo_escolas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `nome_de_usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `data_de_nascimento` date DEFAULT NULL,
  `genero` enum('masculino','feminino','outro') DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `nome_de_usuario`, `senha`, `data_de_nascimento`, `genero`, `telefone`, `email`) VALUES
(26, 'admin', '$2y$10$wEEpH1VE6m8YFuyrTXJWQ.Ni6kLLHpNRAnMhuheJgeDgr6XJ.BFu.', '2023-12-07', 'outro', '1', 'adad@gmail'),
(27, 'João', '$2y$10$uN.C0c0dPk87NiTD8W3mCOCn/Rnp1MYw04MBVvNFucflib76Lqefy', '2023-12-14', 'outro', '23243124', 'add@afsas'),
(28, 'Ada', '$2y$10$YcHPR2EcJgh.A46A2idm.uwGA53hLJQwtK3YzhRm00QyeU3bvLFqy', '2023-12-12', 'feminino', 'asdasd', 'add@afsas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lembretes`
--

CREATE TABLE `lembretes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `lembretes`
--

INSERT INTO `lembretes` (`id`, `titulo`, `descricao`, `data_criacao`, `id_usuario`) VALUES
(28, 'Lição de Casa', '1', '2023-12-02 01:23:47', 1),
(29, 'Lição de Casa', '2', '2023-12-02 01:23:51', 1),
(30, 'Lição de Casa', '3', '2023-12-02 01:23:54', 1),
(31, 'Lição de Casa', '4', '2023-12-02 01:23:57', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `aluno` varchar(255) NOT NULL,
  `materia` varchar(255) NOT NULL,
  `nota` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `notas`
--

INSERT INTO `notas` (`id`, `aluno`, `materia`, `nota`) VALUES
(33, 'João', 'Matematica', 10.00),
(34, 'Ada', 'Portugues', 8.00),
(35, 'João ', 'Educação fisica', 10.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tabela_login`
--

CREATE TABLE `tabela_login` (
  `id` int(11) NOT NULL,
  `nome_de_usuario` varchar(50) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `data_de_registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tipo_usuario` varchar(255) NOT NULL DEFAULT 'Aluno'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tabela_login`
--

INSERT INTO `tabela_login` (`id`, `nome_de_usuario`, `senha`, `data_de_registro`, `tipo_usuario`) VALUES
(25, 'admin', '$2y$10$wEEpH1VE6m8YFuyrTXJWQ.Ni6kLLHpNRAnMhuheJgeDgr6XJ.BFu.', '2023-12-02 01:23:14', 'Gestao'),
(26, 'João', '$2y$10$uN.C0c0dPk87NiTD8W3mCOCn/Rnp1MYw04MBVvNFucflib76Lqefy', '2023-12-02 01:23:31', 'Aluno'),
(27, 'Ada', '$2y$10$YcHPR2EcJgh.A46A2idm.uwGA53hLJQwtK3YzhRm00QyeU3bvLFqy', '2023-12-02 01:26:11', 'Professor');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `lembretes`
--
ALTER TABLE `lembretes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tabela_login`
--
ALTER TABLE `tabela_login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `lembretes`
--
ALTER TABLE `lembretes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `tabela_login`
--
ALTER TABLE `tabela_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
