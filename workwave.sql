-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22-Maio-2024 às 03:16
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

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
-- Estrutura da tabela `alugar`
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
-- Estrutura da tabela `espaco`
--

CREATE TABLE `espaco` (
  `EspId` int(11) NOT NULL,
  `EspNome` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `EspEndereco` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `EspDescricao` text NOT NULL,
  `EspCapacidade` int(11) NOT NULL,
  `EspDisponibilidade` tinyint(1) NOT NULL DEFAULT 1,
  `EspDataCadastro` date NOT NULL,
  `ProId` int(11) NOT NULL,
  `SerId` int(11) NOT NULL,
  `PlaId` int(11) NOT NULL,
  `EspImg` varchar(255) DEFAULT NULL,
  `EspPreco` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `espacodados`
--

CREATE TABLE `espacodados` (
  `EspId` int(11) NOT NULL,
  `EspNome` varchar(255) NOT NULL,
  `EspEndereco` varchar(255) NOT NULL,
  `EspDescricao` text NOT NULL,
  `EspCapacidade` int(11) NOT NULL,
  `EspDisponibilidade` tinyint(1) DEFAULT NULL,
  `EspDataCadastro` date NOT NULL,
  `ProId` int(11) NOT NULL,
  `EspImg` varchar(255) DEFAULT NULL,
  `EspPreco` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `espacodados`
--

INSERT INTO `espacodados` (`EspId`, `EspNome`, `EspEndereco`, `EspDescricao`, `EspCapacidade`, `EspDisponibilidade`, `EspDataCadastro`, `ProId`, `EspImg`, `EspPreco`) VALUES
(1, 'Teste ', 'Rua teste', 'Descricao teste', 0, NULL, '0000-00-00', 1, 'Espaco2.jpg', '150.00'),
(2, 'Teste ', 'Rua teste', 'Descricao teste', 0, NULL, '2024-05-22', 1, 'Espaco2.jpg', '150.00'),
(3, 'Teste ', 'Rua teste', 'Descricao teste', 10, NULL, '2024-05-22', 1, 'Espaco2.jpg', '150.00'),
(4, 'Teste ', 'Rua teste', 'Descricao teste', 10, NULL, '2024-05-22', 1, 'Espaco2.jpg', '150.00'),
(5, 'Teste 2', 'Rua Teste 2', 'Descricao Teste 2', 10, NULL, '2024-05-22', 1, 'Espaco3.jpg', '150.00'),
(6, 'Teste 3', 'Rua Teste 3', 'Descricao ', 3, NULL, '2024-05-22', 1, 'Espaco3.jpg', '100.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ocupante`
--

CREATE TABLE `ocupante` (
  `OcuId` int(11) NOT NULL,
  `OcuNome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OcuSenha` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OcuEmail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `OcuTelefone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `ocupante`
--

INSERT INTO `ocupante` (`OcuId`, `OcuNome`, `OcuSenha`, `OcuEmail`, `OcuTelefone`) VALUES
(1, 'arthur', '123', 'arthur@123.com', '123456789');

-- --------------------------------------------------------

--
-- Estrutura da tabela `planosprecos`
--

CREATE TABLE `planosprecos` (
  `PlaId` int(11) NOT NULL,
  `PlaDiariaValor` double NOT NULL,
  `PlaSemanal` double DEFAULT NULL,
  `PlaMensalValor` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `proprietario`
--

CREATE TABLE `proprietario` (
  `ProId` int(11) NOT NULL,
  `ProNome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ProSenha` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ProEmail` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ProTelefone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `proprietario`
--

INSERT INTO `proprietario` (`ProId`, `ProNome`, `ProSenha`, `ProEmail`, `ProTelefone`) VALUES
(1, 'Arthur', '123', 'arthur@123.com', '11986599562');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servamenidades`
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
-- Índices para tabela `alugar`
--
ALTER TABLE `alugar`
  ADD PRIMARY KEY (`AluId`),
  ADD KEY `PlaId` (`PlaId`),
  ADD KEY `OcuId` (`OcuId`),
  ADD KEY `EspId` (`EspId`);

--
-- Índices para tabela `espaco`
--
ALTER TABLE `espaco`
  ADD PRIMARY KEY (`EspId`),
  ADD KEY `PlaId` (`PlaId`),
  ADD KEY `ProId` (`ProId`),
  ADD KEY `SerId` (`SerId`);

--
-- Índices para tabela `espacodados`
--
ALTER TABLE `espacodados`
  ADD PRIMARY KEY (`EspId`),
  ADD KEY `ProId` (`ProId`);

--
-- Índices para tabela `ocupante`
--
ALTER TABLE `ocupante`
  ADD PRIMARY KEY (`OcuId`);

--
-- Índices para tabela `planosprecos`
--
ALTER TABLE `planosprecos`
  ADD PRIMARY KEY (`PlaId`);

--
-- Índices para tabela `proprietario`
--
ALTER TABLE `proprietario`
  ADD PRIMARY KEY (`ProId`);

--
-- Índices para tabela `servamenidades`
--
ALTER TABLE `servamenidades`
  ADD PRIMARY KEY (`SerId`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alugar`
--
ALTER TABLE `alugar`
  MODIFY `AluId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `espaco`
--
ALTER TABLE `espaco`
  MODIFY `EspId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `espacodados`
--
ALTER TABLE `espacodados`
  MODIFY `EspId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `ProId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `servamenidades`
--
ALTER TABLE `servamenidades`
  MODIFY `SerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alugar`
--
ALTER TABLE `alugar`
  ADD CONSTRAINT `alugar_ibfk_1` FOREIGN KEY (`PlaId`) REFERENCES `planosprecos` (`PlaId`),
  ADD CONSTRAINT `alugar_ibfk_2` FOREIGN KEY (`OcuId`) REFERENCES `ocupante` (`OcuId`),
  ADD CONSTRAINT `alugar_ibfk_3` FOREIGN KEY (`EspId`) REFERENCES `espaco` (`EspId`);

--
-- Limitadores para a tabela `espacodados`
--
ALTER TABLE `espacodados`
  ADD CONSTRAINT `espacodados_ibfk_1` FOREIGN KEY (`ProId`) REFERENCES `proprietario` (`ProId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
