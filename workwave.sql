-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Jun-2024 às 01:31
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
  `AluPago` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `alugar`
--

INSERT INTO `alugar` (`AluId`, `AluDataEntrada`, `AluDataSaida`, `OcuId`, `EspId`, `AluPago`) VALUES
(18, '2024-05-27', '2024-05-28', 1, 11, NULL),
(19, '2024-05-29', '2024-05-30', 1, 11, NULL),
(20, '2024-05-31', '2024-06-07', 1, 11, NULL),
(24, '2024-06-29', '2024-06-30', 2, 35, NULL),
(25, '2024-06-15', '2024-06-16', 2, 35, NULL),
(29, '2024-06-05', '2024-06-06', 1, 35, NULL),
(37, '2024-06-07', '2024-06-08', 3, 36, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `espacodados`
--

CREATE TABLE `espacodados` (
  `EspId` int(11) NOT NULL,
  `EspNome` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EspEndereco` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EspDescricao` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `EspCapacidade` int(11) NOT NULL,
  `EspDisponibilidade` tinyint(1) DEFAULT 1,
  `EspDataCadastro` date NOT NULL,
  `ProId` int(11) NOT NULL,
  `EspImg` varchar(255) DEFAULT NULL,
  `EspPreco` decimal(10,2) DEFAULT NULL,
  `SerId` int(11) DEFAULT NULL,
  `EspCongelado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `espacodados`
--

INSERT INTO `espacodados` (`EspId`, `EspNome`, `EspEndereco`, `EspDescricao`, `EspCapacidade`, `EspDisponibilidade`, `EspDataCadastro`, `ProId`, `EspImg`, `EspPreco`, `SerId`, `EspCongelado`) VALUES
(36, 'EspaÃ§o Alpha', ' Rua das Flores, 123', 'EspaÃ§o pequeno e acolhedor, perfeito para freelancers e pequenas equipes que buscam um ambiente tranquilo e inspirador. Com decoraÃ§Ã£o moderna e iluminaÃ§Ã£o natural, o EspaÃ§o Alpha promove um ambiente produtivo e confortÃ¡vel. Ideal para reuniÃµes e trabalho individual.', 10, 1, '2024-06-07', 1, 'petr-magera-WHqEneu5jgY-unsplash.jpg', '50.00', 13, 0),
(37, 'EspaÃ§o Beta', 'Avenida Central, 456', 'Localizado no coraÃ§Ã£o da cidade, o EspaÃ§o Beta oferece um ambiente moderno e sofisticado. Com mesas compartilhadas e salas privadas, Ã© ideal para startups e profissionais autÃ´nomos que precisam de flexibilidade e um local centralizado para suas atividades diÃ¡rias.', 20, 1, '2024-06-07', 1, 'petr-magera-LYDP_iYgbW4-unsplash.jpg', '80.00', 14, 0),
(38, 'EspaÃ§o Gamma', 'Rua da Liberdade, 789', 'Ambiente moderno e bem iluminado, perfeito para aqueles que apreciam um design minimalista e funcional. O EspaÃ§o Gamma Ã© equipado com estaÃ§Ãµes de trabalho ergonÃ´micas e Ã¡reas de descanso, proporcionando um equilÃ­brio perfeito entre trabalho e relaxamento.', 15, 1, '2024-06-07', 1, 'austin-distel-mpN7xjKQ_Ns-unsplash.jpg', '70.00', 15, 0),
(39, 'EspaÃ§o Delta', 'Pra?a da S?, 101', 'Local tranquilo e inspirador, situado em uma Ã¡rea histÃ³rica da cidade. O EspaÃ§o Delta combina o charme de um edifÃ­cio antigo com a modernidade das instalaÃ§Ãµes, oferecendo um ambiente Ãºnico para trabalho colaborativo e individual.', 12, 1, '2024-06-07', 1, 'myhq-workspaces-OhNSJMm9yJI-unsplash.jpg', '65.00', 16, 0),
(40, 'EspaÃ§o Epsilon', 'Avenida Paulista, 202', 'EspaÃ§o versÃ¡til e bem localizado, ideal para profissionais em trÃ¢nsito e equipes que precisam de um local de reuniÃ£o central. Com uma vista incrÃ­vel da cidade, o EspaÃ§o Epsilon proporciona um ambiente inspirador e altamente produtivo.', 25, 0, '2024-06-07', 1, 'mindspace-studio-FYt9yaqlvZc-unsplash.jpg', '90.00', 17, 0),
(41, 'EspaÃ§o Zeta', 'Rua Augusta, 303', 'Ambiente descontraÃ­do e criativo, perfeito para artistas, designers e empreendedores que buscam um espaÃ§o que estimule a criatividade. O EspaÃ§o Zeta Ã© decorado com obras de arte e oferece Ã¡reas de relaxamento e brainstorming.', 18, 0, '2024-06-07', 1, 'mengyi-CBGuFZoC6Mw-unsplash.jpg', '60.00', 18, 0),
(42, 'EspaÃ§o Eta', 'Rua das Palmeiras, 404', 'EspaÃ§o confortÃ¡vel e bem decorado, ideal para pequenos negÃ³cios e freelancers. Com um ambiente acolhedor e profissional, o EspaÃ§o Eta proporciona um local perfeito para produtividade e colaboraÃ§Ã£o.', 20, 1, '2024-06-07', 4, 'cowomen-4C22PfVlhdw-unsplash.jpg', '75.00', 19, 0),
(43, 'EspaÃ§o Theta', 'Avenida Atlântica, 505', 'Ambiente profissional e funcional, com vistas deslumbrantes para o mar. O EspaÃ§o Theta Ã© perfeito para quem busca um local de trabalho inspirador, com todas as comodidades necessÃ¡rias para um dia produtivo.', 25, 1, '2024-06-07', 4, 'copernico-TSYQ5stQVjg-unsplash.jpg', '85.00', 20, 0),
(44, 'EspaÃ§o Lota', 'Rua do Comércio, 606', 'Local prÃ¡tico e acessÃ­vel, ideal para pequenos empreendedores e freelancers. O EspaÃ§o Iota oferece um ambiente tranquilo e funcional, perfeito para quem precisa de concentraÃ§Ã£o e produtividade.', 14, 1, '2024-06-07', 4, 'copernico-p_kICQCOM4s-unsplash.jpg', '50.00', 21, 0),
(45, 'EspaÃ§o Kappa', 'Rua Nova, 707', 'EspaÃ§o moderno e bem equipado, ideal para startups e pequenas empresas. Com infraestrutura de ponta e decoraÃ§Ã£o contemporÃ¢nea, o EspaÃ§o Kappa Ã© um local que inspira inovaÃ§Ã£o e produtividade.', 28, 1, '2024-06-07', 4, 'johanna-adriaansen-XfC8MMTiEfw-unsplash.jpg', '95.00', 22, 0),
(46, 'EspaÃ§o Lambda', 'Avenida Independência, 808', 'Ambiente espaÃ§oso e elegante, ideal para eventos corporativos e grandes equipes. O EspaÃ§o Lambda combina estilo e funcionalidade, oferecendo um local perfeito para reuniÃµes e trabalho colaborativo.', 30, 0, '2024-06-07', 4, 'myhq-workspaces-Becc3eg9-l0-unsplash.jpg', '100.00', 23, 0),
(47, 'EspaÃ§o Mu', 'Rua da Paz, 909', 'Local calmo e confortÃ¡vel, ideal para profissionais que buscam um ambiente tranquilo para se concentrar. O EspaÃ§o Mu oferece uma atmosfera serena e acolhedora, com todas as comodidades necessÃ¡rias para um dia produtivo.', 12, 0, '2024-06-07', 4, 'scott-webb-NQymDb5XqC4-unsplash.jpg', '55.00', 24, 0),
(48, 'EspaÃ§o Nu', 'Praça da República, 1010', 'EspaÃ§o prÃ¡tico e bem localizado, ideal para quem precisa de um local central para trabalhar. O EspaÃ§o Nu oferece um ambiente funcional e bem equipado, perfeito para freelancers e pequenas equipes.', 15, 1, '2024-06-07', 5, 'al-ghazali-3KmWk2WC_Z0-unsplash.jpg', '70.00', 25, 0),
(49, 'EspaÃ§o Xi', 'Avenida do Contorno, 1111', 'Local versÃ¡til e acolhedor, ideal para profissionais de diversas Ã¡reas. O EspaÃ§o Xi combina funcionalidade e conforto, oferecendo um ambiente perfeito para trabalho individual e colaborativo.', 18, 1, '2024-06-07', 5, 'cowomen-1hlFqUdFv1s-unsplash.jpg', '80.00', 26, 0),
(50, 'EspaÃ§o Omicron', 'Rua das Laranjeiras, 1212', 'EspaÃ§o dinÃ¢mico e funcional, perfeito para startups e empreendedores. Com uma infraestrutura moderna e uma decoraÃ§Ã£o vibrante, o EspaÃ§o Omicron inspira inovaÃ§Ã£o e criatividade.', 15, 1, '2024-06-07', 5, 'smartworks-coworking-E7Tzh2TTS6c-unsplash.jpg', '65.00', 27, 0),
(51, 'EspaÃ§o Pi', 'Rua do Sol, 1313', 'Ambiente luminoso e inspirador, ideal para profissionais criativos. O EspaÃ§o Pi oferece um ambiente acolhedor e funcional, com Ã¡reas de trabalho bem iluminadas e confortÃ¡veis.', 20, 1, '2024-06-07', 5, 'yolk-coworking-krakow-AQdyCfXWxB4-unsplash.jpg', '90.00', 28, 0),
(52, 'EspaÃ§o Rho', 'Avenida das Nações, 1414', 'EspaÃ§o bem decorado e aconchegante, ideal para pequenas equipes e freelancers. O EspaÃ§o Rho combina estilo e funcionalidade, oferecendo um ambiente perfeito para trabalho colaborativo.', 22, 0, '2024-06-07', 5, 'myhq-workspaces-VCoh27vHEh0-unsplash.jpg', '85.00', 29, 0),
(53, 'EspaÃ§o Sigma', 'Rua do Prado, 1515', 'Local moderno e prÃ¡tico, ideal para startups e profissionais autÃ´nomos. O EspaÃ§o Sigma oferece uma infraestrutura completa e um ambiente confortÃ¡vel para trabalho e colaboraÃ§Ã£o.', 18, 0, '2024-06-07', 5, 'myhq-workspaces-NEFgreoVtig-unsplash.jpg', '75.00', 30, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritar`
--

CREATE TABLE `favoritar` (
  `favId` int(11) NOT NULL,
  `EspId` int(11) DEFAULT NULL,
  `OcuId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(1, 'Arthur', '123', 'arthur@123.com', '11986599562'),
(3, 'Rita Ferreira', '123', 'rita@123.com', '11912345678');

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
(1, 'Arthur', '123', 'arthur@123.com', '11986599562'),
(4, 'Guilherme Nunes', '123', 'guilherme@123.com', '11998877665'),
(5, 'Sarah Moya', '123', 'sarah@123.com', '11922334455'),
(6, 'Eduarda Ferreira', '123', 'eduarda@123.com', '11987654321');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servamenidades`
--

CREATE TABLE `servamenidades` (
  `SerId` int(11) NOT NULL,
  `SerWifi` tinyint(1) DEFAULT NULL,
  `SerArcondicionado` tinyint(1) DEFAULT NULL,
  `SerBebedouro` tinyint(1) DEFAULT NULL,
  `SerComputadores` tinyint(1) DEFAULT NULL,
  `SerCozinha` tinyint(1) DEFAULT NULL,
  `EspId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `servamenidades`
--

INSERT INTO `servamenidades` (`SerId`, `SerWifi`, `SerArcondicionado`, `SerBebedouro`, `SerComputadores`, `SerCozinha`, `EspId`) VALUES
(7, 0, 0, 0, 0, 0, NULL),
(8, 0, 0, 0, 0, 0, NULL),
(13, 1, 1, 1, 0, 0, 36),
(14, 1, 0, 0, 0, 1, 37),
(15, 1, 0, 0, 1, 0, 38),
(16, 1, 1, 0, 0, 0, 39),
(17, 1, 0, 1, 0, 1, 40),
(18, 1, 0, 1, 0, 0, 41),
(19, 1, 0, 0, 0, 1, 42),
(20, 1, 0, 0, 1, 0, 43),
(21, 1, 1, 0, 0, 0, 44),
(22, 1, 0, 0, 1, 1, 45),
(23, 1, 1, 1, 0, 0, 46),
(24, 1, 0, 0, 0, 1, 47),
(25, 1, 0, 1, 1, 0, 48),
(26, 1, 1, 0, 0, 0, 49),
(27, 1, 0, 1, 0, 1, 50),
(28, 1, 1, 0, 1, 0, 51),
(29, 1, 0, 1, 0, 0, 52),
(30, 1, 0, 0, 0, 1, 53);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alugar`
--
ALTER TABLE `alugar`
  ADD PRIMARY KEY (`AluId`),
  ADD KEY `OcuId` (`OcuId`),
  ADD KEY `EspId` (`EspId`);

--
-- Índices para tabela `espacodados`
--
ALTER TABLE `espacodados`
  ADD PRIMARY KEY (`EspId`),
  ADD KEY `ProId` (`ProId`),
  ADD KEY `SerId` (`SerId`);

--
-- Índices para tabela `favoritar`
--
ALTER TABLE `favoritar`
  ADD PRIMARY KEY (`favId`),
  ADD KEY `EspId` (`EspId`),
  ADD KEY `OcuId` (`OcuId`);

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
  ADD PRIMARY KEY (`SerId`),
  ADD KEY `EspId` (`EspId`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alugar`
--
ALTER TABLE `alugar`
  MODIFY `AluId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `espacodados`
--
ALTER TABLE `espacodados`
  MODIFY `EspId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `favoritar`
--
ALTER TABLE `favoritar`
  MODIFY `favId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ocupante`
--
ALTER TABLE `ocupante`
  MODIFY `OcuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `planosprecos`
--
ALTER TABLE `planosprecos`
  MODIFY `PlaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `proprietario`
--
ALTER TABLE `proprietario`
  MODIFY `ProId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `servamenidades`
--
ALTER TABLE `servamenidades`
  MODIFY `SerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `espacodados`
--
ALTER TABLE `espacodados`
  ADD CONSTRAINT `SerId` FOREIGN KEY (`SerId`) REFERENCES `servamenidades` (`SerId`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `favoritar`
--
ALTER TABLE `favoritar`
  ADD CONSTRAINT `favoritar_ibfk_1` FOREIGN KEY (`EspId`) REFERENCES `espacodados` (`EspId`),
  ADD CONSTRAINT `favoritar_ibfk_2` FOREIGN KEY (`OcuId`) REFERENCES `ocupante` (`OcuId`);

--
-- Limitadores para a tabela `servamenidades`
--
ALTER TABLE `servamenidades`
  ADD CONSTRAINT `EspId` FOREIGN KEY (`EspId`) REFERENCES `espacodados` (`EspId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
