-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06/12/2024 às 11:26
-- Versão do servidor: 8.0.40
-- Versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `overdrive`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

DROP TABLE IF EXISTS `endereco`;
CREATE TABLE IF NOT EXISTS `endereco` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cep` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logradouro` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cep`, `estado`, `cidade`, `logradouro`, `bairro`, `numero`) VALUES
(4, '13550-000', 'SP', 'Analândia', 'Rua Hortêncio Canela', 'Parque da Felicidade II', '20'),
(5, '13550-000', 'SP', 'Analândia', 'Rua José Salomé', 'Parque da Felicidade II', '51'),
(6, '13550-000', 'SP', 'Analândia', 'Avenida 12', 'JD SANTO ANTONIO', '51'),
(7, '13973-274', 'SP', 'Itapira', 'Rua Hortêncio Canela', 'Parque Da Felicidade II', '06'),
(8, '13974-110', 'Sp', 'Itapira', 'Avenida Getúlio Vargas', 'Pires', '10'),
(9, '13550-000', 'Sp', 'Araras', 'Rua José Salomé', 'Parque Da Felicidade Ii', '51'),
(10, '13550-000', 'Sp', 'Araras', 'Rua Hortêncio Canela', 'Parque Da Felicidade Ii', '20'),
(11, '13550-000', 'Sp', 'Analândia', 'Rua José Salomé', 'Jd Santo Antonio', '10'),
(12, '13550-000', 'Sp', 'Analândia', 'Avenida Getúlio Vargas', 'Jardim Campestre', '10'),
(13, '13550-000', 'Sp', 'Analândia', 'Avenida Getúlio Vargas', 'Jardim Campestre', '20'),
(14, '13181-682', 'SP', 'Sumaré', 'Rua Francisco João Lessa', 'Vila Operária', '10'),
(15, '13550-000', 'Sp', 'Analândia', 'Avenida 12', 'Jd Santo Antonio', '30'),
(16, '13550-000', 'Sp', 'Analândia', 'Rua Francisco João Lessa', 'Pires', '06'),
(17, '13973-274', 'Sp', 'Itapira', 'Rua Hortêncio Canela', 'Parque Da Felicidade Ii', '22'),
(18, '11432-505', 'SP', 'Guarujá', 'Rua Um', 'Vila Santo Antônio', '30'),
(19, '13550-000', 'Sp', 'Analândia', 'Avenida 12', 'Parque Da Felicidade Ii', '06'),
(20, '13550-000', 'Ac', 'Rio Claro', 'Rua José Salomé', 'Jd Santo Antonio', '10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `enterprise`
--

DROP TABLE IF EXISTS `enterprise`;
CREATE TABLE IF NOT EXISTS `enterprise` (
  `cnpj` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_emp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome_fantasia` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsavel` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_address` int NOT NULL,
  PRIMARY KEY (`cnpj`),
  KEY `id_address` (`id_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `enterprise`
--

INSERT INTO `enterprise` (`cnpj`, `nome_emp`, `nome_fantasia`, `senha`, `telefone`, `responsavel`, `id_address`) VALUES
('02.200.755/0001-65', 'Shangai LTDA', 'Shangai', '12345678', '(19) 98149-5187', 'Pombo', 9),
('12.345.678/0001-23', 'Amazon LTDA', 'Amazon', '$2y$10$8OyK8F3BruUnMOkzQDX5o.4pZhv7TKkmz8XYZPqVqSI4UqdhTz1gq', '(19) 40028-9222', 'Jeff Bezos', 14),
('33.333.333/3333-33', 'Facebook LTDA', 'Facebook', '$2y$10$VrHsRCmA.uCHzjkqqJ7lmOj2iMsI1EyCwR6QfVwwX5ICfdQj054Si', '(19) 92342-3553', 'Zukemberg', 18);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `cpf` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnh` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carro` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_address` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `tipo` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`cpf`),
  KEY `id_address` (`id_address`),
  KEY `cnpj` (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`cpf`, `nome`, `senha`, `cnh`, `telefone`, `carro`, `cnpj`, `id_address`, `status`, `tipo`) VALUES
('111.111.111-11', 'Renato', '$2y$10$JaJFOhe6WMfV07EM5gHRle8eBBM05ZUWaPiprVb1SPJAtMHxnpZe2', 'Tipo A', '(19) 98149-5187', 'Bicicleta', '02.200.755/0001-65', 20, 0, 'Comum'),
('444.444.444-44', 'Kaike', '$2y$10$rKmH4iksMDj2hO87hAJdiuNLCsR2BZkq5XmHbrBJRmjexxiAZpTdm', 'Tipo C', '(19) 97166-1478', 'Van', '02.200.755/0001-65', 19, 0, 'Comum'),
('555.555.555-55', 'Rodrigo Piassi Martins', '$2y$10$CBDb/7f7cXviqMVQHrFZPufAvwoi2mrJXplh9Lrm2geBgySxqxJtK', 'Tipo C', '(19) 98149-5187', 'Caminhão', '02.200.755/0001-65', 6, 0, 'Comum'),
('777.777.777-77', 'Cristiano Ronaldo', '$2y$10$xkhv7oPlsnBBKysQfgO0deMPkw.xn3VJMWOpBUTVe04PUkZGDm9Cy', 'Tipo C', '(19) 98149-5187', 'Caminhão', '02.200.755/0001-65', 4, 0, 'Comum'),
('999.999.999-99', 'Felipe Godoy', '$2y$10$lPhUQHXJ303hQVFPkYW0YeS0NH0a9464pX9DlqFeRNG0SPizqpnFy', 'Tipo B', '(19) 99314-7754', 'Ferrari', '12.345.678/0001-23', 17, 0, 'Comum');

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `enterprise`
--
ALTER TABLE `enterprise`
  ADD CONSTRAINT `enterprise_ibfk_1` FOREIGN KEY (`id_address`) REFERENCES `endereco` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_address`) REFERENCES `endereco` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`cnpj`) REFERENCES `enterprise` (`cnpj`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
