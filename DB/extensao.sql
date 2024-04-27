-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 27/04/2024 às 13:26
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
-- Banco de dados: `extensao`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `client`
--

CREATE TABLE `client` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(45) NOT NULL,
  `vices_id` int(10) UNSIGNED NOT NULL,
  `clean_days` int(11) DEFAULT NULL,
  `register_day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `client`
--

INSERT INTO `client` (`id`, `name`, `email`, `password`, `vices_id`, `clean_days`, `register_day`) VALUES
(1, 'João da Silva Dias', 'client@gmail.com', '1234', 7, 1, '2024-04-19'),
(5, 'Gabriel Bragatti Stocch', 'gabriel.bragatti@gmail.com', '123456', 4, NULL, '2024-04-13'),
(6, 'Rodrigo Santos', 'rsantos@gmail.com', '123', 1, 1, '2024-04-20'),
(7, 'João Caps Lock', 'joaocaps@gmail.com', '1234', 5, 0, '2024-04-23'),
(8, 'João Miguel', 'jao@gmail.com', '1234', 7, NULL, '2024-04-26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `img` varchar(45) DEFAULT NULL,
  `text` varchar(2000) NOT NULL,
  `vices_id` int(10) UNSIGNED NOT NULL,
  `init_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `fixed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `news`
--

INSERT INTO `news` (`id`, `title`, `img`, `text`, `vices_id`, `init_date`, `end_date`, `fixed`) VALUES
(4, 'Malefícios da maconha', 'images.jpeg', 'Existem os efeitos superficiais e imediatos, associados a sensações momentâneas de prazer. Normalmente, são eles que motivam seus usuários a fazer uso da substância. Mas também há as consequências de longo prazo, que podem comprometer a vida de quem usa a substância, assim como a de todas as pessoas de seu convívio.\r\n\r\nO mais interessante é saber que os mecanismos de prazer da maconha podem ser substituídos por outros alimentos e atividades. Ou seja, existem alternativas para amenizar as dores e as tristezas de quem busca alívio na maconha. Porém, é muito difícil para a pessoa superar esses desafios sozinha. \r\n\r\nAlém disso, a manifestação tardia de alguns problemas dificulta a conscientização. Sem perceber esses efeitos negativos, o usuário pode se render à ideia de que o consumo não traz tantos prejuízos. Por isso, é importante informações sérias sobre o assunto e tomar conhecimento das experiências vividas por outras pessoas.\r\n\r\nCabe destacar, também, que a maconha é lipossolúvel. Ou seja, quando em contato com o corpo, ela se liga às moléculas de gordura responsáveis por diluí-la. Isso colabora para a permanência da substância no sistema nervoso central, o que favorece diversas comorbidades. ', 7, '2024-04-17', '2024-04-19', 1),
(5, 'Malefícios do álcool', 'Bebida-alcoólica.jpg', 'O álcool, substância psicoativa com propriedades que causam dependência, tem sido amplamente utilizado em muitas culturas durante os séculos. Seu uso nocivo tem um grande peso na carga de doenças, além de um ônus social e econômico para as sociedades.  O álcool afeta as pessoas e as sociedades de muitas formas e seus efeitos são determinados pelo volume consumido, pelos padrões de consumo e, em raras ocasiões, pela qualidade do álcool.\r\n\r\nO uso nocivo do álcool também pode resultar em danos a outras pessoas, como membros da família, amigos, colegas de trabalho ou estranhos. Além disso, o uso nocivo de bebidas alcoólicas resulta em um fardo significativo em termos sociais, econômicos e de saúde.  \r\n\r\nO consumo de álcool é um fator causal em mais de 200 doenças e lesões. Está associado ao risco de desenvolvimento de problemas de saúde, tais como distúrbios mentais e comportamentais, incluindo dependência ao álcool, doenças não transmissíveis graves, como cirrose hepática, alguns tipos de câncer e doenças cardiovasculares, bem como lesões resultantes de violência e acidentes de trânsito.  ', 4, '2024-04-18', '2024-04-22', 1),
(10, 'Efeitos do uso da maconha', 'efeitos.jpg', 'Em termos globais, a OMS divulgou dados alarmantes quanto ao panorama da saúde mental. O destaque é a prevalência de ansiedade e depressão no mundo. Segundo a organização, houve um crescimento superior a 25% nas estatísticas dessas doenças no primeiro ano da pandemia.\r\n\r\nAinda que as questões emocionais afetem pessoas com diferentes perfis, um dos públicos mais atingidos são as pessoas que utilizam entorpecentes, como drogas e álcool. Isso ajuda a compreender a relação entre a adição de drogas.', 7, NULL, NULL, 0),
(11, 'Efeitos da maconha: Malefícios', 'mc.jpg', 'O consumo de maconha é uma realidade global, com uma história que remonta a milênios. Atualmente, é uma das drogas mais consumidas no mundo, e a legalização parcial ou total em diversos países tem contribuído para um aumento significativo em seu uso.\r\n\r\nEm muitos lugares, a maconha é percebida como uma substância relativamente inofensiva, mas é preciso ter cautela em sua utilização, pois há dados científicos que indicam o contrário.', 7, NULL, NULL, 0),
(12, 'Maconha: qual a amplitude de seus prejuízos?', NULL, 'A maconha é a droga ilícita mais usada em todo o mundo. O uso da maconha geralmente é intermitente e limitado; no entanto, estima-se que 10% dos que experimentaram maconha tornam-se usuários diários e 20 a 30% a consomem semanalmente. Dados da Austrália mostram que os indivíduos têm iniciado o uso bem mais cedo e a concentração de delta9-tetrahidrocanabinol (THC, principal substância psicoativa presente na maconha) está 30% maior do que há 20 anos atrás.', 7, NULL, NULL, 0),
(13, 'Uso da maconha: entenda os seus riscos e malefícios', NULL, 'Você sabia que tudo o que ingerimos impacta o nosso corpo negativamente ou positivamente? Assim também é com o uso da maconha, muitas vezes vista como algo prazeroso, sendo, na verdade, um perigo.\r\n\r\nEntender os riscos e malefícios do uso dessa droga é uma excelente forma para alcançar um maior conhecimento sobre o assunto e evitar o consumo desse mal.\r\n\r\nQuando falamos sobre os efeitos causados pela maconha, temos o imediato e a longo prazo. O efeito imediato está associado à sensação momentânea de prazer e relaxamento, aliado a “vontade de rir” e a visão de um mundo mais lento. Já as consequências a longo prazo, são aquelas que impactam negativamente a vida do usuário e de todas pessoas a sua volta, muitas vezes irreversíveis.', 7, NULL, NULL, 0),
(14, 'Não existe beber com moderação. Álcool faz mal', 'all.jpg', 'Os efeitos nocivos causados pelo consumo de álcool vêm sendo divulgados de forma cada vez mais contundente, mesmo que ainda sejam publicados artigos que deturpam os achados científicos e tentem associar bebidas alcoólicas a algum benefício ao organismo. Quem nunca ouviu dizer que uma taça de vinho faz bem ao coração, por exemplo? Ou que seria saudável participar de uma corrida de rua e depois beber uma cerveja para hidratar? \r\n\r\nDa mesma forma que aconteceu com o cigarro, na década de 80, chegamos a um ponto em que não se pode dissociar o uso de álcool a prejuízos e sofrimento, incluindo mais de 200 doenças e problemas socioeconômicos, como a violência doméstica, acidentes de trânsito e o desemprego. Seu uso destrói vidas e não há nível seguro para seu consumo, alertam as Organizações Mundial e Pan Americana de Saúde e o Instituto Nacional do Câncer. No entanto, ele continua sendo um produto relativamente barato, pouco taxado em comparação a itens essenciais, como alimentos frescos e orgânicos, sendo que para alguns tipos de bebidas há inclusive isenção fiscal. Outro problema é que sua venda ocorre em todos os lugares, há pouca regulamentação de publicidade e comercialização.', 4, NULL, NULL, 0),
(15, 'Perigos do álcool no corpo humano', 'alcool.jpg', 'Os perigos do álcool ao nosso organismo são vários. Estamos falando de uma substância tóxica e psicoativa com propriedades capazes de causar dependência. Porém, como bebidas alcoólicas fazem parte da rotina social de muitas pessoas em todas as partes do mundo, nem sempre seus efeitos negativos recebem a devida importância.\r\n\r\nSegundo dados da Organização Mundial da Saúde (OMS), o consumo de álcool contribui para três milhões de mortes todos os anos no planeta, além de prejudicar a saúde de milhões', 4, NULL, NULL, 0),
(16, 'Efeitos Colaterais da Cocaína – Sintomas e as Fases da Droga', 'coca.jpeg', 'Os efeitos de quem aspira ou injeta o pó (Cocaína) já é perceptível nos momentos iniciais\r\nao consumo, agindo instantaneamente no corpo humano. Ela afeta principalmente as\r\natividades cerebrais e influencia na capacidade motora e sensorial do corpo de um\r\nmotorista. Isso resulta em sintomas como:\r\n Nervosismo extremo\r\n Delírios,\r\n Insônias,\r\n Alucinações\r\n E constipação. ', 1, NULL, NULL, 1),
(17, 'Droga', NULL, 'Droga', 7, NULL, NULL, 0),
(18, 'Droga ruim', NULL, 'Droga ruim', 7, NULL, NULL, 0),
(19, 'Maconha é ruim', NULL, 'Maconha n é bom n', 7, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `type`
--

CREATE TABLE `type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `type`
--

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Drogas'),
(2, 'Álcool'),
(3, 'Jogos de azar');

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vices`
--

CREATE TABLE `vices` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `vices`
--

INSERT INTO `vices` (`id`, `name`, `type_id`) VALUES
(1, 'Cocaína', 1),
(4, 'Bebidas alcóolicas', 2),
(5, 'Cachaça', 2),
(7, 'Maconha', 1),
(8, 'Cigarro', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_client_vices_idx` (`vices_id`);

--
-- Índices de tabela `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_news_vices1_idx` (`vices_id`);

--
-- Índices de tabela `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vices`
--
ALTER TABLE `vices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vices_type1_idx` (`type_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `client`
--
ALTER TABLE `client`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `type`
--
ALTER TABLE `type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vices`
--
ALTER TABLE `vices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `fk_client_vices` FOREIGN KEY (`vices_id`) REFERENCES `vices` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_news_vices1` FOREIGN KEY (`vices_id`) REFERENCES `vices` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `vices`
--
ALTER TABLE `vices`
  ADD CONSTRAINT `fk_vices_type1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
