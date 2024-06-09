-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/06/2024 às 07:24
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
  `AluPago` tinyint(1) DEFAULT NULL,
  `AluQuantidadePessoas` int(11) DEFAULT NULL,
  `AluHorarioCheckIn` time DEFAULT NULL,
  `AluValor` double(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `alugar`
--

INSERT INTO `alugar` (`AluId`, `AluDataEntrada`, `AluDataSaida`, `OcuId`, `EspId`, `AluPago`, `AluQuantidadePessoas`, `AluHorarioCheckIn`, `AluValor`) VALUES
(18, '2024-05-27', '2024-05-28', 1, 11, NULL, NULL, NULL, NULL),
(19, '2024-05-29', '2024-05-30', 1, 11, NULL, NULL, NULL, NULL),
(20, '2024-05-31', '2024-06-07', 1, 11, NULL, NULL, NULL, NULL),
(24, '2024-06-29', '2024-06-30', 2, 35, NULL, NULL, NULL, NULL),
(25, '2024-06-15', '2024-06-16', 2, 35, NULL, NULL, NULL, NULL),
(29, '2024-06-05', '2024-06-06', 1, 35, NULL, NULL, NULL, NULL),
(60, '2024-06-10', '2024-06-12', 1, 38, NULL, 12, '12:12:00', 140.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `espacodados`
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
-- Despejando dados para a tabela `espacodados`
--

INSERT INTO `espacodados` (`EspId`, `EspNome`, `EspEndereco`, `EspDescricao`, `EspCapacidade`, `EspDisponibilidade`, `EspDataCadastro`, `ProId`, `EspImg`, `EspPreco`, `SerId`, `EspCongelado`) VALUES
(36, 'Espaço Alpha', ' Rua das Flores, 123', 'Espaço pequeno e acolhedor, perfeito para freelancers e pequenas equipes que buscam um ambiente tranquilo e inspirador. Com decoração moderna e iluminação natural, o Espaço Alpha promove um ambiente produtivo e confortável. Ideal para reuniÃµes e trabalho individual.', 10, 1, '2024-06-07', 1, 'petr-magera-WHqEneu5jgY-unsplash.jpg', '50.00', 13, 0),
(37, 'Espaço Beta', 'Avenida Central, 456', 'Localizado no coração da cidade, o Espaço Beta oferece um ambiente moderno e sofisticado. Com mesas compartilhadas e salas privadas, é ideal para startups e profissionais autônomos que precisam de flexibilidade e um local centralizado para suas atividades diárias.', 20, 1, '2024-06-07', 1, 'petr-magera-LYDP_iYgbW4-unsplash.jpg', '80.00', 14, 0),
(38, 'Espaço Gamma', 'Rua da Liberdade, 789', 'Ambiente moderno e bem iluminado, perfeito para aqueles que apreciam um design minimalista e funcional. O Espaço Gamma é equipado com estações de trabalho ergonômicas e áreas de descanso, proporcionando um equilíbrio perfeito entre trabalho e relaxamento.', 15, 1, '2024-06-07', 1, 'austin-distel-mpN7xjKQ_Ns-unsplash.jpg', '70.00', 15, 0),
(39, 'Espaço Delta', 'Praça da Sé, 101', 'Local tranquilo e inspirador, situado em uma área histórica da cidade. O Espaço Delta combina o charme de um Edifício antigo com a modernidade das instalações, oferecendo um ambiente único para trabalho colaborativo e individual.', 12, 1, '2024-06-07', 1, 'myhq-workspaces-OhNSJMm9yJI-unsplash.jpg', '65.00', 16, 0),
(40, 'Espaço Epsilon', 'Avenida Paulista, 202', 'Espaço versátil e bem localizado, ideal para profissionais em trânsito e equipes que precisam de um local de reunião central. Com uma vista incrível da cidade, o Espaço Epsilon proporciona um ambiente inspirador e altamente produtivo.', 25, 0, '2024-06-07', 1, 'mindspace-studio-FYt9yaqlvZc-unsplash.jpg', '90.00', 17, 0),
(41, 'Espaço Zeta', 'Rua Augusta, 303', 'Ambiente descontraído e criativo, perfeito para artistas, designers e empreendedores que buscam um Espaço que estimule a criatividade. O Espaço Zeta é decorado com obras de arte e oferece áreas de relaxamento e brainstorming.', 18, 0, '2024-06-07', 1, 'mengyi-CBGuFZoC6Mw-unsplash.jpg', '60.00', 18, 0),
(42, 'Espaço Eta', 'Rua das Palmeiras, 404', 'Espaço confortável e bem decorado, ideal para pequenos negócios e freelancers. Com um ambiente acolhedor e profissional, o Espaço Eta proporciona um local perfeito para produtividade e colaboração.', 20, 1, '2024-06-07', 4, 'cowomen-4C22PfVlhdw-unsplash.jpg', '75.00', 19, 0),
(43, 'Espaço Theta', 'Avenida Atlântica, 505', 'Ambiente profissional e funcional, com vistas deslumbrantes para o mar. O Espaço Theta é perfeito para quem busca um local de trabalho inspirador, com todas as comodidades necessárias para um dia produtivo.', 25, 1, '2024-06-07', 4, 'copernico-TSYQ5stQVjg-unsplash.jpg', '85.00', 20, 0),
(44, 'Espaço Lota', 'Rua do Comércio, 606', 'Local prático e acessível, ideal para pequenos empreendedores e freelancers. O Espaço Iota oferece um ambiente tranquilo e funcional, perfeito para quem precisa de concentração e produtividade.', 14, 1, '2024-06-07', 4, 'copernico-p_kICQCOM4s-unsplash.jpg', '50.00', 21, 0),
(45, 'Espaço Kappa', 'Rua Nova, 707', 'Espaço moderno e bem equipado, ideal para startups e pequenas empresas. Com infraestrutura de ponta e decoração contemporânia, o Espaço Kappa é um local que inspira inovação e produtividade.', 28, 1, '2024-06-07', 4, 'johanna-adriaansen-XfC8MMTiEfw-unsplash.jpg', '95.00', 22, 0),
(46, 'Espaço Lambda', 'Avenida Independência, 808', 'Ambiente Espaçoso e elegante, ideal para eventos corporativos e grandes equipes. O Espaço Lambda combina estilo e funcionalidade, oferecendo um local perfeito para reuniÃµes e trabalho colaborativo.', 30, 0, '2024-06-07', 4, 'myhq-workspaces-Becc3eg9-l0-unsplash.jpg', '100.00', 23, 0),
(47, 'Espaço Mu', 'Rua da Paz, 909', 'Local calmo e confortável, ideal para profissionais que buscam um ambiente tranquilo para se concentrar. O Espaço Mu oferece uma atmosfera serena e acolhedora, com todas as comodidades necessárias para um dia produtivo.', 12, 0, '2024-06-07', 4, 'scott-webb-NQymDb5XqC4-unsplash.jpg', '55.00', 24, 0),
(48, 'Espaço Nu', 'Praça da República, 1010', 'Espaço prático e bem localizado, ideal para quem precisa de um local central para trabalhar. O Espaço Nu oferece um ambiente funcional e bem equipado, perfeito para freelancers e pequenas equipes.', 15, 1, '2024-06-07', 5, 'al-ghazali-3KmWk2WC_Z0-unsplash.jpg', '70.00', 25, 0),
(49, 'Espaço Xi', 'Avenida do Contorno, 1111', 'Local versátil e acolhedor, ideal para profissionais de diversas áreas. O Espaço Xi combina funcionalidade e conforto, oferecendo um ambiente perfeito para trabalho individual e colaborativo.', 18, 1, '2024-06-07', 5, 'cowomen-1hlFqUdFv1s-unsplash.jpg', '80.00', 26, 0),
(50, 'Espaço Omicron', 'Rua das Laranjeiras, 1212', 'Espaço dinâmico e funcional, perfeito para startups e empreendedores. Com uma infraestrutura moderna e uma decoração vibrante, o Espaço Omicron inspira inovação e criatividade.', 15, 1, '2024-06-07', 5, 'smartworks-coworking-E7Tzh2TTS6c-unsplash.jpg', '65.00', 27, 0),
(51, 'Espaço Pi', 'Rua do Sol, 1313', 'Ambiente luminoso e inspirador, ideal para profissionais criativos. O Espaço Pi oferece um ambiente acolhedor e funcional, com áreas de trabalho bem iluminadas e confortáveis.', 20, 1, '2024-06-07', 5, 'yolk-coworking-krakow-AQdyCfXWxB4-unsplash.jpg', '90.00', 28, 0),
(52, 'Espaço Rho', 'Avenida das Nações, 1414', 'Espaço bem decorado e aconchegante, ideal para pequenas equipes e freelancers. O Espaço Rho combina estilo e funcionalidade, oferecendo um ambiente perfeito para trabalho colaborativo.', 22, 0, '2024-06-07', 5, 'myhq-workspaces-VCoh27vHEh0-unsplash.jpg', '85.00', 29, 0),
(53, 'Espaço Sigma', 'Rua do Prado, 1515', 'Local moderno e prático, ideal para startups e profissionais autônomos. O Espaço Sigma oferece uma infraestrutura completa e um ambiente confortável para trabalho e colaboração.', 18, 0, '2024-06-07', 5, 'myhq-workspaces-NEFgreoVtig-unsplash.jpg', '75.00', 30, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritar`
--

CREATE TABLE `favoritar` (
  `favId` int(11) NOT NULL,
  `EspId` int(11) DEFAULT NULL,
  `OcuId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(1, 'Arthur', '123', 'arthur@123.com', '11986599562'),
(3, 'Rita Ferreira', '123', 'rita@123.com', '11912345678'),
(4, 'sarah ferreira', 'arthur', 'sarahalmoya@gmail.com', '11998844335');

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
(4, 'Guilherme Nunes', '123', 'guilherme@123.com', '11998877665'),
(5, 'Sarah Moya', '123', 'sarah@123.com', '11922334455'),
(6, 'Eduarda Ferreira', '123', 'eduarda@123.com', '11987654321'),
(7, 'BIARADU', 'valen', 'gieju@gmail.com', '11986599562');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servamenidades`
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
-- Despejando dados para a tabela `servamenidades`
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
(30, 1, 0, 0, 0, 1, 53),
(31, 0, 0, 0, 0, 0, 54),
(32, 0, 0, 0, 0, 0, 55),
(33, 1, 0, 0, 0, 1, 56);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alugar`
--
ALTER TABLE `alugar`
  ADD PRIMARY KEY (`AluId`),
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
-- Índices de tabela `favoritar`
--
ALTER TABLE `favoritar`
  ADD PRIMARY KEY (`favId`),
  ADD KEY `EspId` (`EspId`),
  ADD KEY `OcuId` (`OcuId`);

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
  ADD PRIMARY KEY (`SerId`),
  ADD KEY `EspId` (`EspId`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alugar`
--
ALTER TABLE `alugar`
  MODIFY `AluId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `espacodados`
--
ALTER TABLE `espacodados`
  MODIFY `EspId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `favoritar`
--
ALTER TABLE `favoritar`
  MODIFY `favId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `ocupante`
--
ALTER TABLE `ocupante`
  MODIFY `OcuId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `planosprecos`
--
ALTER TABLE `planosprecos`
  MODIFY `PlaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `proprietario`
--
ALTER TABLE `proprietario`
  MODIFY `ProId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `servamenidades`
--
ALTER TABLE `servamenidades`
  MODIFY `SerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `espacodados`
--
ALTER TABLE `espacodados`
  ADD CONSTRAINT `SerId` FOREIGN KEY (`SerId`) REFERENCES `servamenidades` (`SerId`) ON DELETE CASCADE;

--
-- Restrições para tabelas `favoritar`
--
ALTER TABLE `favoritar`
  ADD CONSTRAINT `favoritar_ibfk_1` FOREIGN KEY (`EspId`) REFERENCES `espacodados` (`EspId`),
  ADD CONSTRAINT `favoritar_ibfk_2` FOREIGN KEY (`OcuId`) REFERENCES `ocupante` (`OcuId`);

--
-- Restrições para tabelas `servamenidades`
--
ALTER TABLE `servamenidades`
  ADD CONSTRAINT `EspId` FOREIGN KEY (`EspId`) REFERENCES `espacodados` (`EspId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
