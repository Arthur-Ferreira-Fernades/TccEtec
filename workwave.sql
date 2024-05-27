-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/05/2024 às 02:47
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `workwave`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alugar`
--

CREATE TABLE `alugar` (
  `AluId` int(11) NOT NULL,
  `AluDataEntrada` date NOT NULL,
  `AluDataSaida` date NOT NULL,
  `OcuId` int(11) NOT NULL,
  `EspId` int(11) NOT NULL,
  `PlaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `espacodados`
--

CREATE TABLE `espacodados` (
  `EspId` int(11) NOT NULL,
  `EspNome` varchar(255) NOT NULL,
  `EspEndereco` varchar(255) NOT NULL,
  `EspDescricao` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EspCapacidade` int(11) NOT NULL,
  `EspDisponibilidade` tinyint(1) DEFAULT NULL,
  `EspDataCadastro` date NOT NULL,
  `ProId` int(11) NOT NULL,
  `EspImg` varchar(255) DEFAULT NULL,
  `EspPreco` decimal(10,2) DEFAULT NULL,
  `SerId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `espacodados`
--

INSERT INTO `espacodados` (`EspId`, `EspNome`, `EspEndereco`, `EspDescricao`, `EspCapacidade`, `EspDisponibilidade`, `EspDataCadastro`, `ProId`, `EspImg`, `EspPreco`, `SerId`) VALUES
(11, 'Work', 'Rua Laranjeira 555', 'Um bom espaço de coworking', 5, 1, '2024-05-23', 1, 'Espaco1.webp', 50.00, NULL),
(12, 'Teste 2 proprietario', 'Proprietario 2', 'Espaço de um segundo proprietario', 1, NULL, '2024-05-23', 2, 'Espaco2.jpg', 1.00, NULL),
(15, 'Wave', 'Rua teste ', 'teste', 1, 1, '2024-05-24', 1, 'Espaco8.jpg', 30.00, NULL),
(20, 'Utf-8', 'Rua utf-8', 'AÃ§Ã£o Ã©', 150, NULL, '2024-05-27', 1, 'Espaco2.jpg', 150.00, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ocupante`
--

CREATE TABLE `ocupante` (
  `OcuId` int(11) NOT NULL,
  `OcuNome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OcuSenha` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OcuEmail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OcuTelefone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `ocupante`
--

INSERT INTO `ocupante` (`OcuId`, `OcuNome`, `OcuSenha`, `OcuEmail`, `OcuTelefone`) VALUES
(1, 'Arthur', '123', 'arthur@123.com', '11986599562');

-- --------------------------------------------------------

--
-- Estrutura para tabela `planosprecos`
--

CREATE TABLE `planosprecos` (
  `PlaId` int(11) NOT NULL,
  `PlaDiariaValor` double NOT NULL,
  `PlaSemanal` double DEFAULT NULL,
  `PlaMensalValor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `proprietario`
--

CREATE TABLE `proprietario` (
  `ProId` int(11) NOT NULL,
  `ProNome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ProSenha` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ProEmail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ProTelefone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `proprietario`
--

INSERT INTO `proprietario` (`ProId`, `ProNome`, `ProSenha`, `ProEmail`, `ProTelefone`) VALUES
(1, 'Arthur', '123', 'arthur@123.com', '11986599562'),
(2, 'Arthur2', '123', 'arthur2@123.com', '123456789');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servamenidades`
--

CREATE TABLE `servamenidades` (
  `SerId` int(11) NOT NULL,
  `SerWifi` tinyint(1) DEFAULT 0,
  `SerArcondicionado` tinyint(1) DEFAULT 0,
  `SerBebedouro` tinyint(1) DEFAULT 0,
  `SerComputadores` tinyint(1) DEFAULT 0,
  `SerCozinha` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alugar`
--
ALTER TABLE `alugar`
  ADD PRIMARY KEY (`AluId`),
  ADD KEY `PlaId` (`PlaId`),
  ADD KEY `OcuId` (`OcuId`),
  ADD KEY `EspId` (`EspId`);

--
-- Índices de tabela `espacodados`
--
ALTER TABLE `espacodados`
  ADD PRIMARY KEY (`EspId`),
  ADD KEY `ProId` (`ProId`),
  ADD KEY `SerId` (`SerId`);

--
-- Índices de tabela `ocupante`
--
ALTER TABLE `ocupante`
  ADD PRIMARY KEY (`OcuId`);

--
-- Índices de tabela `planosprecos`
--
ALTER TABLE `planosprecos`
  ADD PRIMARY KEY (`PlaId`);

--
-- Índices de tabela `proprietario`
--
ALTER TABLE `proprietario`
  ADD PRIMARY KEY (`ProId`);

--
-- Índices de tabela `servamenidades`
--
ALTER TABLE `servamenidades`
  ADD PRIMARY KEY (`SerId`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alugar`
--
ALTER TABLE `alugar`
  MODIFY `AluId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `espacodados`
--
ALTER TABLE `espacodados`
  MODIFY `EspId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `ocupante`
--
ALTER TABLE `ocupante`
  MODIFY `OcuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `planosprecos`
--
ALTER TABLE `planosprecos`
  MODIFY `PlaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `proprietario`
--
ALTER TABLE `proprietario`
  MODIFY `ProId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `servamenidades`
--
ALTER TABLE `servamenidades`
  MODIFY `SerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `espacodados`
--
ALTER TABLE `espacodados`
  ADD CONSTRAINT `SerId` FOREIGN KEY (`SerId`) REFERENCES `servamenidades` (`SerId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
