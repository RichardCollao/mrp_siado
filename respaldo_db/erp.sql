-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 04, 2017 at 01:47 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id_bill` int(11) NOT NULL,
  `fk_id_purchase_order` int(11) NOT NULL,
  `number` varchar(11) NOT NULL,
  `issue_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `observation` varchar(512) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id_bill`, `fk_id_purchase_order`, `number`, `issue_date`, `created_at`, `observation`, `status`) VALUES
(1, 1, '1', '2017-04-13', '2017-04-13 14:02:27', '', 'correct'),
(2, 6, '100', '2017-07-25', '2017-07-25 22:06:43', '', 'correct');

-- --------------------------------------------------------

--
-- Table structure for table `bills_details`
--

CREATE TABLE `bills_details` (
  `id_bill_detail` int(11) NOT NULL,
  `fk_id_bill` int(11) NOT NULL,
  `fk_id_purchase_order_detail` int(11) NOT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `value` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bills_details`
--

INSERT INTO `bills_details` (`id_bill_detail`, `fk_id_bill`, `fk_id_purchase_order_detail`, `quantity`, `value`) VALUES
(2, 1, 1, '10.0000', '10000.0000'),
(3, 1, 6, '5.0000', '10000.0000'),
(4, 2, 63, '1000.0000', '4.0000');

-- --------------------------------------------------------

--
-- Table structure for table `establishments`
--

CREATE TABLE `establishments` (
  `id_establishment` int(11) NOT NULL,
  `name_business` varchar(128) NOT NULL,
  `rut_business` varchar(10) NOT NULL,
  `address_business` varchar(128) NOT NULL,
  `phone_business` varchar(32) NOT NULL,
  `name` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `phone` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `establishments`
--

INSERT INTO `establishments` (`id_establishment`, `name_business`, `rut_business`, `address_business`, `phone_business`, `name`, `address`, `phone`) VALUES
(1, '', '', '', '', 'main', '', ''),
(2, 'SIGMA CONSTRUCCIONES LIMITADA', '78505870-4', 'AVDA. SANTA MARIA NÂ°2294', '229460400', 'ROMAN DIAZ', 'ROMAN DIAZ #277', '229460400'),
(3, 'constructora Home', '1444444-4', 'santiago', '22222222', 'Parque independencia', 'independencia', '2345454');

-- --------------------------------------------------------

--
-- Table structure for table `expense_accounts`
--

CREATE TABLE `expense_accounts` (
  `id_expense_account` int(11) NOT NULL,
  `fk_id_establishment` int(11) NOT NULL,
  `number` varchar(16) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_accounts`
--

INSERT INTO `expense_accounts` (`id_expense_account`, `fk_id_establishment`, `number`, `name`) VALUES
(2, 2, '50.10.00', 'Admin. Direcc. de Obras\r'),
(3, 2, '501000', 'Direccion de Obra\r'),
(4, 2, '501001', 'Supervision de Terreno\r'),
(5, 2, '501002', 'Topografia\r'),
(6, 2, '50.10.10', 'Administrativos de Obra\r'),
(7, 2, '501010', 'Control de Calidad e Inspeccion '),
(8, 2, '501011', 'Prevencion de Riesgo\r'),
(9, 2, '501012', 'Almacen y Bodega\r'),
(10, 2, '501013', 'Mantencion\r'),
(11, 2, '501014', 'Vigilancia y Aseo\r'),
(12, 2, '501015', 'Alimentacion\r'),
(13, 2, '501016', 'Administracion\r'),
(14, 2, '501017', 'Otros Administrativos\r'),
(15, 2, '501018', 'Servicios\r'),
(16, 2, '501019', 'Mano de Obra Indirecta/General\r'),
(17, 2, '50.10.30', 'Mano de Obra Directa Montaje\r'),
(18, 2, '501030', 'Estructura\r'),
(19, 2, '501031', 'Pipping\r'),
(20, 2, '501032', 'Soldadura\r'),
(21, 2, '501033', 'Mecanica\r'),
(22, 2, '501034', 'Electrica\r'),
(23, 2, '501035', 'Instrumentacion\r'),
(24, 2, '501036', 'Caldera\r'),
(25, 2, '501037', 'Recubrimiento y Aislacion\r'),
(26, 2, '501038', 'Sostenimientos Mineros\r'),
(27, 2, '501039', 'Desarrollos Mineros\r'),
(28, 2, '50.10.50', 'Mano de Obra Directa Obras Civiles'),
(29, 2, '501050', 'Enfierradura\r'),
(30, 2, '501051', 'Jornales Directos\r'),
(31, 2, '501052', 'Sueldo Operador\r'),
(32, 2, '501053', 'AlbaÃ±ileria'),
(33, 2, '501054', 'Carpinteria\r'),
(34, 2, '501055', 'Carpinteria Metalica\r'),
(35, 2, '501056', 'Pintura\r'),
(36, 2, '501057', 'Gasfiteria\r'),
(37, 2, '501058', 'Insertos\r'),
(38, 2, '501059', 'Terminaciones\r'),
(39, 2, '501060', 'Movimiento de Tierras\r'),
(40, 2, '501061', 'Hormigon\r'),
(41, 2, '501062', 'Moldaje\r'),
(42, 2, '501063', 'Otras Civil\r'),
(43, 2, '501064', 'Mano de Obra Directa /General\r'),
(44, 2, '50.10.70', 'Mano de Obra Directa Operacion'),
(45, 2, '501070', 'Remuneraciones x Adm. Op. Equipo'),
(46, 2, '501071', 'Remuneraciones x Operacion de Eq'),
(47, 2, '50.10.80', 'Beneficios y Gtos. en Personal\r'),
(48, 2, '501080', 'Ropa y Equipo de Trabajo\r'),
(49, 2, '501081', 'Movilizacion del Personal de Obr'),
(50, 2, '501082', 'Exames Medicos\r'),
(51, 2, '501083', 'Eventos y Recreacion en Obras\r'),
(52, 2, '501084', 'Otros Gastos Y Beneficios\r'),
(53, 2, '501085', 'Gasto en Capacitacion\r'),
(54, 2, '501086', 'Alimentacion\r'),
(55, 2, '501087', 'Seguro de Vida\r'),
(56, 2, '501088', 'Complementario Salud\r'),
(57, 2, '501089', 'Seguro Dental\r'),
(58, 2, '501090', 'Selecci'),
(59, 2, '50.11.00', 'Insumos para Mano de Obra\r'),
(60, 2, '501100', 'Articulos de seguridad industria'),
(61, 2, '501101', 'Articulos de seguridad personal\r'),
(62, 2, '501102', 'Herramienta Menor\r'),
(63, 2, '501103', 'Elementos de Higiene\r'),
(64, 2, '501104', 'Gases\r'),
(65, 2, '501105', 'Soldaduras\r'),
(66, 2, '501106', 'Herramienta manual\r'),
(67, 2, '501107', 'Herramienta electrica\r'),
(68, 2, '50.20.00', 'Hormigon Morteros\r'),
(69, 2, '502000', 'Aridos\r'),
(70, 2, '502001', 'Cemento\r'),
(71, 2, '502002', 'Hormigon\r'),
(72, 2, '502003', 'Aditivos, Separadores y Desmol\r'),
(73, 2, '502004', 'Estucos - Morteros\r'),
(74, 2, '502005', 'Grout - Cal - Yeso - T. Color\r'),
(75, 2, '502006', 'Prefabricados de Hormigon\r'),
(76, 2, '502007', 'Ladrillos y Bloques\r'),
(77, 2, '502008', 'Moldajes\r'),
(78, 2, '502009', 'Enchape\r'),
(79, 2, '502010', 'Grout y Resinas Ep'),
(80, 2, '502011', 'Otros para Hormigon\r'),
(81, 2, '502012', 'Otros Hormigon\r'),
(82, 2, '50.20.20', 'Refuerzos de Hormig'),
(83, 2, '502020', 'Acero A44\r'),
(84, 2, '502021', 'Acero A63\r'),
(85, 2, '502022', 'Acero alta resistencia\r'),
(86, 2, '502023', 'Mallas Electrosoldadas\r'),
(87, 2, '502024', 'Otros Refuerzos de Hormigon\r'),
(88, 2, '50.20.30', 'Pernos, Insertos, Clavos y Fijaciones'),
(89, 2, '502030', 'Pernos, Tuercas y Golillas\r'),
(90, 2, '502031', 'Abrazaderas\r'),
(91, 2, '502032', 'Tornillos\r'),
(92, 2, '502033', 'Elementos de Anclajes\r'),
(93, 2, '502034', 'Insertos\r'),
(94, 2, '502035', 'Pernos Anclaje\r'),
(95, 2, '502036', 'Fijaciones y Tarugos\r'),
(96, 2, '502037', 'Clavos, Puntas y Grapas\r'),
(97, 2, '502038', 'Alambres\r'),
(98, 2, '502039', 'Insumos para Herramientas y Ferreteria'),
(99, 2, '502040', 'Otros Pernos Insertos clavos y f'),
(100, 2, '50.20.50', 'Aceros y Cables\r'),
(101, 2, '502050', 'Acero en Perfiles y Barras Lis\r'),
(102, 2, '502051', 'Parrillas de Acero\r'),
(103, 2, '502052', 'Planchas de Acero\r'),
(104, 2, '502053', 'Ferreteria'),
(105, 2, '502054', 'Cables de Acero, Cadenas\r'),
(106, 2, '502055', 'Mallas de Cercos\r'),
(107, 2, '502056', 'Soldadura\r'),
(108, 2, '502057', 'Gases\r'),
(109, 2, '502058', 'Otras Estructuras Acero y Cables'),
(110, 2, '502059', 'Plancha para Losa Colaborante\r'),
(111, 2, '502060', 'Perfiles Metalcon\r'),
(112, 2, '502061', 'Barandas\r'),
(113, 2, '502062', 'Escalas de Acero\r'),
(114, 2, '50.20.70', 'Metales\r'),
(115, 2, '502070', 'Aluminio\r'),
(116, 2, '502071', 'Cobre\r'),
(117, 2, '502072', 'Otros Metales\r'),
(118, 2, '50.20.80', 'Maderas\r'),
(119, 2, '502080', 'Maderas en Bruto\r'),
(120, 2, '502081', 'Maderas Elaboradas\r'),
(121, 2, '502082', 'Maderas Aglomeradas\r'),
(122, 2, '502083', 'Elementos Estructurales de Mader'),
(123, 2, '502084', 'Otras Maderas\r'),
(124, 2, '50.20.90', 'CaÃ±erias'),
(125, 2, '502090', 'CaÃ±. y Fitting Acero Carbo'),
(126, 2, '502091', 'CaÃ±. y Fitting Acero Inoxi'),
(127, 2, '502092', 'CaÃ±. y Fitting Cobre - Bro'),
(128, 2, '502093', 'CaÃ±. y Fitting PVC'),
(129, 2, '502094', 'CaÃ±. y Fitting FRP'),
(130, 2, '502095', 'Fitting Fe Fdo.\r'),
(131, 2, '502096', 'CaÃ±erias Otros Tipos'),
(132, 2, '502097', 'Valvulas y Medidores\r'),
(133, 2, '502098', 'Otras CaÃ±erias'),
(134, 2, '50.21.10', 'Electricos e Instrumentacion'),
(135, 2, '502110', 'Cables y Alambres\r'),
(136, 2, '502111', 'Canalizaciones\r'),
(137, 2, '502112', 'Tableros, Interruptores y Ench\r'),
(138, 2, '502113', 'Gabinetes, Trafos y Equipos\r'),
(139, 2, '502114', 'Equipos Iluminacion\r'),
(140, 2, '502115', 'Instrumentos\r'),
(141, 2, '502116', 'Soportacion\r'),
(142, 2, '502117', 'Ferreteria Electrica\r'),
(143, 2, '502118', 'Insumos de Comunicacion\r'),
(144, 2, '502119', 'Otros Electricos e Instrum.\r'),
(145, 2, '502120', 'Cables de Fuerza\r'),
(146, 2, '502121', 'Cables de instrumentaci'),
(147, 2, '502122', 'Cables de alumbrado\r'),
(148, 2, '502123', 'Cables de comunicaci'),
(149, 2, '502124', 'Cables de Cu desnudo\r'),
(150, 2, '502125', 'Escalerillas\r'),
(151, 2, '502126', 'Bandejas lisa y ranurada\r'),
(152, 2, '502127', 'Bandejas, clip y accesorios\r'),
(153, 2, '502128', 'Conduits galvanizados\r'),
(154, 2, '502129', 'Conduit PVC\r'),
(155, 2, '502130', 'Tuber'),
(156, 2, '502131', 'Tubing proceso\r'),
(157, 2, '502132', 'Tubing neumatico\r'),
(158, 2, '502133', 'Cajas de paso\r'),
(159, 2, '502134', 'Tableros de fuerza\r'),
(160, 2, '502135', 'Tableros de alumbrado\r'),
(161, 2, '502136', 'Tableros de Instrumentaci'),
(162, 2, '502137', 'Cajas junti'),
(163, 2, '502138', 'Interruptores\r'),
(164, 2, '502139', 'Enchufes legrand\r'),
(165, 2, '502140', 'Enchufes normales\r'),
(166, 2, '502141', 'Instrumentos el'),
(167, 2, '502142', 'Instrumentos de control y proces'),
(168, 2, '502143', 'Soporte escalerillas y bandejas\r'),
(169, 2, '502144', 'Soporte equipos y tableros\r'),
(170, 2, '502145', 'Soporte conduits\r'),
(171, 2, '502146', 'Soportes de instrumentaci'),
(172, 2, '502147', 'Moldes y cargas de termofusi'),
(173, 2, '502148', 'Postes\r'),
(174, 2, '502149', 'Fungibles el'),
(175, 2, '502150', 'Fitting de instrumentaci'),
(176, 2, '502151', 'Fitting de instrumentaci'),
(177, 2, '502152', 'Mediciones el'),
(178, 2, '502153', 'Mediciones instrumentaci'),
(179, 2, '50.21.60', 'Cubiertas, Cielos y Revestimientos'),
(180, 2, '502160', 'Techumbres\r'),
(181, 2, '502161', 'Revestimientos Metalicos\r'),
(182, 2, '502162', 'Revestimientos Traslucidos\r'),
(183, 2, '502163', 'Revestimientos Vinyl Siding\r'),
(184, 2, '502164', 'Hojalateria\r'),
(185, 2, '502165', 'Ceramica'),
(186, 2, '502166', 'Granitos y Piedra\r'),
(187, 2, '502167', 'Alfombras, Cubrepisos, Fexit\r'),
(188, 2, '502168', 'Piso Flotante\r'),
(189, 2, '502169', 'Paneles, Frigorificos\r'),
(190, 2, '502170', 'Tabiques\r'),
(191, 2, '502171', 'Revestimientos Tabiques\r'),
(192, 2, '502172', 'Aislaci'),
(193, 2, '502173', 'Cielos falsos\r'),
(194, 2, '502174', 'Planchas Yeso Carton, Volcanita\r'),
(195, 2, '502175', 'Planchas Fibrocemento\r'),
(196, 2, '502176', 'Cintas y Pasta para Junturas\r'),
(197, 2, '502177', 'Otros Trechumbres cielos y reves'),
(198, 2, '50.21.80', 'Pinturas, Protecciones, Aislaciones'),
(199, 2, '502180', 'Pinturas y Pastas\r'),
(200, 2, '502181', 'Impermeabilizantes Superficial\r'),
(201, 2, '502182', 'Protecciones Ataques Quimicos\r'),
(202, 2, '502183', 'Refractarios\r'),
(203, 2, '502184', 'Proteccion Antifuego\r'),
(204, 2, '502185', 'Pegamentos y Adhesivos\r'),
(205, 2, '502186', 'Otras Pinturas, Protecciones, Ai'),
(206, 2, '50.21.90', 'Puertas, Portones y Ventanas\r'),
(207, 2, '502190', 'Puertas de Madera\r'),
(208, 2, '502191', 'Puertas Metalicas\r'),
(209, 2, '502192', 'Marcos\r'),
(210, 2, '502193', 'Portones\r'),
(211, 2, '502194', 'Ventanas\r'),
(212, 2, '502195', 'Vidrios Cristales y Espejos\r'),
(213, 2, '502196', 'Celosias\r'),
(214, 2, '502197', 'Quincalleria\r'),
(215, 2, '502198', 'Cerrajeria Artistica\r'),
(216, 2, '502199', 'Persianas y Cortinas\r'),
(217, 2, '502200', 'Escalera Madera\r'),
(218, 2, '502201', 'Otras Puertas, Portones y Ventan'),
(219, 2, '502202', 'Guardapolvos\r'),
(220, 2, '502203', 'Junquillos\r'),
(221, 2, '502204', 'Cornisas\r'),
(222, 2, '502205', 'Pilastras\r'),
(223, 2, '502206', 'Cortagotera\r'),
(224, 2, '502207', 'Numeros\r'),
(225, 2, '502208', 'Juntas de Dilatacion\r'),
(226, 2, '50.22.10', 'Sanitarios, Calefont y Caldera\r'),
(227, 2, '502210', 'Artefactos Sanitarios y accesorios'),
(228, 2, '502211', 'Tinas e hidromaajes\r'),
(229, 2, '502212', 'Lavamanos y Pedestales\r'),
(230, 2, '502213', 'Salas de BaÃ±o'),
(231, 2, '502214', 'Griferia\r'),
(232, 2, '502215', 'Termos, Calefont, Calderas\r'),
(233, 2, '502216', 'Plantas de Tratamientos\r'),
(234, 2, '50.22.20', 'Muebles\r'),
(235, 2, '502220', 'Cocina\r'),
(236, 2, '502221', 'Oficina\r'),
(237, 2, '502222', 'Closet\r'),
(238, 2, '502223', 'BaÃ±os'),
(239, 2, '502224', 'Otros Muebles\r'),
(240, 2, '50.22.30', 'Ventilacion y climatizacion'),
(241, 2, '502230', 'Ventiladores\r'),
(242, 2, '502231', 'Campana\r'),
(243, 2, '502232', 'Climatizacion\r'),
(244, 2, '502233', 'Ductos\r'),
(245, 2, '502234', 'Otros Ventilacion y Climatizacio'),
(246, 2, '50.22.40', 'Movimientos de Tierra y Urbanizacion'),
(247, 2, '502240', 'Materiales Relleno\r'),
(248, 2, '502241', 'Retiro de Excedentes\r'),
(249, 2, '502242', 'Enrocados\r'),
(250, 2, '502243', 'Explosivos\r'),
(251, 2, '502244', 'Asfalto\r'),
(252, 2, '502245', 'SeÃ±alizacion'),
(253, 2, '502246', 'Jardineria y Paisajismo\r'),
(254, 2, '502247', 'Juegos\r'),
(255, 2, '502248', 'Rellenos y Movimientos de Tierra'),
(256, 2, '502249', 'Membranas y Geotextiles\r'),
(257, 2, '502250', 'Otros Mov. de Tierra y Urbanizac'),
(258, 2, '50.22.60', 'Estanques\r'),
(259, 2, '502260', 'Acero\r'),
(260, 2, '502261', 'Hormigon\r'),
(261, 2, '502262', 'FRP\r'),
(262, 2, '502263', 'Otros Estanques\r'),
(263, 2, '50.22.70', 'Equipos Mecanicos'),
(264, 2, '502270', 'Bombas\r'),
(265, 2, '502271', 'Precipitadores\r'),
(266, 2, '502272', 'Filtros\r'),
(267, 2, '502273', 'Generadores\r'),
(268, 2, '502274', 'Puentes Gruas\r'),
(269, 2, '502275', 'Otros Equipos Mecanicos\r'),
(270, 2, '50.22.80', 'Ensayos Laboratorios\r'),
(271, 2, '502280', 'Suelos\r'),
(272, 2, '502281', 'Hormigones\r'),
(273, 2, '502282', 'Radiograf'),
(274, 2, '502283', 'Adherencia\r'),
(275, 2, '502284', 'Materiales\r'),
(276, 2, '502285', 'Otros Ensayos\r'),
(277, 2, '50.22.90', 'Otros\r'),
(278, 2, '502290', 'Costos Gesti'),
(279, 2, '502291', 'Instalacion de Faenas\r'),
(280, 2, '502292', 'Reposicion Urbanizacion\r'),
(281, 2, '502293', 'Empalmes Electricos\r'),
(282, 2, '50.30.00', 'Costos Fletes Equipos\r'),
(283, 2, '503000', 'Flete de Equipos\r'),
(284, 2, '503001', 'Flete a Obras\r'),
(285, 2, '503002', 'Flete interno\r'),
(286, 2, '503003', 'Flete a Instalacion Faena\r'),
(287, 2, '503004', 'Permisos y otros\r'),
(288, 2, '50.30.10', 'Costos Equipos Arrendados\r'),
(289, 2, '503010', 'Arriendo de Equipos Menores\r'),
(290, 2, '503011', 'Arriendo de Vehiculos Motorizado'),
(291, 2, '503012', 'Arriendo de Moldajes\r'),
(292, 2, '503013', 'Arriendo de Andamios\r'),
(293, 2, '503014', 'Arriendo de Equipos Mayores\r'),
(294, 2, '503015', 'Arriendo de Otros Equipos\r'),
(295, 2, '503016', 'Arriendo Camiones Pluma\r'),
(296, 2, '503017', 'Arriendo Camiones\r'),
(297, 2, '503018', 'Arriendo Gr'),
(298, 2, '503019', 'Arriendo Torres Iluminaci'),
(299, 2, '503020', 'Arriendos BaÃ±os Quimicos'),
(300, 2, '503021', 'Arriendo Equipos Topograficos\r'),
(301, 2, '503022', 'Arriendo Equipos de Soldar\r'),
(302, 2, '503023', 'Arriendo Equipos de Compactaci'),
(303, 2, '503024', 'Arriendo Equipo de Levante\r'),
(304, 2, '503025', 'Arriendo Equipos de Torqueo e Im'),
(305, 2, '503026', 'Arriendo Equipo de Hormigonado\r'),
(306, 2, '503027', 'Arriendo Contenedores\r'),
(307, 2, '503028', 'Arriendo de Vehiculos Motorizado'),
(308, 2, '503029', 'Arriendo Gr'),
(309, 2, '503030', 'Arriendo Gr'),
(310, 2, '503031', 'Arriendo Manipulador Telescopico'),
(311, 2, '503032', 'Arriendo Gr'),
(312, 2, '503033', 'Arriendo Gr'),
(313, 2, '503034', 'Arriendo Minicargadores\r'),
(314, 2, '503035', 'Arriendo Retroecavadoras\r'),
(315, 2, '503036', 'Arriendo Excavadoras\r'),
(316, 2, '503037', 'Arriendo Tractor\r'),
(317, 2, '503038', 'Arriendo Motoniveladora\r'),
(318, 2, '503039', 'Arriendo Camiones Bomba\r'),
(319, 2, '503040', 'Arriendo Cargador Frontal\r'),
(320, 2, '503041', 'Arriendo Plataformas\r'),
(321, 2, '503042', 'Arriendo Generadores\r'),
(322, 2, '503043', 'Arriendo Compresores\r'),
(323, 2, '503044', 'Arriendo de Otros Equipos Mayore'),
(324, 2, '503045', 'Arriendos Equipos de Comunicacio'),
(325, 2, '50.30.60', 'Gastos en Equipos\r'),
(326, 2, '503060', 'Reparacion\r'),
(327, 2, '503061', 'Repuestos\r'),
(328, 2, '503062', 'Servicio de Reparacion\r'),
(329, 2, '503063', 'Neumaticos\r'),
(330, 2, '503064', 'Cables\r'),
(331, 2, '503065', 'Mantencion\r'),
(332, 2, '503066', 'Insumos de Mantencion\r'),
(333, 2, '503067', 'Servicios de Mantencion\r'),
(334, 2, '503068', 'Lubricantes y Grasas\r'),
(335, 2, '503069', 'Filtros\r'),
(336, 2, '503070', 'Insumo de Aseo\r'),
(337, 2, '503071', 'Productos Quimicos\r'),
(338, 2, '503072', 'Seguros\r'),
(339, 2, '503073', 'Patentes y Otros\r'),
(340, 2, '503074', 'Pinturas-EQ\r'),
(341, 2, '503075', 'Certificaci'),
(342, 2, '503076', 'Varios\r'),
(343, 2, '503077', 'Arriendo Equipos de Rotaci'),
(344, 2, '50.30.80', 'Gastos Equipos Refacturables\r'),
(345, 2, '503080', 'Compra de herramientas\r'),
(346, 2, '503081', 'Reparacion refacturable\r'),
(347, 2, '503082', 'Insumos refacturable\r'),
(348, 2, '503083', 'Otros refacturables\r'),
(349, 2, '503084', 'Compra de equipos menores\r'),
(350, 2, '50.50.00', 'SubContratos Especializados\r'),
(351, 2, '505000', 'Subcontrato Movimiento de tierra'),
(352, 2, '505001', 'Subcontrato Enfierradura\r'),
(353, 2, '505002', 'Subcontrato Moldajes\r'),
(354, 2, '505003', 'Subcontrato Hormigon\r'),
(355, 2, '505004', 'Subcontrato Impermeabilizaciones'),
(356, 2, '505005', 'Subcontrato Estructura Metalica\r'),
(357, 2, '505006', 'Subcontrato AlbaÃ±ileria y estuco'),
(358, 2, '505007', 'Subcontrato Piping\r'),
(359, 2, '505008', 'Subcontrato Montaje Mec'),
(360, 2, '505009', 'Subcontrato Hojalater'),
(361, 2, '505010', 'Subcontrato Cubiertas y Revestim'),
(362, 2, '505011', 'Subcontrato Instalaciones Electr'),
(363, 2, '505012', 'Subcontrato C.Debiles\r'),
(364, 2, '505013', 'Subcontrato Tabiques\r'),
(365, 2, '505014', 'Subcontrato Revestimientos Muros'),
(366, 2, '505015', 'Subcontrato Pintura\r'),
(367, 2, '505016', 'Subcontrato Yeso\r'),
(368, 2, '505017', 'Subcontrato Cielos\r'),
(369, 2, '505018', 'Subcontrato Puertas, Portones y '),
(370, 2, '505019', 'Subcontrato Ventanas, Vidrios y '),
(371, 2, '505020', 'Subcontratos Instalaciones Sanit'),
(372, 2, '505021', 'Subcontratos Instalaciones Sanit'),
(373, 2, '505022', 'Subcontrato Areas Verdes\r'),
(374, 2, '505023', 'Subcontrato Muebles Persianas Co'),
(375, 2, '505024', 'Subcontrato Climatizaci'),
(376, 2, '505025', 'Subcontrato Red incendio\r'),
(377, 2, '505026', 'Subcontrato Pavimentos\r'),
(378, 2, '505027', 'Subcontrato Agua Potable\r'),
(379, 2, '505028', 'Subcontrato Alcantarillado\r'),
(380, 2, '505029', 'Subcontrato Gas\r'),
(381, 2, '505030', 'Subcontrato SeÃ±alizacion'),
(382, 2, '505031', 'Subcontrato Juegos\r'),
(383, 2, '505032', 'Subcontrato Sistemas de Segurida'),
(384, 2, '505033', 'Subcontrato Demoliciones\r'),
(385, 2, '505034', 'Subcontrato Sala de Basura\r'),
(386, 2, '505035', 'Subcontrato Ascensores, Montacar'),
(387, 2, '505036', 'Subcontrato Piscina\r'),
(388, 2, '505037', 'Subcontrato Instalaciones Especi'),
(389, 2, '505038', 'Subcontrato Reparaciones\r'),
(390, 2, '505039', 'Subcontrato Aseo\r'),
(391, 2, '505040', 'Subcontrato Certificacion SEC\r'),
(392, 2, '505041', 'Subcontrato Obras Civiles\r'),
(393, 2, '505042', 'Subcontratos Especializados\r'),
(394, 2, '505043', 'Subcontrato Prefabricado de Horm'),
(395, 2, '505044', 'Subcontrato de Enchape\r'),
(396, 2, '505045', 'Subcontrato Alfombra, cubrepiso,'),
(397, 2, '505046', 'Subcontrato Piso Flotante\r'),
(398, 2, '505047', 'Subcontrato Instalaciones de urb'),
(399, 2, '505048', 'Subcontrato Moldura, Guardapolvo'),
(400, 2, '505049', 'Subcontrato de Tierra de Urbaniz'),
(401, 2, '505050', 'Subcontrato Pavimento, Ceramica,'),
(402, 2, '505051', 'Subcontrato pavimento de Urbaniz'),
(403, 2, '505052', 'Subcontrato Revestimiento Papel '),
(404, 2, '505053', 'Subcontrato Revestimiento Cerami'),
(405, 2, '505054', 'Subcontrato Otras Cubiertas\r'),
(406, 2, '505055', 'Subcontratos Varios\r'),
(407, 2, '50.50.70', 'Costos Contrato Ingenieria o especialidad'),
(408, 2, '505070', 'Proyecto electricidad y corrient'),
(409, 2, '505071', 'Proyecto de alta tension\r'),
(410, 2, '505072', 'Proyecto estructural\r'),
(411, 2, '505073', 'Proyecto agua potable, gas y alc'),
(412, 2, '505074', 'Proyecto de pavimentacion, aguas'),
(413, 2, '505075', 'Proyecto de climatizacion\r'),
(414, 2, '505076', 'Proyecto de seguridad e instrucc'),
(415, 2, '505077', 'Proyecto de deteccion y extincio'),
(416, 2, '505078', 'Proyecto de camaras de frio\r'),
(417, 2, '505079', 'Proyecto de paisajismo\r'),
(418, 2, '505080', 'Proyecto de riesgos\r'),
(419, 2, '50.50.90', 'Honorarios y Asesorias'),
(420, 2, '505090', 'Honorarios\r'),
(421, 2, '505091', 'Asesoria legal laboral\r'),
(422, 2, '505092', 'Asesoria externa\r'),
(423, 2, '505093', 'Asesoria tecnica de obra\r'),
(424, 2, '505094', 'Inspecciones (EMOS, ESVAL, otras'),
(425, 2, '505095', 'Asesoria en Estudio de Contrato '),
(426, 2, '505096', 'Asesor'),
(427, 2, '505097', 'Juicios Civiles Laborales Obra\r'),
(428, 2, '505098', 'Juicios Criminales Laborales de '),
(429, 2, '505099', 'Juicios Civiles de Obra\r'),
(430, 2, '505100', 'Juicios Criminales de Obra\r'),
(431, 2, '505101', 'Asesor'),
(432, 2, '505102', 'Asesor'),
(433, 2, '505103', 'Asesorias Varias no Clasificadas'),
(434, 2, '505104', 'Honorarios y Asesorias Otros\r'),
(435, 2, '50.60.00', 'Servicios Basicos'),
(436, 2, '506000', 'Agua Obras\r'),
(437, 2, '506001', 'Gas Obras\r'),
(438, 2, '506002', 'Electricidad Obras\r'),
(439, 2, '506003', 'Aseo en Obras\r'),
(440, 2, '506004', 'Vigilancia\r'),
(441, 2, '506005', 'Correos y Valijas de Obra\r'),
(442, 2, '506006', 'Otros Servicios B'),
(443, 2, '50.60.20', 'Insumos Oficina\r'),
(444, 2, '506020', 'Fotocopias\r'),
(445, 2, '506021', 'Libreria'),
(446, 2, '506022', 'Insumos Oficina Obras\r'),
(447, 2, '506023', 'Insumos Computacionales\r'),
(448, 2, '50.60.30', 'Arriendos\r'),
(449, 2, '506030', 'Arriendo Bienes Inmuebles Obras\r'),
(450, 2, '506031', 'Arriendos Bienes muebles\r'),
(451, 2, '506032', 'Arriendos Equipos Computacionale'),
(452, 2, '506033', 'Arriendos Varios\r'),
(453, 2, '50.60.40', 'Comunicaciones\r'),
(454, 2, '506040', 'Telefono Obras\r'),
(455, 2, '506041', 'Celulares en Obras\r'),
(456, 2, '506042', 'Enlaces Computacionales\r'),
(457, 2, '506043', 'Larga Distancia (Nacional e Inte'),
(458, 2, '506044', 'Otros Gastos de Comunicaciones\r'),
(459, 2, '50.60.50', 'Seguros\r'),
(460, 2, '506050', 'Seguros Riesgos de Ingenier'),
(461, 2, '506051', 'Seguro-Robo Con Fuerza\r'),
(462, 2, '506052', 'Seguro por Incendioy/oTerremotos'),
(463, 2, '506053', 'Seguro Responsabilidad Civil\r'),
(464, 2, '506054', 'Seguro Todo Riesgo Construccion\r'),
(465, 2, '506055', 'Indemnizacion Seguros Obras\r'),
(466, 2, '50.60.60', 'Combustibles\r'),
(467, 2, '506060', 'Petroleo\r'),
(468, 2, '506061', 'Bencina\r'),
(469, 2, '506062', 'Lubricantes\r'),
(470, 2, '506063', 'Gas\r'),
(471, 2, '506064', 'Impto Especifico Petroleo\r'),
(472, 2, '50.60.70', 'Licencias y Tramites'),
(473, 2, '506070', 'Partes y Multas Varias\r'),
(474, 2, '506071', 'Patentes, Contribuciones, Permis'),
(475, 2, '50.60.80', 'Viajes y Estadias'),
(476, 2, '506080', 'Pasajes Aereos y Traslados Terre'),
(477, 2, '506081', 'Alojamiento y Aliment. por Viaje'),
(478, 2, '50.60.90', 'Otros Gastos Generales\r'),
(479, 2, '506090', 'Rendicion Fondo Fijo Obra\r'),
(480, 2, '506091', 'Servicio Pago de Remuneraciones\r'),
(481, 2, '506092', 'Articulo de Seguridad General\r'),
(482, 2, '506093', 'Suscrip. y Cuotas Sociales\r'),
(483, 2, '506094', 'Fletes en Obra\r'),
(484, 2, '506095', 'Equipos Mobiliario de Oficina\r'),
(485, 2, '506096', 'Publicidad Letreros Obras\r'),
(486, 2, '506097', 'Mantencion Maq y Equipos Computa'),
(487, 2, '506098', 'Extracci'),
(488, 2, '506099', 'Intereses Boletas de Garantia\r'),
(489, 2, '506100', 'Tijerales\r'),
(490, 2, '506101', 'Visitas Obras\r'),
(491, 2, '506102', 'Gastos de Obras en Termino\r'),
(492, 2, '506105', 'Provisi'),
(493, 2, '506106', 'Obra Adicional Interna/Tipo1-Urb'),
(494, 2, '506107', 'Amortizaci'),
(495, 2, '506108', 'Gastos Financieros\r'),
(496, 2, '506109', 'Clientes incobrables\r'),
(497, 2, '506110', 'Peaje con telev'),
(498, 2, '506111', 'Intereses y Gastos Boletas Garan'),
(499, 2, '506112', 'INTERESES FINANCIAMIENTO OBRA\r'),
(500, 2, '506113', 'Postventa\r'),
(501, 2, '506114', 'Otros\r'),
(502, 2, '506115', 'Cuenta de Paso\r'),
(503, 2, '60.00.00', 'Ingresos por Estados de Pago\r'),
(504, 2, '600000', 'Cobro Anticipos\r'),
(505, 2, '600001', 'Fact. Avance\r'),
(506, 2, '600002', 'Dev. Anticipos\r'),
(507, 2, '600003', 'Retenciones\r'),
(508, 2, '600004', 'Cobro Retenciones\r'),
(509, 3, '100100', 'Ferreteria');

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `id_guide` int(11) NOT NULL,
  `fk_id_purchase_order` int(11) NOT NULL,
  `fk_id_bill` int(11) DEFAULT NULL,
  `number` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `observation` varchar(512) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`id_guide`, `fk_id_purchase_order`, `fk_id_bill`, `number`, `issue_date`, `created_at`, `observation`, `status`) VALUES
(2, 1, 1, 95741, '2017-02-15', '2017-04-11 21:02:03', '', 'correct'),
(3, 1, NULL, 95738, '2017-02-15', '2017-04-11 22:19:26', '', 'correct'),
(4, 1, NULL, 95740, '2017-02-15', '2017-04-11 22:18:29', '', 'correct'),
(5, 1, NULL, 98974, '2017-03-15', '2017-04-11 22:14:39', '', 'correct'),
(6, 1, NULL, 98972, '2017-03-15', '2017-04-11 22:30:29', '', 'correct'),
(7, 1, NULL, 98971, '2017-03-15', '2017-04-11 22:30:42', '', 'correct'),
(8, 1, NULL, 98973, '2017-03-15', '2017-04-11 22:30:04', '', 'correct'),
(9, 3, NULL, 582524, '2017-03-20', '2017-04-12 22:19:55', '', 'correct'),
(10, 3, NULL, 581334, '2017-03-15', '2017-04-12 22:19:09', '', 'correct'),
(11, 3, NULL, 584898, '2017-03-27', '2017-04-12 22:17:02', '', 'correct'),
(12, 3, NULL, 576379, '2017-02-23', '2017-04-12 22:20:48', '', 'correct'),
(13, 3, NULL, 581009, '2017-03-14', '2017-04-12 22:22:59', '', 'correct'),
(14, 4, NULL, 135843, '2017-02-17', '2017-04-12 23:42:18', '', 'correct'),
(15, 4, NULL, 135936, '2017-02-20', '2017-09-04 23:37:09', '', 'correct'),
(16, 6, 2, 1, '2017-07-25', '2017-07-25 22:07:49', '', 'correct'),
(17, 15, NULL, 139422, '2017-09-06', '2017-09-06 16:20:32', '', 'correct'),
(18, 15, NULL, 140253, '2017-09-06', '2017-09-06 16:21:28', '', 'correct');

-- --------------------------------------------------------

--
-- Table structure for table `guides_details`
--

CREATE TABLE `guides_details` (
  `id_guide_detail` int(11) NOT NULL,
  `fk_id_guide` int(11) NOT NULL,
  `fk_id_purchase_order_detail` int(11) NOT NULL,
  `quantity` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guides_details`
--

INSERT INTO `guides_details` (`id_guide_detail`, `fk_id_guide`, `fk_id_purchase_order_detail`, `quantity`) VALUES
(2, 2, 16, '1.0000'),
(3, 2, 17, '1.0000'),
(4, 2, 18, '1.0000'),
(5, 2, 19, '1.0000'),
(6, 3, 8, '1.0000'),
(7, 3, 4, '1.0000'),
(8, 3, 20, '1.0000'),
(9, 3, 24, '1.0000'),
(10, 3, 29, '2.0000'),
(11, 3, 1, '1.0000'),
(12, 3, 3, '1.0000'),
(13, 3, 28, '1.0000'),
(14, 3, 49, '10.0000'),
(15, 3, 5, '1.0000'),
(16, 3, 21, '1.0000'),
(17, 3, 22, '2.0000'),
(18, 4, 23, '1.0000'),
(19, 4, 25, '2.0000'),
(20, 4, 26, '1.0000'),
(21, 4, 27, '1.0000'),
(22, 4, 13, '1.0000'),
(23, 4, 30, '1.0000'),
(24, 5, 16, '19.0000'),
(25, 5, 17, '19.0000'),
(26, 5, 4, '15.0000'),
(27, 5, 5, '15.0000'),
(28, 6, 20, '28.0000'),
(29, 6, 24, '32.0000'),
(30, 6, 21, '28.0000'),
(31, 6, 22, '57.0000'),
(32, 6, 23, '18.0000'),
(33, 6, 25, '65.0000'),
(34, 6, 26, '31.0000'),
(35, 6, 27, '30.0000'),
(36, 7, 8, '10.0000'),
(37, 7, 9, '10.0000'),
(38, 7, 10, '4.0000'),
(39, 7, 11, '28.0000'),
(40, 7, 13, '28.0000'),
(41, 8, 14, '1.0000'),
(42, 8, 6, '28.0000'),
(43, 8, 19, '20.0000'),
(46, 8, 29, '49.0000'),
(47, 8, 18, '20.0000'),
(48, 8, 1, '28.0000'),
(49, 8, 3, '28.0000'),
(50, 8, 28, '20.0000'),
(51, 8, 31, '9.0000'),
(52, 8, 7, '28.0000'),
(53, 8, 33, '10.0000'),
(54, 8, 30, '11.0000'),
(55, 9, 41, '1620.0000'),
(56, 9, 44, '264.0000'),
(57, 10, 46, '642.2400'),
(58, 10, 43, '102.2400'),
(59, 11, 42, '549.1200'),
(60, 11, 45, '24.7000'),
(61, 12, 43, '5.7600'),
(62, 12, 42, '19.3600'),
(63, 12, 41, '72.0000'),
(64, 13, 46, '20.1600'),
(65, 14, 50, '2.0000'),
(66, 14, 49, '2.0000'),
(67, 14, 51, '2.0000'),
(68, 14, 53, '1.0000'),
(69, 14, 55, '1.0000'),
(70, 14, 56, '1.0000'),
(71, 14, 59, '1.0000'),
(72, 15, 61, '1.0000'),
(73, 16, 63, '1000.0000'),
(74, 17, 93, '230.4000'),
(75, 17, 94, '230.4000'),
(76, 18, 92, '240.0000');

-- --------------------------------------------------------

--
-- Table structure for table `hash_security`
--

CREATE TABLE `hash_security` (
  `fk_id_user` int(11) NOT NULL,
  `operation` varchar(16) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id_material` int(11) NOT NULL,
  `fk_id_establishment` int(11) NOT NULL,
  `fk_id_measure` int(11) NOT NULL,
  `fk_id_expense_account` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `critical_stock` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id_material`, `fk_id_establishment`, `fk_id_measure`, `fk_id_expense_account`, `name`, `critical_stock`) VALUES
(3854, 2, 19, 61, 'POLAR MICROFIBRA AZUL', '0.0000'),
(3855, 2, 19, 61, 'CHAQUETA SOFTSHELL', '0.0000'),
(3856, 2, 19, 61, 'LOGO BORDADO COOPORATIVO', '0.0000'),
(3857, 2, 19, 61, 'CHALECO GEOLOGO POPLIN', '0.0000'),
(3858, 2, 19, 61, 'LOGO ESTAMPADO COORPORATIVO', '0.0000'),
(3859, 2, 20, 98, 'MANGUERA JARDIN 3/4', '0.0000'),
(3860, 2, 3, 199, 'ESMALTE SINTETICO GRIS PRELA ', '0.0000'),
(3861, 2, 19, 279, 'LETRERO OBRA', '0.0000'),
(3862, 2, 5, 96, 'CLAVO CORRIENTE 2', '0.0000'),
(3863, 2, 5, 96, 'CLAVO CORRIENTE 2 1/2', '0.0000'),
(3864, 2, 5, 96, 'CLAVO CORRIENTE 3', '0.0000'),
(3865, 2, 5, 96, 'CLAVO CORRIENTE 4', '0.0000'),
(3866, 2, 5, 97, 'ALAMBRE RECOCIDO NEGRO 14', '0.0000'),
(3867, 2, 5, 97, 'ALAMBRE RECOCIDO NEGRO 18', '0.0000'),
(3868, 2, 5, 96, 'PUNTA CORRIENTE 1 1/2', '0.0000'),
(3869, 2, 5, 96, 'CLAVO VOLCANITA ', '0.0000'),
(3870, 2, 13, 97, 'ROLLO ALAMBRE PUAS 275ML', '0.0000'),
(3871, 2, 19, 61, 'LENTE GRIS', '0.0000'),
(3872, 2, 19, 61, 'LENTE CLARO', '0.0000'),
(3873, 2, 19, 61, 'COLETO PARA SOLDADOR', '0.0000'),
(3874, 2, 19, 61, 'POLAINA  PARA SOLDADOR', '0.0000'),
(3875, 2, 9, 71, 'HORMIGON S085 40 06', '0.0000'),
(3876, 2, 9, 71, 'HORMIGON S170 40 06', '0.0000'),
(3877, 2, 9, 71, 'HORMIGON HN 15 40 06 80%', '0.0000'),
(3878, 2, 9, 71, 'HORMIGON HN20 40 06 90%', '0.0000'),
(3879, 2, 9, 71, 'HORMIGON HN20 20 08 90%', '0.0000'),
(3880, 2, 9, 71, 'HORMIGON HN25 40 06 90%', '0.0000'),
(3881, 2, 9, 71, 'HORMIGON HN25 20 08 90%', '0.0000'),
(3882, 2, 9, 71, 'HORMIGON HB25 20 10 90%', '0.0000'),
(3883, 2, 9, 71, 'HORMIGON HN30 20 08 90%', '0.0000'),
(3884, 2, 9, 71, 'HORMIGON HB30 20 10 90%', '0.0000'),
(3885, 2, 9, 71, 'HORMIGON HN35 20 08 90%', '0.0000'),
(3886, 2, 9, 71, 'HORMIGON HB35 20 10 90%', '0.0000'),
(3887, 2, 9, 71, 'HORMIGON HN40 20 08 90%', '0.0000'),
(3888, 2, 9, 71, 'HORMIGON HB 40 20 10 90%', '0.0000'),
(3889, 2, 9, 71, 'HORMIGON HB35 20 10 90%', '0.0000'),
(3890, 2, 19, 289, 'ARRIENDO DEMOLEDOR 10KG', '0.0000'),
(3891, 2, 19, 289, 'ARRIENDO SOPLADOR', '0.0000'),
(3892, 2, 19, 284, 'FLETE ANDAMIOS CAMION 2 TONELADA', '0.0000'),
(3893, 2, 19, 284, 'FLETE ANDAMIOS CAMION 5 TONELADA', '0.0000'),
(3894, 2, 19, 289, 'ARRIENDO ROMPE PAVIMENTO 30KG', '0.0000'),
(3895, 2, 19, 75, 'TAPA CAMARA CON ANILLO FR FDO SIN LOGO', '0.0000'),
(3896, 2, 20, 67, 'HIDROLAVADORA AQUAPRES 200BAR 10LTS BENCINERA', '0.0000'),
(3897, 2, 18, 128, 'TUBO PVC PRESION 32MM ', '0.0000'),
(3898, 2, 19, 119, 'PINO BRUTO 1 X 4X3', '2.0000'),
(3899, 2, 19, 119, 'PINO BRUTO 2 X 3X3', '2.0000'),
(3900, 2, 19, 98, 'COPA DESBASTE DIAMANTADA 7', '0.0000'),
(3901, 2, 19, 98, 'GRATA RECTA TRENZADA M14X 115MM', '0.0000'),
(3902, 2, 19, 98, 'DISCO CORTE METAL 4 1/2', '0.0000'),
(3903, 2, 19, 98, 'DISCO DESBASTE METAL  4 1/2', '0.0000'),
(3904, 2, 19, 98, 'DISCO DESBASTE METAL  7', '0.0000'),
(3905, 2, 19, 98, 'COPA DESBASTE DIAMANTADA 4 1/2', '0.0000'),
(3906, 2, 5, 84, 'ACERO A63 8MM X 12M', '0.0000'),
(3907, 2, 5, 84, 'ACERO A63 10MM X 12M', '0.0000'),
(3908, 2, 5, 84, 'ACERO A63 12MM X 12M', '0.0000'),
(3909, 2, 5, 84, 'ACERO A63 16MM X 12M', '0.0000'),
(3910, 2, 5, 84, 'ACERO A63 18MM X 12M', '0.0000'),
(3911, 2, 5, 84, 'ACERO A63 22MM X 10M', '0.0000'),
(3912, 2, 5, 84, 'ACERO A63 25MM X 12M', '0.0000'),
(3913, 2, 19, 98, 'DISCO CORTE DIAMANTADO 7', '0.0000'),
(3914, 2, 19, 98, 'DISCO CORTE DIAMANTADO 4 1/2', '0.0000'),
(3915, 2, 19, 98, 'DISCO CORTE DIAMANTADO 9', '0.0000'),
(3916, 2, 19, 98, 'PUNTO SDS MAX 40MM', '0.0000'),
(3917, 2, 19, 98, 'CINCEL SDS MAX 40MM X 25CM', '0.0000'),
(3918, 2, 19, 98, 'BROCA ACERO RAPIDO 6MM', '0.0000'),
(3919, 2, 19, 98, 'BROCA ACERO RAPIDO 8MM', '0.0000'),
(3920, 2, 19, 98, 'BROCA ACERO RAPIDO 10MM', '0.0000'),
(3921, 2, 19, 284, 'FLETE CAMION 3/4 DESDE OBRA SEMINARIO A OBRA ROMAN DIAZ', '0.0000'),
(3922, 2, 19, 284, 'FLETE CAMION 3/4 DESDE UNISPAN A OBRA ', '0.0000'),
(3923, 2, 19, 284, 'FLETE CAMION 3/4 DESDE MULTIMETAL A OBRA ', '0.0000'),
(3924, 2, 19, 284, 'FLETE CAMION NORMAL DESDE UNISPAN A OBRA ', '0.0000'),
(3925, 2, 19, 98, 'BROCA SDS PLUS 8 X 160MM', '0.0000'),
(3926, 2, 19, 98, 'BROCA SDS PLUS 10 X 160MM', '0.0000'),
(3927, 2, 19, 98, 'BROCA SDS PLUS 12 X 160MM', '0.0000'),
(3928, 2, 19, 98, 'BROCA SDS PLUS 14X 160MM', '0.0000'),
(3929, 2, 19, 98, 'BROCA SDS PLUS 16X 210MM', '0.0000'),
(3930, 2, 19, 98, 'BROCA SDS PLUS 8X 210MM', '0.0000'),
(3931, 2, 19, 98, 'BROCA SDS PLUS 10X 210MM', '0.0000'),
(3932, 2, 19, 98, 'BROCA SDS PLUS 12X 210MM', '0.0000'),
(3933, 2, 19, 98, 'BROCA SDS PLUS 25X 400MM', '0.0000'),
(3934, 2, 19, 96, 'CLAVO CONCRETERO 1', '0.0000'),
(3935, 2, 19, 96, 'CLAVO CONCRETERO 2', '0.0000'),
(3936, 2, 19, 96, 'CLAVO CONCRETERO 2 1/2', '0.0000'),
(3937, 2, 19, 96, 'CLAVO CONCRETERO 3', '0.0000'),
(3938, 2, 19, 98, 'FULMINANTE AMARILLO CAL.27', '0.0000'),
(3939, 2, 9, 71, 'HIDROFUGO (SIKA1)', '0.0000'),
(3940, 2, 19, 72, 'SEPARADOR RUEDA 20MM', '0.0000'),
(3941, 2, 19, 72, 'SEPARADOR RUEDA 25MM', '0.0000'),
(3942, 2, 19, 72, 'SEPARADOR TORRE 20MM', '0.0000'),
(3943, 2, 19, 72, 'SEPARADOR HORMIGON 5CM', '0.0000'),
(3944, 2, 19, 72, 'SEPARADOR TORRE MUELA', '0.0000'),
(3945, 2, 19, 77, 'TAPON MAGNUN 24MM CAFE', '0.0000'),
(3946, 2, 19, 77, 'CONO PLASTICO 28MM NEGRO ', '0.0000'),
(3947, 2, 18, 77, 'ESQUINERO RIGIDO BLANCO PARA PILARES ', '0.0000'),
(3948, 2, 16, 72, 'DYNASOL EM-EXTREME', '0.0000'),
(3949, 2, 16, 72, 'DYNASOL EXTREME', '0.0000'),
(3950, 2, 10, 72, 'DYNABAND 20*50MM X2MTS', '0.0000'),
(3951, 2, 16, 72, 'DYNALATEX 1 ADHENCIA MORTERO', '0.0000'),
(3952, 2, 16, 72, 'DYNALATEX 2 ADHENCIA YESOS', '0.0000'),
(3953, 2, 16, 72, 'DYNAL PRIMER', '0.0000'),
(3954, 2, 16, 72, 'DYNAL DENSO', '0.0000'),
(3955, 2, 16, 72, 'ZONEFUNTAC DENSO TAMBOR', '0.0000'),
(3956, 2, 17, 72, 'ZONEFUNTAC DENSO TARRO', '0.0000'),
(3957, 2, 17, 72, 'ZONE COBERTOR', '0.0000'),
(3958, 2, 16, 72, 'ZONE DHC  (QHC) TRANSPARENTE', '0.0000'),
(3959, 2, 13, 72, 'MEMBRANA ASFALTICA JJ4MM 10M2', '0.0000'),
(3960, 2, 16, 72, 'MEMBRANA CURADO FRAGUATEX I 21', '0.0000'),
(3961, 2, 13, 256, 'GEOTEXTIL 75GM2', '0.0000'),
(3962, 2, 16, 72, 'FRAGUATEX G-13 AMBAR', '0.0000'),
(3963, 2, 19, 61, 'EXTINTOR PQS ABC DE 10KG', '0.0000'),
(3964, 2, 19, 62, 'CARRETILLA ', '0.0000'),
(3965, 2, 19, 62, 'CAMARA  RUEDA DE CARRETILLA  400X8', '0.0000'),
(3966, 2, 19, 62, 'RUEDA DE CARRETILLA  400X8', '0.0000'),
(3967, 2, 19, 98, 'CANDADO 60MM', '0.0000'),
(3968, 2, 19, 98, 'CANDADO 40MM', '0.0000'),
(3969, 2, 19, 98, 'PORTA CANDADO 3 1/2', '0.0000'),
(3970, 2, 19, 98, 'PORTA CANDADO 4 1/2', '0.0000'),
(3971, 2, 20, 98, 'CADENA ESLABON 8MM*30', '0.0000'),
(3972, 2, 19, 79, 'SIKADUR 32', '0.0000'),
(3973, 2, 19, 79, 'SIKADUR 31', '0.0000'),
(3974, 2, 19, 79, 'INTRAPLAST 850GRS', '0.0000'),
(3975, 2, 14, 79, 'SIKAREP  SACO 30KG', '0.0000'),
(3976, 2, 13, 256, 'GEOTEXTIL 30GRS/M2', '0.0000'),
(3977, 2, 19, 62, 'DEMOLEDOR 10 KG', '0.0000'),
(3978, 2, 19, 62, 'ESMERIL ANGULAR 7', '0.0000'),
(3979, 2, 19, 62, 'ROTOMARTILLO SDS PLUS', '0.0000'),
(3980, 2, 19, 62, 'ESMERIL ANGULAR 4 1/2', '0.0000'),
(3981, 2, 19, 232, 'CALEFONT 13 LT GAS LICUADO', '0.0000'),
(3982, 2, 12, 121, 'TERCIADO ESTRUCTURAL 15MM', '0.0000'),
(3983, 2, 19, 62, 'RODILLO 18CM CHIPORRO SINTETICO', '0.0000'),
(3984, 2, 19, 98, 'BROCHA 4 ', '0.0000'),
(3985, 2, 19, 98, 'BROCHA 2 1/2 ', '0.0000'),
(3986, 2, 19, 77, 'HILO CONTINUO M20X600 MOLDAJE', '0.0000'),
(3987, 2, 19, 77, 'PERNO M20 X 40 GRADO 5 MOLDAJE', '0.0000'),
(3988, 2, 19, 77, 'TAPON MAGNUM 28MM MOLDAJE', '0.0000'),
(3989, 2, 19, 77, 'TUERCA M20 MOLDAJE', '0.0000'),
(3990, 2, 5, 84, 'ACERO A63 16MM X 7M', '0.0000'),
(3991, 2, 5, 84, 'ACERO A63 16MM X 8M', '0.0000'),
(3992, 2, 5, 84, 'ACERO A63 16MM X 9M', '0.0000'),
(3993, 2, 5, 84, 'ACERO A63 18MM X 8M', '0.0000'),
(3994, 2, 5, 84, 'ACERO A63 18MM X 9M', '0.0000'),
(3995, 2, 9, 71, 'HORMIGON H40-(90)-13-14-CN2', '0.0000'),
(3996, 2, 9, 71, 'HORMIGON HN 10 (90) 40 6', '0.0000'),
(3997, 2, 20, 135, 'CORDON TRIFASICO RV-K 5X6MM', '0.0000'),
(3998, 2, 19, 72, 'DYNA-BAND 20X50MMX2MT', '0.0000'),
(3999, 2, 19, 199, 'PINTURA SPRAY ROJO', '0.0000'),
(4000, 2, 19, 199, 'PINTURA SPRAY NEGRO', '0.0000'),
(4001, 2, 19, 199, 'PINTURA SPRAY BLANCO', '0.0000'),
(4002, 2, 19, 62, 'ARCO SIERRA MANUAL 12', '0.0000'),
(4003, 2, 19, 98, 'HOJA SIERRA MANUAL ', '0.0000'),
(4004, 2, 24, 446, 'BOLSA BASURA 90X70', '0.0000'),
(4005, 2, 23, 439, 'CLORO', '0.0000'),
(4006, 2, 19, 98, 'CARTONERO GRANDE', '0.0000'),
(4007, 2, 19, 119, 'PINO BRUTO 2X8', '0.0000'),
(4008, 2, 19, 62, 'PALA METALICA PUNTA HUEVO', '0.0000'),
(4009, 2, 18, 101, 'PERFIL METALICO 20X40X2MM', '0.0000'),
(4010, 2, 18, 101, 'FIERRO LISO 12MMX6M', '0.0000'),
(4011, 2, 5, 65, 'SOLDADURA 1/8', '0.0000'),
(4012, 2, 5, 65, 'SOLDADURA 3/32', '0.0000'),
(4013, 2, 19, 98, 'DISCO CORTE METAL 14', '0.0000'),
(4014, 2, 19, 98, 'DISCO CORTE METAL 7', '0.0000'),
(4015, 2, 19, 119, 'PINO BRUTO 2X2X3', '2.0000'),
(4016, 2, 19, 119, 'PINO BRUTO 3X3X3', '2.0000'),
(4017, 2, 19, 62, 'ALICATE', '0.0000'),
(4018, 2, 19, 62, 'JUEGO LLAVES ALLEN', '0.0000'),
(4019, 2, 19, 62, 'JUEGO LLAVES PUNTA CORONA 10 A 25', '0.0000'),
(4020, 2, 19, 62, 'LLAVE CHICHARRA CON DADOS 10A25', '0.0000'),
(4021, 2, 19, 98, 'ESPATULA 2 1/2', '0.0000'),
(4022, 2, 19, 98, 'PLIEGO LIJA FIERRO 100', '0.0000'),
(4023, 2, 19, 119, 'ALAMO BRUTO 2X8X3', '2.0000'),
(4024, 2, 19, 98, 'PLIEGO LIJA MADERA 100', '0.0000'),
(4025, 2, 9, 71, 'HORMIGON HB40-90-20-12', '0.0000'),
(4026, 2, 9, 71, 'HORMIGON HB-40-90-13-70', '0.0000'),
(4027, 2, 20, 135, 'CORDON ELECTRICO 3X2', '5.0000'),
(4028, 2, 19, 164, 'ENCHUFE INDUSTRIAL MACHO VOLANTE 16AMP ', '0.0000'),
(4029, 2, 19, 164, 'ENCHUFE INDUSTRIAL HEMBRA VOLANTE 16AMP ', '0.0000'),
(4030, 2, 12, 77, 'TERCIADO FILM FENOLICO 18MM SEGUNDA CALIDAD', '0.0000'),
(4031, 2, 12, 77, 'TERCIADO FILM FENOLICO 18MM PRIMERA CALIDAD', '0.0000'),
(4032, 2, 19, 67, 'ASPIRADORA TH-1410 THOMAS', '0.0000'),
(4033, 2, 19, 67, 'ASPIRADORA WD1255 RID SECO/MOJADO 45LT', '0.0000'),
(4034, 2, 20, 61, 'CABLE ACERADO 5/16', '0.0000'),
(4035, 2, 19, 61, 'PRENSA CROSBY 5/16', '0.0000'),
(4036, 2, 5, 84, 'ACERO A63 16MM X10MT', '0.0000'),
(4037, 2, 5, 84, 'ACERO A63 18MM X 7MT', '0.0000'),
(4038, 2, 5, 84, 'ACERO A63 25MM X 11MT', '0.0000'),
(4039, 2, 5, 84, 'ACERO A63 25MM X 9MT', '0.0000'),
(4040, 2, 5, 84, 'ACERO A63 25MM X 8MT', '0.0000'),
(4041, 2, 5, 84, 'ACERO A63 25MM X 7MT', '0.0000'),
(4042, 2, 5, 84, 'ACERO A63 22MM X 9MT', '0.0000'),
(4043, 2, 5, 84, 'ACERO A63 22MM X 8MT', '0.0000'),
(4044, 2, 5, 84, 'ACERO A63 22MM X 7MT', '0.0000'),
(4045, 2, 14, 79, 'SIKAGROUT 212', '0.0000'),
(4046, 2, 5, 84, 'ACERO A63 22MM X 12M', '0.0000'),
(4047, 2, 19, 72, 'CONO MAGNUM PARA TUBERIA 32MM', '0.0000'),
(4048, 2, 9, 225, 'TERMOPOL 15KG/M3 100X1000X0500', '0.0000'),
(4049, 2, 9, 225, 'TERMOPOL 15KG/M3 050X1000X0500', '0.0000'),
(4050, 2, 20, 303, 'ESLINGA A.2.75.00.RMX 6MTS C/F TUBULAR', '0.0000'),
(4051, 2, 13, 72, 'POLIETILENO NEGRO', '0.0000'),
(4052, 2, 19, 80, 'BALDE CONCRETERO', '0.0000'),
(4053, 2, 3, 199, 'ESMALTE SINT PJTO GL SOQ. ROJO MANDARIN', '0.0000'),
(4054, 2, 19, 445, 'CINTA EMBALAJE', '0.0000'),
(4055, 2, 19, 444, 'CINTA ENMASCARAR 2 40M', '0.0000'),
(4056, 2, 13, 98, 'MALLA NEGRA 80% 420', '0.0000'),
(4057, 2, 14, 70, 'CEMENTO  ESPECIAL', '0.0000'),
(4058, 2, 19, 123, 'PALLETS', '0.0000'),
(4059, 2, 3, 70, 'LATEX CONSTRUC. LATA SOQ. BLANCO', '0.0000'),
(4060, 2, 17, 199, 'LATEX EXPERTO TINETA CSTA. BLANCO', '0.0000'),
(4061, 2, 3, 199, 'LATEX CONSTRUC. LATA SOQ. BLANCO 1 ', '0.0000'),
(4062, 2, 19, 62, 'MARTILLO CARPINTERO M/MADER 27MM STANLEY 51271', '0.0000'),
(4063, 2, 19, 62, 'ALICATE UNIVERSAL 8 CR-V  B&G', '0.0000'),
(4064, 2, 19, 62, 'DIABLO SACA CLAVOS 3/4 X 24WR24 B&G', '0.0000'),
(4065, 2, 13, 97, 'ROLO ALAMBRE NEGRO#18. 50 KILOS', '0.0000'),
(4066, 2, 13, 97, 'ROLO ALAMBRE NEGRO#18. 50 KILOS', '0.0000'),
(4067, 2, 13, 97, 'ROLLO DE ALAMBRE NEGRO # 18 50 KILOS', '0.0000'),
(4068, 2, 13, 97, 'ROLLO DE ALAMBRE NEGRO # 18 50 KILOS', '0.0000'),
(4069, 2, 19, 232, 'CALEFONT SPLENDID 10 LITROS', '0.0000'),
(4070, 2, 19, 98, 'HUAIPE BLANCO 1 KILO', '0.0000'),
(4071, 2, 19, 74, 'CAL MORTERO 25 KILOS', '0.0000'),
(4072, 2, 18, 101, 'FIERRO LISO REDONDO 6X10MM', '0.0000'),
(4073, 2, 19, 120, 'TERCIADO FILM ECO TULSA 18MM 1.22X2.44', '0.0000'),
(4074, 2, 13, 97, 'ALAMBRE NEGRON 18 25 KILOS', '0.0000'),
(4075, 2, 18, 101, 'PERFIL CUADRADO 75X75X3 MM TIRA', '0.0000'),
(4076, 2, 19, 98, 'BISAGRAS 3X3 BROCEADA PACK 3 UNIDADES', '0.0000'),
(4077, 2, 19, 98, 'BISAGRAS 3 1/2 ', '0.0000'),
(4078, 2, 12, 120, 'TERCIADO ESTRUCTURAL 18MM 122X244', '0.0000'),
(4079, 2, 19, 119, 'MADERA ALAMO BRUTO 2X8 X 3.20', '0.0000'),
(4080, 2, 19, 119, 'CUARTON BRUTO 3X3 X 3.20', '0.0000'),
(4081, 2, 19, 119, 'TAPA PINO 1X4 X 3.20', '0.0000'),
(4082, 2, 19, 119, 'TAPA PINO 1X4 X 3.20', '0.0000'),
(4083, 2, 19, 119, 'PINO BRUTO 2X4 X3.20', '0.0000'),
(4084, 2, 19, 122, 'TABLERO OSB 9.5MM 1.22X2.44', '0.0000'),
(4085, 2, 5, 84, 'ACERO A63 18MM X 10M', '0.0000'),
(4086, 2, 5, 84, 'ACERO A63 22MM X 11M', '0.0000'),
(4087, 2, 23, 199, 'AGUARRAS MINERAL 1 LT.', '0.0000'),
(4088, 2, 19, 60, 'MALLA C-92  15X15X4 CE 2.60X5.00 MTS', '0.0000'),
(4089, 2, 18, 101, 'PERFIL RECTANGULAR 30X20X2 TIRA', '0.0000'),
(4090, 2, 19, 98, 'ESCOBILLON ECONOMICO CON MANGO', '0.0000'),
(4091, 2, 19, 98, 'ESCOBILLON ECONOMICO CON MANGO', '0.0000'),
(4092, 2, 19, 98, 'CINCEL 3/4X10', '0.0000'),
(4093, 2, 19, 98, 'COMBO CON MANGO FV 4 LIBRAS', '0.0000'),
(4094, 2, 19, 98, 'ESCOBILLON MUNICIPAL CON MANGO', '0.0000'),
(4095, 2, 19, 98, 'JUEGO ATORNILLADOR JOLLERO 6 PIEZAS STANLEY', '0.0000'),
(4096, 2, 19, 98, 'MARTILLO CARPINTERO M/TUBO 16OZ', '0.0000'),
(4097, 2, 19, 98, 'PLANA GRANDE', '0.0000'),
(4098, 2, 19, 98, 'PLATACHO MADERAMEDIANO', '0.0000'),
(4099, 2, 19, 98, 'PICOTA PUNTA-RAMA 5', '5.0000'),
(4100, 2, 19, 98, 'PUNTO ACERO 3/4 X 10', '0.0000'),
(4101, 2, 19, 98, 'SERRUCHO CARPIMTERO JET CUT 22STANLEY', '0.0000'),
(4102, 2, 5, 98, 'TIERRA COLOR AZUL 1KG', '0.0000'),
(4103, 2, 19, 98, 'CHUZO 1', '0.0000'),
(4104, 2, 19, 98, 'PALA PUNTA HUEVO MANGO MADERA ', '0.0000'),
(4105, 2, 19, 62, 'SOLDADORA INDURA COMPACTWELD 100', '0.0000'),
(4106, 2, 19, 62, 'ESCOBILLA ACERO', '0.0000'),
(4107, 2, 19, 62, 'ESCOBILLA ACERO', '0.0000'),
(4108, 2, 19, 62, 'LLAVE FRANCESA STANLEY', '0.0000'),
(4109, 2, 19, 62, 'RASTRILLO CONSTRUCCION', '0.0000'),
(4110, 2, 19, 62, 'REMACGADORA STANLEY ', '0.0000'),
(4111, 2, 19, 62, 'REMACHADORA STANLEY ', '0.0000'),
(4112, 2, 18, 101, 'ANGULO DOBLADO 40X3MM TIRA', '0.0000'),
(4113, 2, 3, 199, 'ANTICORROSIVO ', '0.0000'),
(4114, 2, 19, 98, 'ESMERIL ANGULAR 9', '0.0000'),
(4115, 2, 19, 284, 'FLETE PLACAS FENOLICAS RMD', '0.0000'),
(4116, 2, 19, 85, 'PILAR ALZAPRIMADO 8X3080', '0.0000'),
(4117, 2, 19, 85, 'PILAR ALZAPRIMADO 8X2720', '0.0000'),
(4118, 2, 19, 85, 'PILAR ALZAPRIMADO 8X3260', '0.0000'),
(4119, 2, 19, 85, 'PILAR ALZAPRIMADO 8X3260', '0.0000'),
(4120, 2, 19, 62, 'BALANZA DIGITAL 30 KG', '0.0000'),
(4121, 2, 19, 60, 'ANTENA PERFIL CUAD. 50X50X2 SON DE 150X3000', '0.0000'),
(4122, 2, 19, 85, 'CUNA DE ESCOMBRO', '0.0000'),
(4123, 2, 19, 98, 'PINTURA SPRAY AMARILLO', '0.0000'),
(4124, 2, 19, 302, 'UNIDAD MOTRIZ GASOLINA 5HP', '0.0000'),
(4125, 2, 19, 184, 'CASETON PARA BALON DE GAS', '0.0000'),
(4126, 2, 19, 184, 'CASETON HOJALATA PARA CALEFON ', '0.0000'),
(4127, 2, 19, 184, 'TUBO HOJALATA PARA CALEFONT', '0.0000'),
(4128, 2, 19, 184, 'GORRO HOJALATA PARA CALEFONT', '0.0000'),
(4129, 2, 19, 184, 'INSTALACION DE HOJALATERIA ', '0.0000'),
(4130, 2, 19, 62, 'SISTEMA DE RAMA CADENA 5/8', '0.0000'),
(4131, 2, 19, 62, 'EQUIPO PORTATIL KENWOOD TK-3000', '0.0000'),
(4132, 2, 19, 120, 'PLACA FENOLICA NQ1220X2440X18', '0.0000'),
(4133, 2, 19, 120, 'TERCIADO FILM 18 MM PREMIUN SLAB', '0.0000'),
(4134, 2, 11, 61, 'ZAPATO SEGURIDAD JEFATURA', '0.0000'),
(4135, 2, 19, 61, 'ARNES SEGURIDAD TIPO PARACAIDAS 3 ARGOLLAS', '0.0000'),
(4136, 2, 19, 61, 'CABO DE VIDA Y CINTA PLANA MOSQUETON ESCALA', '0.0000'),
(4137, 2, 19, 61, 'CASCO SEGURIDAD', '0.0000'),
(4138, 2, 19, 61, 'ARNES PARA CASCO', '0.0000'),
(4139, 2, 19, 61, 'BARBIQUEJO GANCHO METALICO', '0.0000'),
(4140, 2, 19, 61, 'LEGIONARIO', '0.0000'),
(4141, 2, 19, 61, 'TAPON AUDITIVO CON CAJA', '0.0000'),
(4142, 2, 19, 61, 'FONOS ADOSADOS', '0.0000'),
(4143, 2, 19, 61, 'LENTE PARA LENTES OPTICOS)', '0.0000'),
(4144, 2, 19, 61, 'GUANTE PALMALATEX', '0.0000'),
(4145, 2, 19, 61, 'GUANTE CABRITILLA', '0.0000'),
(4146, 2, 11, 61, 'GUATE ANTIVIBRACION', '0.0000'),
(4147, 2, 11, 61, 'GUANTE PALMALATEX', '0.0000'),
(4148, 2, 11, 61, 'GUANTE CABRITILLA ', '0.0000'),
(4149, 2, 11, 61, 'GUANTE ANTIVIBRACION', '0.0000'),
(4150, 2, 11, 61, 'GUANTE LATEX', '0.0000'),
(4151, 2, 11, 61, 'GUANTE SOLDADOR DESCARNE', '0.0000'),
(4152, 2, 11, 61, 'GUANTE NITRILO VERDE', '0.0000'),
(4153, 2, 11, 61, 'GUANTE NITRILO C/PU', '0.0000'),
(4154, 2, 19, 61, 'RESPIRADOS MEDIO ROSTRO DOS VIAS', '0.0000'),
(4155, 2, 11, 61, 'FILTRO PARTICULADO P100', '0.0000'),
(4156, 2, 11, 61, 'FILTRO PARA VAPORES Y GASES ACIDOS ', '0.0000'),
(4157, 2, 19, 61, 'RESPIRADOR DESECHABLE', '0.0000'),
(4158, 2, 19, 61, 'BUZO DESECHABLE', '0.0000'),
(4159, 2, 19, 61, 'TRAJE IMPERMEABLE', '0.0000'),
(4160, 2, 19, 61, 'ARNES DE SEGURIDAD ', '0.0000'),
(4161, 2, 19, 61, 'CABO DE VIDA DOS MOSQUETONES', '0.0000'),
(4162, 2, 19, 61, 'CABO DE VIDA CON MOSQUETON Y GANCHO', '0.0000'),
(4163, 2, 11, 61, 'ZAPATO PUNTA Y PLANTILLA DE ACERO', '0.0000'),
(4164, 2, 11, 61, 'BOTAS CONCRETERAS ANTICLAVOS', '0.0000'),
(4165, 2, 19, 61, 'CHALECO REFLEXTANTE', '0.0000'),
(4166, 2, 19, 61, 'CHAQUETA PARA SOLDADOR DE ESCARNE', '0.0000'),
(4167, 2, 19, 61, 'PANTALON DE SOLDADOR DE ESCARNE', '0.0000'),
(4168, 2, 19, 61, 'PORTA VISOR ADOSABLE AL CASCO', '0.0000'),
(4169, 2, 19, 61, 'COLETO PARA SOLDADOR ', '0.0000'),
(4170, 2, 19, 61, 'CARETA FACIAL CON VISOR', '0.0000'),
(4171, 2, 19, 139, 'TUBO FLUORESCENTE 36W', '0.0000'),
(4172, 2, 19, 139, 'EQUIPO FLUORESCENTE 36W', '0.0000'),
(4173, 2, 19, 139, 'PARTIDOR EQUIPO FLUORESCENTE ', '0.0000'),
(4174, 2, 19, 61, 'BLOQUEADOR SOLAR FACTOR 50', '0.0000'),
(4175, 2, 23, 61, 'BLOQUEADOR SOLAR FACTOR 50', '0.0000'),
(4176, 2, 13, 61, 'ROLLO FAENA TRABAJO LIVIANO 50 MTS', '0.0000'),
(4177, 2, 13, 61, 'CINTA PELIGRO', '0.0000'),
(4178, 2, 13, 61, 'CUERDA PERLON', '0.0000'),
(4179, 2, 19, 61, 'RODILLERAS', '0.0000'),
(4180, 2, 19, 445, 'ARCHIVADOR BURDEO', '0.0000'),
(4181, 2, 19, 445, 'SEPARADOR POR ORDEN ALFABETICO', '0.0000'),
(4182, 2, 19, 445, 'SEPARADOR ARCHIVADOR MENSUAL', '0.0000'),
(4183, 2, 19, 445, 'PERFORADORA MEDIANA GRIS', '0.0000'),
(4184, 2, 19, 445, 'CORCHETERA METALICA NEGRA', '0.0000'),
(4185, 2, 19, 445, 'ANOTADOR CON APRETADOR', '0.0000'),
(4186, 2, 19, 445, 'LAPIZ BICOLOR DELGADO', '0.0000'),
(4187, 2, 19, 445, 'MARCADOR OLEO PERMANENTE METAL', '0.0000'),
(4188, 2, 19, 445, 'LIBRO MANIFOLD AUTOCOPIA', '0.0000'),
(4189, 2, 19, 445, 'LIBRETA TARJETA MENSUAL', '0.0000'),
(4190, 2, 19, 445, 'MARCADOR PERMANENTE AZUL', '0.0000'),
(4191, 2, 19, 445, 'MARCADOR PERMANENTE ROJO', '0.0000'),
(4192, 2, 19, 445, 'MARCADOR PERMANENTE NEGRO', '0.0000'),
(4193, 2, 19, 445, 'MARCADOR DE PIZARRA', '0.0000'),
(4194, 2, 19, 445, 'MARCADOR DE PIZARRA AZUL', '0.0000'),
(4195, 2, 19, 445, 'MARCADOR DE PIZARRA NEGRO', '0.0000'),
(4196, 2, 19, 445, 'MARCADOR DE PIZARRA ROJO', '0.0000'),
(4197, 2, 19, 445, 'CORRECTOR LINEAL 5.2', '0.0000'),
(4198, 2, 19, 445, 'BANDEJA METALICA', '0.0000'),
(4199, 2, 19, 445, 'TONER BROTHER 1060 NEGRO', '0.0000'),
(4200, 2, 19, 445, 'TONER TN 2340 PARA DC PARA L2540DW', '0.0000'),
(4201, 2, 19, 445, 'TAMBOR DR2340 PARA DC PARA L2540DW', '0.0000'),
(4202, 2, 19, 445, 'PAPEL TIPO CARTA 500 HOJAS', '0.0000'),
(4203, 2, 19, 445, 'PAPEL TIPO OFICIO 500 HOJAS', '0.0000'),
(4204, 2, 19, 445, 'CORCHETE ESTANDAR 26/6. 5000 UNIDADES', '0.0000'),
(4205, 2, 19, 445, 'BORRADOR PIZARRA MADERA', '0.0000'),
(4206, 2, 19, 445, 'PIZARRA BLANCA MURAL 80CM X 100CM', '0.0000'),
(4207, 2, 19, 336, 'BOLSA BASURA 70X90 CM', '0.0000'),
(4208, 2, 19, 72, 'PACK CAPSULA HILTI', '0.0000'),
(4209, 2, 19, 72, 'PACK CAPSULA HILTI ', '0.0000'),
(4210, 2, 19, 72, 'UTIL PORTA DADO', '0.0000'),
(4211, 2, 19, 72, 'DADO15/16X12', '0.0000'),
(4212, 2, 19, 105, 'DADO15/16X12', '0.0000'),
(4213, 2, 19, 61, 'CASCO SEGURIDAD C/ARNES BLANCO', '0.0000'),
(4214, 2, 19, 61, 'CASCO SEGURIDAD C/ARNES ROJO', '0.0000'),
(4215, 2, 19, 61, 'CASCO SEGURIDAD C/ ARNES AMARILLO', '0.0000'),
(4216, 2, 19, 61, 'CASCO SEGURIDAD C/ ARNES VERDE', '0.0000'),
(4217, 2, 19, 61, 'PROTECTOR AUDITIVO TIPO FONO', '0.0000'),
(4218, 2, 11, 61, 'GUANTE NINJA HERO ', '0.0000'),
(4219, 2, 11, 61, 'GUANTE DESCARNE ', '0.0000'),
(4220, 2, 11, 61, 'GUANTE NITRILO VERDE', '0.0000'),
(4221, 2, 11, 61, 'GUANTE NITRILO P/ TEJIDO', '0.0000'),
(4222, 2, 11, 61, 'FILTRO P 100 PARTICULAS', '0.0000'),
(4223, 2, 19, 61, 'BUZO DESECHABLE BLANCO', '0.0000'),
(4224, 2, 19, 61, 'VISOR POLICARBONATO', '0.0000'),
(4225, 2, 19, 61, 'PROTECTOR SOLAR FACTOR 50', '0.0000'),
(4226, 2, 19, 61, 'MALLA FAENERA NARANJA', '0.0000'),
(4227, 2, 13, 61, 'MALLA FAENERA NARANJA', '0.0000'),
(4228, 2, 11, 61, 'RODILERAS ', '0.0000'),
(4229, 2, 19, 61, 'CABO DE VIDA C/ GANCHO ESCALA O ESTRUCTURERO', '0.0000'),
(4230, 2, 19, 61, 'AMORTIGUADOR DE IMPACTO CORTO', '0.0000'),
(4231, 2, 19, 61, 'CASCO SEGURIDAD BLACO', '0.0000'),
(4232, 2, 11, 61, 'BOTAS NEGRAS PVC', '0.0000'),
(4233, 2, 3, 98, 'MASILLA MAGICA (800GRAMOS)', '0.0000'),
(4234, 2, 19, 98, 'MASILLA MAGICA (800GRAMOS)', '0.0000'),
(4235, 2, 19, 98, 'CATALIZADOR MASILLA', '0.0000'),
(4236, 2, 3, 98, 'PINTURA ANTIHONGOS BLANO', '0.0000'),
(4237, 2, 19, 139, 'FOCO ALURO ', '0.0000'),
(4238, 2, 19, 62, 'PUNTO HEX 26X450 HM1201', '0.0000'),
(4239, 2, 12, 121, 'TABLERO OSB 11MM', '0.0000'),
(4240, 2, 10, 105, 'PIOLA ACERO 5/16', '0.0000'),
(4241, 2, 19, 98, 'BROCA SDS 16MM 310MM', '0.0000'),
(4242, 2, 19, 98, 'BROCA SDS 10MM 310MM', '0.0000'),
(4243, 2, 19, 62, 'MARTILLO ROTATORIO SDS 26', '0.0000'),
(4244, 2, 19, 446, 'BIDON LUSTRA MUEBLE', '0.0000'),
(4245, 2, 19, 98, 'REGULAR DE GAS', '0.0000'),
(4246, 2, 19, 446, 'PA', '0.0000'),
(4247, 2, 19, 446, 'LIMPIA PISO', '0.0000'),
(4248, 2, 19, 446, 'DESODORANTE AMBIENTAL', '0.0000'),
(4249, 2, 19, 98, 'LAPIZ BICOLOR GRUESO', '0.0000'),
(4250, 2, 19, 98, 'HOJA CARTONERO GRANDE', '0.0000'),
(4251, 2, 19, 98, 'GALON MASILLA MAGICA ', '0.0000'),
(4252, 2, 19, 98, 'SACO DE ESCOMBRO', '0.0000'),
(4253, 2, 19, 98, 'SACO DE ESCOMBRO', '0.0000'),
(4254, 2, 19, 62, 'CINCEL HEX 21MM 26X450MM ', '0.0000'),
(4255, 2, 19, 284, 'FLETE CAMI', '0.0000'),
(4256, 2, 19, 61, 'CASCO SEGURIDAD C/ ARNES', '0.0000'),
(4257, 2, 19, 61, 'ANTIPARRAS VERATTI', '0.0000'),
(4258, 2, 19, 61, 'ADAPTADOR PLASTICO PARA CASCO', '0.0000'),
(4259, 2, 18, 101, 'PLATINA 50X5MM TIRA', '0.0000'),
(4260, 2, 18, 101, 'FIERRO LISO REDONDO 6X8MM ', '0.0000'),
(4261, 2, 19, 67, 'TRONZADORA 14', '0.0000'),
(4262, 2, 19, 62, 'LIANZA  N', '0.0000'),
(4263, 2, 19, 62, 'LIANZA N', '0.0000'),
(4264, 2, 19, 62, 'WD40', '0.0000'),
(4265, 2, 19, 62, 'HUINCHA METALICA 8MTS', '0.0000'),
(4266, 2, 19, 62, 'HUINCHA METALICA 5MTS', '0.0000'),
(4267, 2, 19, 62, 'NIVEL DE MANO 1200', '0.0000'),
(4268, 2, 19, 62, 'NIVEL DE MANO ALUMINIO 48', '0.0000'),
(4269, 2, 19, 137, 'SOPORTE TABLERO ELECTRICO', '0.0000'),
(4270, 2, 19, 98, 'TAMBOR PLASTICO 200 LT', '0.0000'),
(4271, 2, 19, 98, 'DISCO CORTE METAL 9', '0.0000'),
(4272, 2, 19, 62, 'EQUIPO PORTATIL + CARGADOR', '0.0000'),
(4273, 2, 19, 302, 'SONDA 60MM', '0.0000'),
(4274, 2, 19, 302, 'SONDA 60MM', '0.0000'),
(4275, 2, 19, 302, 'SONDA 60MM', '0.0000'),
(4276, 2, 5, 470, 'CILINDRO DE GAS 45 KG', '0.0000'),
(4277, 2, 19, 61, 'GANCHO AUXILIAR', '0.0000'),
(4278, 2, 19, 62, 'CHUZO', '0.0000'),
(4279, 2, 14, 74, 'SACO DE YESO ', '0.0000'),
(4280, 2, 19, 62, 'GANCHO PARA PULPO', '0.0000'),
(4281, 2, 19, 62, 'PULPO', '0.0000'),
(4282, 2, 19, 137, 'TABLERO ELECTRICO', '0.0000'),
(4283, 2, 19, 62, 'TIZADOR ', '0.0000'),
(4284, 2, 19, 62, 'HUINCHA METALICA 10 MTS', '0.0000'),
(4285, 2, 20, 62, 'CUERDA PERLON', '0.0000'),
(4286, 2, 19, 137, 'TABLERO ELECTRICO', '0.0000'),
(4288, 2, 19, 214, 'TUBERIA PVC 25MM', '0.0000'),
(4289, 2, 18, 101, 'PERFIL TUBULAR 40MM X 6 MTS', '0.0000'),
(4290, 2, 18, 101, 'ANGULO METALICO 30X30', '0.0000'),
(4291, 2, 19, 111, 'PERFIL METALCOM MONTANTE 90', '0.0000'),
(4292, 2, 19, 111, 'PERFIL OMEGA', '0.0000'),
(4293, 2, 19, 103, 'PLANCHA ZINC', '0.0000'),
(4294, 2, 19, 123, 'CERCHAS DE MADERA', '0.0000'),
(4295, 2, 19, 101, 'PERFIL 75MM', '0.0000'),
(4296, 2, 18, 101, 'PERFIL 100X100MM', '0.0000'),
(4297, 2, 19, 66, 'ESCALERA METALICA', '0.0000'),
(4298, 2, 19, 119, 'ALAMO 2X10X320', '0.0000'),
(4299, 2, 19, 98, 'TIERRA COLOR ROJA', '0.0000'),
(4300, 2, 5, 98, 'TIERRA COLOR ROJA', '0.0000'),
(4301, 2, 19, 98, 'BARRA COOPER', '0.0000'),
(4302, 2, 19, 98, 'DISCO DESBASTE METAL 9', '0.0000'),
(4303, 2, 19, 98, 'MANGO PARA PICOTA', '0.0000'),
(4304, 2, 19, 98, 'MANGO PARA PICOTA', '0.0000'),
(4305, 2, 19, 98, 'SOQUETE PARA AMPOLLETA', '0.0000'),
(4306, 2, 19, 98, 'ADHESIVO PARA CORNIZA', '0.0000'),
(4307, 2, 19, 98, 'ADHESIVO PARA CORNIZA', '0.0000'),
(4308, 2, 20, 98, 'CORDON 2.5 100 MTS', '0.0000'),
(4309, 2, 19, 98, 'TARUGOS FISHER 10MM', '0.0000'),
(4310, 2, 19, 98, 'TEFLON 3/4', '0.0000'),
(4311, 2, 19, 98, 'TORNILLO 8X 1/2 L.P.B', '0.0000'),
(4312, 2, 19, 98, 'TORNILLO 8X1/2 L.P.F', '0.0000'),
(4313, 2, 19, 98, 'TORNILLO MEX 8X1/2', '0.0000'),
(4314, 2, 19, 98, 'ESCALIN GALVANIZADO', '0.0000'),
(4315, 2, 19, 98, 'TORNILLO CON TARUGO 6X60', '0.0000'),
(4316, 2, 19, 98, 'TORNILLO CON TARUGO 6X60', '0.0000'),
(4317, 2, 19, 302, 'SONDA 45MM', '0.0000'),
(4318, 2, 19, 289, 'DEMOLEDOR 7KILOS', '0.0000'),
(4319, 2, 19, 67, 'TALADRO PERCUTOR ', '0.0000'),
(4320, 2, 19, 67, 'WINCHE 500 KILOS', '0.0000'),
(4321, 2, 19, 62, 'PISTOLA IMPACTO', '0.0000'),
(4322, 2, 19, 62, 'BALANZA DIGITAL', '0.0000'),
(4323, 2, 19, 62, 'GRILLETE', '0.0000'),
(4324, 2, 19, 200, 'IMPERMEABILIZANTE DYNAL', '0.0000'),
(4325, 2, 19, 98, 'BIDON PLASTICO 50 LTS', '0.0000'),
(4326, 2, 19, 98, 'BIDON ACIDO MURIATICO', '0.0000'),
(4327, 2, 19, 98, 'CABLE VERTICAL ', '0.0000'),
(4328, 2, 19, 98, 'CASILLERO METYALICO', '0.0000'),
(4329, 2, 19, 98, 'CASILLERO METALICO', '0.0000'),
(4331, 2, 19, 98, 'PERFIL AT', '0.0000'),
(4332, 2, 19, 289, 'ARRIENDO DOBLADORA FIERRO ELECTRICA', '0.0000'),
(4333, 2, 19, 302, 'ARRIENDO PLACA COMPACTADORA  ', '0.0000'),
(4334, 2, 19, 91, 'HILO CONTINUO M20 X60 PARA MOLDAJE', '0.0000'),
(4335, 2, 19, 91, 'PERNO M20 X60 PARA MOLDAJE', '0.0000'),
(4336, 2, 19, 91, 'TUERCA M20 X60 PARA MOLDAJE', '0.0000'),
(4337, 2, 19, 67, 'SOPLADOR', '0.0000'),
(4338, 2, 19, 116, 'CA', '0.0000'),
(4339, 2, 19, 116, 'CA', '0.0000'),
(4340, 2, 19, 116, 'CA', '0.0000'),
(4341, 2, 19, 66, 'ENZUNCHADORA', '0.0000'),
(4342, 2, 5, 98, 'CLAVO VOLCANITA 2', '0.0000'),
(4343, 2, 19, 284, 'FLETE CAMION 10 TONELADAS', '0.0000'),
(4344, 2, 19, 289, 'ARRIENDO SONDA INMERSION 45MM', '0.0000'),
(4345, 2, 19, 289, 'ARRIENDO SONDA INMERSION 60MM', '0.0000'),
(4346, 2, 19, 98, 'BROCA SDS PLUS 25 X 350', '0.0000'),
(4347, 2, 19, 98, 'PUNTO SDS MAX 600MM', '0.0000'),
(4348, 2, 19, 98, 'CINCEL SDS MAX 18X50X400MM', '0.0000'),
(4349, 2, 19, 98, 'BROCA SDS PLUS 25X460MM', '0.0000'),
(4350, 2, 19, 289, 'ARRIENDO ASPIRADORA INDUSTRIAL 60LT', '0.0000'),
(4351, 2, 19, 164, 'ENCHUFE INDUSTRIAL HEMBRA SOBREPONER 32AMP CON 3P+T+N', '0.0000'),
(4352, 2, 19, 164, 'CINTA PVC 3/4', '0.0000'),
(4353, 2, 19, 62, 'CINCEL PLANO SDS MAX 18X400X50', '0.0000'),
(4354, 2, 19, 95, 'CANCAMO OJETE 12X120', '0.0000'),
(4355, 2, 19, 95, 'TARUGO NYLON 14X100', '0.0000'),
(4356, 2, 19, 95, 'CINCEL HEX PUNTO 21X450 ', '0.0000'),
(4357, 2, 5, 84, 'ACERO A63 18MM X 11MT', '0.0000'),
(4358, 2, 5, 84, 'ACERO A63 25MM X 10MT', '0.0000'),
(4359, 2, 17, 199, 'ESMALTE AL AGUA VERDE LIMON', '0.0000'),
(4360, 2, 19, 98, 'BASURERO 240 LT CON RUEDAS Y TAPA', '0.0000'),
(4361, 2, 19, 60, 'LINTERNA RECARGABLE', '0.0000'),
(4362, 2, 19, 119, 'PINO BRUTO 1 X 6X3', '2.0000'),
(4363, 2, 19, 67, 'SIERRA ELECTRICA 7 1/4', '0.0000'),
(4364, 2, 19, 98, 'DISCO SIERRA ELECTRICA 7 1/4 24 DIENTES', '0.0000'),
(4365, 2, 13, 60, 'MALLA CUADRADA GALVANIZADA 1', '8.0000'),
(4366, 2, 19, 98, 'PORTA CANDADO 2', '0.0000'),
(4367, 2, 19, 98, 'CANDADO 30MM', '0.0000'),
(4368, 2, 19, 445, 'LAPIZ PASTA AZUL', '0.0000'),
(4369, 2, 19, 445, 'LAPIZ PASTA ROJO', '0.0000'),
(4370, 2, 19, 445, 'LAPIZ PASTA NEGRO', '0.0000'),
(4371, 2, 19, 445, 'PORTAMINA UNIBALL NEGRO 0.7', '0.0000'),
(4372, 2, 19, 445, 'DESTACADOR MORADO', '0.0000'),
(4373, 2, 19, 445, 'DESTACADOR VERDE', '0.0000'),
(4374, 2, 19, 445, 'DESTACADOR NARANJA', '0.0000'),
(4375, 2, 19, 445, 'DESTACADOR ROSADO', '0.0000'),
(4376, 2, 19, 445, 'DESTACADOR CELESTE', '0.0000'),
(4377, 2, 19, 445, 'DESTACADOR AMARILLO', '0.0000'),
(4378, 2, 19, 445, 'ADHESIVO EN BARRA 40GR STICK FIX', '0.0000'),
(4379, 2, 19, 445, 'CLIPS DOBLE NEGRO 12UN 19MM', '0.0000'),
(4380, 2, 19, 445, 'CLIPS DOBLE NEGRO 12UN 32MM', '0.0000'),
(4381, 2, 19, 445, 'CUADERNO UNIVERSITARIO 100 HJS MAT 7MM', '0.0000'),
(4382, 2, 19, 445, 'REGLA METALICA 30CM', '0.0000'),
(4383, 2, 19, 445, 'CARPETA CARTULINA CON PESTA', '0.0000'),
(4384, 2, 19, 445, 'CHINCHE PUNCH PIN COLORES SURTIDOS 50 UNIDADES', '0.0000'),
(4385, 2, 19, 445, 'ELASTICO BLANCO 60X16MM 1000G', '0.0000'),
(4386, 2, 19, 445, 'ACCOCLIP PLASTICO CAJA 50 UN', '0.0000'),
(4387, 2, 19, 98, 'CINCEL HEX PLANO 17 X 22 X 450 HM0810T AKI', '0.0000'),
(4388, 2, 19, 98, 'CINCEL HEX PUNTO 17 X 450 HM0810T AKI', '0.0000'),
(4389, 2, 19, 336, 'TRAPERO CON OJAL ', '0.0000'),
(4390, 2, 5, 336, 'PAÃ‘O', '0.0000'),
(4391, 2, 19, 61, 'LENTE VERATTI', '0.0000'),
(4392, 2, 9, 71, 'HORMIGON HB30 90 20 12', '0.0000'),
(4393, 2, 19, 139, 'AMPOLLETA HALOGENO 500W', '0.0000'),
(4394, 2, 19, 289, 'ARRIENDO HIDROLAVADORA ', '0.0000'),
(4395, 2, 19, 289, 'ARRIENDO ROTOMARTILLO SDS PLUS', '0.0000'),
(4396, 2, 19, 98, 'BOTON PLATICO12 PARA MOLDAJE', '0.0000'),
(4397, 2, 21, 292, 'SERVICIO CURVATURA DE TUBOS', '0.0000'),
(4398, 2, 14, 73, 'BEMEZCLA CHICOTEO 40KG', '0.0000'),
(4399, 2, 14, 73, 'BEMEZCLA ESTUCO EXTERIOR 40KG', '0.0000'),
(4400, 2, 14, 73, 'BEMEZCLA ESTUCO INTERIOR 40KG', '0.0000'),
(4401, 2, 14, 73, 'BEMEZCLA FFL 40KG', '0.0000'),
(4402, 2, 14, 73, 'BEMEZCLA GL FINO 40KG', '0.0000'),
(4403, 2, 14, 73, 'BEMEZCLA PISO 45KG', '0.0000'),
(4404, 2, 14, 73, 'BEMEZCLA REPARACION PLUS  40KG', '0.0000'),
(4405, 2, 17, 72, 'DYNACEM (TINETA)', '0.0000'),
(4406, 2, 19, 446, 'BOLSA BASURA 160X110', '0.0000'),
(4407, 2, 19, 98, 'CANDADO 20MM', '0.0000'),
(4408, 2, 19, 98, 'LLAVERO PLASTICO', '0.0000'),
(4409, 2, 18, 111, 'MONTANTE ECO. 38X38X0,5X2,4M', '5.0000'),
(4410, 2, 18, 111, 'MONTANTE ECO. 38X38X0,5X3M', '5.0000'),
(4411, 2, 18, 111, 'CANAL ECO. 39X20X0,5X3M', '5.0000'),
(4412, 2, 18, 111, 'MONTANTE NORMAL 60X38X0,5X2,4M', '5.0000'),
(4413, 2, 18, 111, 'MONTANTE NORMAL 60X38X0,5X3M', '5.0000'),
(4414, 2, 18, 111, 'CANAL NORMAL 61X20X0,5X3M', '5.0000'),
(4415, 2, 18, 111, 'METALCOM U 2X4X0,85X6M', '85.0000'),
(4416, 2, 18, 111, 'ESQUINERO PERFORADO 30X30X0,4X2,4M', '4.0000'),
(4417, 2, 19, 78, 'ENCHAPE FINO 5', '5.0000'),
(4418, 2, 19, 78, 'PALLET DE PRINCESA', '0.0000'),
(4419, 2, 21, 284, 'FLETE ENCHAPES', '0.0000'),
(4420, 2, 19, 194, 'VOLCAPOL 20MM', '0.0000'),
(4421, 2, 12, 194, 'YESO CARTON STD 1,2X2,4 10MM', '2.0000'),
(4422, 2, 12, 194, 'YESO CARTON STD 1,2X2,4 15MM', '2.0000'),
(4423, 2, 12, 194, 'YESO CARTON RH BR 1,2X2,4 15MM', '2.0000'),
(4424, 2, 12, 194, 'YESO CARTON RF BR 1,2X2,4 12,5MM', '2.0000'),
(4425, 2, 12, 194, 'YESO CARTON RF BR 1,2X2,4 15MM', '2.0000'),
(4426, 2, 8, 192, 'AISLAN GLASS 40 1CARA R94', '0.0000'),
(4427, 2, 8, 192, 'LANA MINERAL 40 LIBRE - R94', '0.0000'),
(4428, 2, 8, 192, 'LANA MINERAL 50 LIBRE - R1122', '0.0000'),
(4429, 2, 14, 204, 'VOLCAFIX 15KG', '0.0000'),
(4430, 2, 14, 196, 'MASILLA BASE 30KG', '0.0000'),
(4431, 2, 14, 196, 'CINTA FIBRA VIDRIO 45ML', '0.0000'),
(4432, 2, 14, 74, 'YESO EXPRESS 30KG', '0.0000'),
(4433, 2, 19, 60, 'BARANDA DE SEGURIDAD ESTANDAR', '0.0000'),
(4434, 2, 19, 98, 'TORNILLO VOLCANITA 6X1 PF', '0.0000'),
(4435, 2, 19, 98, 'TORNILLO VOLCANITA 6X 1 1/4 PF', '0.0000'),
(4436, 2, 19, 98, 'TORNILLO 6X1 5/8 PF', '0.0000'),
(4437, 2, 19, 98, 'TORNILLO 6X2 PF', '0.0000'),
(4438, 2, 20, 98, 'TORNILLO 6X2 1/4 PF', '0.0000'),
(4439, 2, 19, 98, 'TORNILLO VOLCANITA 6X1 1/4 PB', '0.0000'),
(4440, 2, 19, 61, 'PRENSA CROSBY 3/8', '0.0000'),
(4441, 2, 19, 61, 'CABLE ACERADO 3/8', '0.0000'),
(4442, 2, 19, 98, 'TORNILLO 6X1 5/8 PB', '0.0000'),
(4443, 2, 19, 98, 'TORNILLO 6X2 PB', '0.0000'),
(4444, 2, 19, 98, 'TONILLO 8X1/2 LPF', '0.0000'),
(4445, 2, 19, 98, 'TORNILLO CRS 7X3', '0.0000'),
(4446, 2, 19, 139, 'FOCO LED 100W', '0.0000'),
(4447, 2, 10, 135, 'CORDON ELECTRICO 3X1', '5.0000'),
(4448, 2, 19, 61, 'POLERA POLO MANGA LARGA', '0.0000'),
(4449, 2, 19, 98, 'REMACHE POP 3.2', '0.0000'),
(4450, 2, 19, 98, 'BROCA METAL 3.5', '0.0000'),
(4451, 2, 19, 98, 'BOMBA PARA TRASBASIJE', '0.0000'),
(4452, 2, 19, 119, 'LISTON ALAMO 33X33MM 3.2MT', '0.0000'),
(4453, 2, 14, 73, 'PONTESTUCO', '0.0000'),
(4454, 2, 14, 73, 'BEMEZCLA PEGAENCHAPE', '0.0000'),
(4455, 2, 2, 289, 'ARRIENDO PISTOLA FIJACION', '0.0000'),
(4456, 2, 21, 328, 'REPARACION CINCELADOR MAKITA', '0.0000'),
(4457, 2, 2, 289, 'ARRIENDO SOLDADORA 200 AMP', '0.0000'),
(4458, 2, 19, 284, 'FLETE CAMION PLUMA ', '0.0000'),
(4459, 2, 18, 101, 'PERFIL CUADRADO 100X100X4MMX6M', '0.0000'),
(4460, 2, 18, 101, 'PERFIL CUADRADO 50X50X3MMX6M', '0.0000'),
(4461, 2, 18, 101, 'ANGULO DOBLADO 50X3MM', '0.0000'),
(4462, 2, 13, 200, 'MEMBRANA ASFALTICA1X10MX3MM', '0.0000'),
(4463, 2, 19, 98, 'SOPLETE A GAS CON BOQUILLA', '0.0000'),
(4464, 2, 17, 204, 'DINEX TABIQUE TINETA', '0.0000'),
(4465, 2, 14, 73, 'ESTUCO TERMICO PRESEC T-25 ', '0.0000'),
(4466, 2, 14, 204, 'BEKRON DA 25KG', '0.0000'),
(4467, 2, 14, 204, 'BEKRON DA GRUESO25KG', '0.0000'),
(4468, 2, 14, 204, 'BEKRON AC POLVO 25KG', '0.0000'),
(4469, 2, 12, 225, 'TERMOPOL 30KG/M3 250X3000X1000', '0.0000'),
(4470, 2, 19, 230, 'WC 2 PIEZAS INDO CON TAPA SLOW CLOSE (PISO 30,5CM) REF:55-S-BL', '5.0000'),
(4471, 2, 19, 227, 'SELLO ANTIFUGA PARA INODORO', '0.0000'),
(4472, 2, 19, 227, 'LLAVE ANGULAR Y FLEXIBLE 1/2', '0.0000'),
(4473, 2, 19, 230, 'WC 2 PIEZAS INDO CON TAPA SLOW CLOSE (MURO) REF: 55-P-BL', '0.0000'),
(4474, 2, 19, 227, 'MONOMANDO  LAVAMANOS MODELO YPSILON PLUS REF:6401', '0.0000'),
(4475, 2, 19, 227, 'MONOMANDO DUCHA YPSILON PLUS COMPLETA REF: 6408T1', '0.0000'),
(4476, 2, 19, 227, 'MONOMANDO DUCHA YPSILON PLUS  REF: 6408NS', '0.0000'),
(4477, 2, 19, 227, 'BARRA COMPLETA DUCHA POLO T1', '0.0000'),
(4478, 2, 19, 227, 'MONOMANDO EXT. DE TINA-DUCHA MODELO YPSILON PLUS COMPLETA REF 6405T1', '0.0000'),
(4479, 2, 19, 227, 'MONOMANDO COCINA YPSILON PLUS CUELLO CISNE REF: 6436', '0.0000'),
(4480, 2, 19, 227, 'GRIFERIA MON LAVADERO IPSILON PLUS REF: 6417', '0.0000'),
(4481, 2, 19, 229, 'MUEBLE + CUBIERTA VANITORIO LOSA 2 PUERTAS REF: SLT-T089-1-C (600x460x470)', '0.0000'),
(4482, 2, 19, 229, 'MUEBLE + CUBIERTA VANITORIO LOSA 2 PUERTAS REF: SLT-T088-2-C (700x460x470)', '0.0000'),
(4483, 2, 19, 229, 'MUEBLE + CUBIERTA VANITORIO LOSA 2 PUERTAS REF: SLT-T088-4-C (900x460x470)', '0.0000'),
(4484, 2, 19, 229, 'LAVAMANO C/ PEDESTAL MODELO BARI MONOFORO', '0.0000'),
(4485, 2, 19, 235, 'CAMPANA TWIN 60 LED', '0.0000'),
(4486, 2, 19, 235, 'ENCIMERA 4T GLX 60', '0.0000'),
(4487, 2, 19, 235, 'HORNO ELEGANCE III', '0.0000'),
(4488, 2, 8, 188, 'PISO FLOTANTE DEVI OAK', '0.0000'),
(4489, 2, 8, 185, 'CERAMICA MK QUADRA TAUPE 40X40 LISO MATE PISO', '0.0000'),
(4490, 2, 8, 185, 'CERAMICA MK MAXIMA BLANCO 60X60 PISO', '0.0000'),
(4491, 2, 8, 185, 'CERAMICA MK QUADRA OLIVE 40X40 LISO MATE AREAS COMUNES', '0.0000'),
(4492, 2, 8, 185, 'CERAMICA MK COTO PLATA 46X46 GRIS MEDIO MATE ARES COMUNES', '0.0000'),
(4493, 2, 8, 185, 'CERAMICA MK MAXIMA BLANCO 30X60 REVESTIMIENTOS', '0.0000'),
(4494, 2, 18, 111, 'CANAL NORMAL 91X20X0,5X3M', '5.0000'),
(4495, 2, 19, 98, 'BROCA ACERO RAPIDO 4MM', '0.0000'),
(4496, 2, 8, 185, 'CERAMICA GRES PORCELANICO RENLEZ/RPC WOOD ROBLE BLANCO 15X60 DUOMO', '0.0000'),
(4497, 2, 8, 185, 'CERAMICA GRES PORCELANICO ATENAS GRIS CAFE 60X60 DUOMO', '0.0000'),
(4498, 2, 8, 185, 'CERAMICA GRES PORCELANICO ATENAS GRIS CAFE 30X60 DUOMO', '0.0000'),
(4499, 2, 8, 185, 'CERAMICA ESMALTADA ATIKA 40X40 ', '0.0000'),
(4500, 2, 8, 185, 'CERAMICA PORCELANATO INNOGRES 60X60 COLD GREY AREAS COMUNES', '0.0000'),
(4501, 2, 8, 185, 'CERAMICA PORCELANATO INNOGRES 30X60 IRON GREY AREAS COMUNES', '0.0000'),
(4502, 2, 8, 185, 'CERAMICA PORCELANATO INNOGRES 30X60 COLD GRAY REVESTIMIENTOS', '0.0000'),
(4503, 2, 19, 227, 'PLATO DUCHA SOHO 150X70', '0.0000'),
(4504, 2, 19, 227, 'PLATO DUCHA GOSE', '0.0000'),
(4505, 2, 19, 227, 'MAMPARA FIJA 90X190 CM', '0.0000'),
(4506, 2, 19, 238, 'MUEBLE KOMMODE 120X44X56CM', '0.0000'),
(4507, 2, 19, 229, 'LAVABO N-KNUT SOBREMUEBLE 120X46CM', '0.0000'),
(4508, 2, 19, 227, 'DESAGUE CON TAPON Y CADENILLA', '0.0000'),
(4509, 2, 19, 231, 'SIFON BOTELLA 1 1/4 PLASTICO', '0.0000'),
(4510, 2, 19, 228, 'BAÃ‘ERA ACERO ROCA 150X70', '0.0000'),
(4511, 2, 19, 228, 'BAÃ‘ERA ACERO ROCA 140X70', '0.0000'),
(4512, 2, 19, 228, 'BAÃ‘ERA ACERO ROCA 120X70', '0.0000'),
(4513, 2, 19, 228, 'CONJUNTO BAÃ‘ERA CON REBALSE 1 1/2\"', '0.0000'),
(4514, 2, 19, 229, 'LAVAPLATO ELIPSE 2 CUBETAS 82X47X23', '0.0000'),
(4515, 2, 19, 229, 'DESAGUE LAVAPLATO CON CANASTILLO Y REBALSE', '0.0000'),
(4516, 2, 19, 229, 'SIF', '0.0000'),
(4517, 2, 19, 229, 'LAVAPLATO RUTI 45X49', '0.0000'),
(4518, 2, 19, 229, 'SIFON BOTELLA LAVAPLATO RUTI', '0.0000'),
(4519, 2, 19, 229, 'LAVARROPA KUBA ', '0.0000'),
(4520, 2, 19, 229, 'MUEBLE LAVARROPA KUBA ', '0.0000'),
(4521, 2, 19, 229, 'DESAGUE LAVARROPA KUBA ', '0.0000'),
(4522, 2, 19, 229, 'REBALSE LAVARROPA KUBA ', '0.0000'),
(4523, 2, 19, 227, 'TOALLERO ANILA CUADRADO', '0.0000'),
(4524, 2, 19, 227, 'PERCHA REDE', '0.0000'),
(4525, 2, 19, 227, 'PORTARROLLO REDE', '0.0000'),
(4526, 2, 19, 227, 'RECK JABONERA SOBREPONER 26X12X6CM', '0.0000'),
(4527, 2, 19, 231, 'SIFON BAÃ‘ERA 1 1/2\"', '0.0000'),
(4528, 2, 19, 227, 'PORTARROLLO MONAT', '0.0000'),
(4529, 2, 19, 227, 'PERCHA MONAT', '0.0000'),
(4530, 2, 19, 227, 'REPISA DE VIDRIO', '0.0000'),
(4531, 2, 19, 227, 'TOALLERO CUADRADO REDE', '0.0000'),
(4532, 2, 19, 227, 'SIFON LAVAPLATO DOBLE', '0.0000'),
(4533, 2, 19, 229, 'LAVAPLATO ELIPSE UNA CUBETA 42X47X23CM', '0.0000'),
(4534, 2, 19, 227, 'LLAVE ANTIFRAUDE', '0.0000'),
(4535, 2, 22, 225, 'AISLAPOL PERLA 250 LITROS', '0.0000'),
(4536, 2, 19, 231, 'LAVARROPA PLASTICO 40X50', '0.0000'),
(4537, 2, 19, 67, 'TALADRO C/ MANDRIL', '0.0000'),
(4538, 2, 19, 67, 'TALADRO C/ MANDRIL', '0.0000'),
(4539, 2, 19, 67, 'CINCELADOR 5K', '0.0000'),
(4540, 2, 19, 67, 'ATORNILLADOR ELECTRICO', '0.0000'),
(4541, 2, 19, 67, 'ATORNILLADOR ELECTRICO', '0.0000'),
(4542, 2, 19, 62, 'ALICATE ENFIERRADOR', '0.0000'),
(4543, 2, 19, 98, 'DISCO CORTE DIAMANTADO 14', '0.0000'),
(4544, 2, 19, 67, 'MEZCLADOR ELECTRICO', '0.0000'),
(4545, 2, 19, 98, 'BROCA SDS PLUS 20X450MM', '0.0000'),
(4546, 2, 19, 98, 'BROCA SDS PLUS 14X350MM', '0.0000'),
(4547, 2, 18, 101, 'PERFIL RECTANGULAR 40X20X2MM', '0.0000'),
(4548, 2, 18, 101, 'FIERRO LISO 16MM', '0.0000'),
(4549, 2, 18, 111, 'ANGULO METALCOM 30X30X6000', '0.0000'),
(4550, 2, 19, 98, 'TAMBOR PLASTICO180LT', '0.0000'),
(4551, 2, 19, 98, 'BIDON 60LT CON LLAVE', '0.0000'),
(4552, 2, 13, 60, 'MALLA HEXAGONAL 3/4 X 1.50 X 50MT', '0.0000'),
(4553, 2, 13, 98, 'FILM PROTECTOR PISO', '0.0000'),
(4554, 2, 13, 98, 'FILM PROTECTOR VENTANA', '0.0000'),
(4555, 2, 13, 98, 'CARTON CORRUGADO', '0.0000'),
(4556, 2, 10, 98, 'MOLDURA NOMASTIL TIPO F', '0.0000'),
(4557, 2, 12, 121, 'PLANCHA MDF 30MM', '0.0000'),
(4558, 2, 12, 121, 'PLANCHA MDF 15MM', '0.0000'),
(4559, 2, 19, 98, 'SILICONA NEUTRA BLANCO CON FUNGICIDA', '0.0000'),
(4560, 2, 19, 98, 'SILICONA NEUTRA TRANSPARENTE CON FUNGICIDA', '0.0000'),
(4561, 2, 19, 98, 'SILICONA ACRYLICA BLANCA', '0.0000'),
(4562, 2, 19, 98, 'POLIFLEX GRIS', '0.0000'),
(4563, 2, 19, 98, 'POLIFLEX BLANCO', '0.0000'),
(4564, 2, 19, 98, 'ESPUMA EXPANDIBLE', '0.0000'),
(4565, 2, 19, 98, 'PISTOLA POLIFLEX', '0.0000'),
(4566, 2, 19, 98, 'PISTOLA SILICONA', '0.0000'),
(4567, 2, 8, 191, 'PAPEL MURAL SOLID VINIL DESIGN ARPILLERA BLANCO', '0.0000'),
(4568, 2, 19, 81, 'ESPUMA DE POLIURETANO EXPANDIBLE 500ML', '0.0000'),
(4569, 2, 19, 445, 'CINTA EMBALAJE CAFE', '0.0000'),
(4570, 2, 19, 445, 'CINTA EMBALAJE TRANSPARENTE', '0.0000'),
(4571, 2, 19, 98, 'TRIPODE NIVEL LASER', '0.0000'),
(4572, 2, 19, 214, 'ITALINNEA MANILLON 30X600X900 (ACC EDIFICIO)', '0.0000'),
(4573, 2, 19, 214, 'ITALINNEA CERRADURA SEG L4 (ACC EDIFICIO)', '0.0000'),
(4574, 2, 19, 214, 'ITALINNEA DESTRABADOR ELECTRICO 12V 50W (ACC EDIFICIO)', '0.0000'),
(4575, 2, 19, 214, 'ITALINNEA TRANSFORMADOR ELECTRICO 12V 50W (ACC EDIFICIO)', '0.0000'),
(4576, 2, 19, 214, 'ITALINNEA INTERRUPTOR ELECTRICO PARA DESTRABADOR (ACC EDIFICIO)', '0.0000'),
(4577, 2, 19, 214, 'ITALINNEA TAPA ALUMINIO PARA INTERRUPTOR DESTRABADOR (ACC EDIFICIO)', '0.0000'),
(4578, 2, 19, 214, 'ITALINNEA QUICIO HID FEV 5004N 200KG 135C (ACC EDIFICIO)', '0.0000'),
(4579, 2, 19, 214, 'ITALINNEA HERRAJE SUPERIOR PARA QUICIO (ACC EDIFICIO)', '0.0000'),
(4580, 2, 19, 214, 'ITALINNEA HERRAJE INFERIOR PARA QUICIO (ACC EDIFICIO)', '0.0000'),
(4581, 2, 19, 214, 'ITALINNEA CERRADURA SEG L4 (ACC DEPTO)', '0.0000'),
(4582, 2, 19, 214, 'ITALINNEA MANILLON 19X200X300 (ACC DEPTO)', '0.0000'),
(4583, 2, 19, 214, 'ITALINNEA CERRADURA L1 LLAVE SAN PEDRO (DORMITORIO 1)', '0.0000'),
(4584, 2, 19, 214, 'ITALINNEA CERRADURA L2 (DORMITORIO 2-3', '0.0000'),
(4585, 2, 19, 214, 'ITALINNEA CERRADURA L1 LLAVE SAN PEDRO (CLOSET)', '0.0000'),
(4586, 2, 19, 214, 'ITALINNEA CERRADURA L3 (COCINA', '0.0000'),
(4587, 2, 19, 214, 'ITALINNEA CERRADURA POMO (BODEGAS)', '0.0000'),
(4588, 2, 19, 214, 'ITALINNEA CERRADURA L3 F60 (CAJA ESCALA)', '0.0000'),
(4589, 2, 19, 214, 'ITALINNEA CIERRA PUERTA HIDRAULICO 1800 40-80 KG', '0.0000'),
(4590, 2, 19, 214, 'ITALINNEA CERRADURA L1 LLAVE SAN PEDRO (SALA BASURA', '0.0000'),
(4591, 2, 19, 214, 'ITALINNEA CERRADURA L1 LLAVE SAN PEDRO (NICHOS IGUALADAS)', '0.0000'),
(4592, 2, 19, 214, 'ITALINNEA CERRADURA L2 (BA', '0.0000'),
(4593, 2, 19, 214, 'ITALINNEA CERRADURA SEG (GYM', '0.0000'),
(4594, 2, 19, 214, 'ITALINNEA CERRADURA SEG (QUINCHO PISCINA)', '0.0000'),
(4595, 2, 19, 214, 'ITALINNEA BARRA ANTIPANICO 80 F60', '0.0000'),
(4596, 2, 19, 214, 'ITALINNEA TOPE PUERTA 5-G NIQUEL SATIN', '0.0000'),
(4597, 2, 19, 214, 'ITALINNEA TOPE PUERTA MURO 20-GLD ACERO INOX', '0.0000'),
(4598, 2, 19, 214, 'ITALINNEA KIT 20/30MM FIJACION DOBLE MADERA/CRISTAL(ACC EDIFICIO)', '0.0000'),
(4599, 2, 19, 214, 'ITALINNEA KIT 1/19MM FIJACION INDIVIDUAL MADERA/CRISTAL(ACC DEPTO)', '0.0000'),
(4600, 2, 19, 214, 'ITALINNEA PICAPORTE 320 20CM AGB NIQUELADO', '0.0000'),
(4601, 2, 19, 214, 'ITALINNEA PICAPORTE 320 30CM AGB NIQUELADO', '0.0000'),
(4602, 2, 5, 98, 'VASELINA SOLIDA', '0.0000'),
(4603, 2, 19, 229, 'SIFON BOTELLA LAVAPLATO 1 1/2\"', '0.0000'),
(4604, 3, 43, 509, 'Clavo acero 1', '0.0000'),
(4605, 2, 19, 289, 'ARRIENDO TURBO CALEFACTOR GAS 220V', '0.0000'),
(4606, 2, 19, 289, 'ARRIENDO CILINDRO GAS LICUADO 11K', '0.0000'),
(4607, 2, 19, 289, 'ARRIENDO PULIDORA 5\"', '0.0000');

-- --------------------------------------------------------

--
-- Table structure for table `measures`
--

CREATE TABLE `measures` (
  `id_measure` int(11) NOT NULL,
  `fk_id_establishment` int(11) NOT NULL,
  `abbreviation` varchar(16) NOT NULL,
  `terminology` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `measures`
--

INSERT INTO `measures` (`id_measure`, `fk_id_establishment`, `abbreviation`, `terminology`) VALUES
(1, 2, 'bidon', 'bidon 5 litros'),
(2, 2, 'dia', 'dia'),
(3, 2, 'galon', 'galon'),
(4, 2, 'h', 'hora'),
(5, 2, 'kg', 'kilogramo'),
(6, 2, 'l', 'litro'),
(7, 2, 'm', 'metro'),
(8, 2, 'm2', 'metro cuadrado'),
(9, 2, 'm3', 'metro cubico'),
(10, 2, 'ml', 'metro lineal'),
(11, 2, 'par', 'par'),
(12, 2, 'plancha', 'plancha'),
(13, 2, 'rollo', 'rollo'),
(14, 2, 'saco', 'saco'),
(15, 2, 'set', 'juego'),
(16, 2, 'tambor', 'tambor'),
(17, 2, 'tineta', 'tineta'),
(18, 2, 'tira', 'tira'),
(19, 2, 'un', 'unidad'),
(20, 2, 'mts', 'metros'),
(21, 2, 'global', 'global'),
(22, 2, 'bolsa', 'bolsa'),
(23, 2, 'lt', 'litro'),
(24, 2, 'pq', 'paquete'),
(25, 3, 'bidon', 'bidon 5 litros'),
(26, 3, 'dia', 'dia'),
(27, 3, 'galon', 'galon'),
(28, 3, 'h', 'hora'),
(29, 3, 'kg', 'kilogramo'),
(30, 3, 'l', 'litro'),
(31, 3, 'm', 'metro'),
(32, 3, 'm2', 'metro cuadrado'),
(33, 3, 'm3', 'metro cubico'),
(34, 3, 'ml', 'metro lineal'),
(35, 3, 'par', 'par'),
(36, 3, 'plancha', 'plancha'),
(37, 3, 'rollo', 'rollo'),
(38, 3, 'saco', 'saco'),
(39, 3, 'set', 'juego'),
(40, 3, 'tambor', 'tambor'),
(41, 3, 'tineta', 'tineta'),
(42, 3, 'tira', 'tira'),
(43, 3, 'un', 'unidad');

-- --------------------------------------------------------

--
-- Table structure for table `moldings`
--

CREATE TABLE `moldings` (
  `id_molding` int(11) NOT NULL,
  `fk_id_establishment` int(11) NOT NULL,
  `fk_id_provider` int(11) NOT NULL,
  `fk_id_expense_account` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moldings`
--

INSERT INTO `moldings` (`id_molding`, `fk_id_establishment`, `fk_id_provider`, `fk_id_expense_account`, `name`, `created_at`) VALUES
(5, 2, 3, 2, 'UNISPAN', '0000-00-00 00:00:00'),
(6, 2, 14, 2, 'ANDAMIK', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `moldings_guides`
--

CREATE TABLE `moldings_guides` (
  `id_molding_guide` int(11) NOT NULL,
  `fk_id_molding` int(11) NOT NULL,
  `type` varchar(12) NOT NULL,
  `number` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `observation` varchar(512) NOT NULL,
  `status` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `moldings_guides_details`
--

CREATE TABLE `moldings_guides_details` (
  `id_molding_guide_detail` int(11) NOT NULL,
  `fk_id_molding_guide` int(11) NOT NULL,
  `fk_id_molding_piece` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `moldings_pieces`
--

CREATE TABLE `moldings_pieces` (
  `id_molding_piece` int(11) NOT NULL,
  `fk_id_molding` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `weight` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moldings_pieces`
--

INSERT INTO `moldings_pieces` (`id_molding_piece`, `fk_id_molding`, `code`, `name`, `weight`) VALUES
(2, 6, '1725157', 'BARANDILLA ACERO 1,57 M', 0.00),
(3, 6, '1700200', 'MARCO EUROBLITZ 2,00 X 0,73 M', 0.00),
(4, 6, '1725207', 'BARANDILLA ACERO 2,07 M', 0.00),
(5, 6, '1725257', 'BARANDILLA ACERO 2,57 M', 0.00),
(6, 6, '1725307', 'BARANDILLA ACERO 3,07 M', 0.00),
(7, 6, '1727207', 'HORIZONTAL 2,07 M', 0.00),
(8, 6, '1727257', 'HORIZONTAL 2,57 M', 0.00),
(9, 6, '1727307', 'HORIZONTAL 3,07 M', 0.00),
(10, 6, '1728157', 'BARANDILLA DOBLE ACERO 1,57 M', 0.00),
(11, 6, '1728722', 'BARANDILLA LATERAL DOBLE 0,73 M', 0.00),
(12, 6, '1736207', 'DIAGONAL 2,07 M BLITZ', 0.00),
(13, 6, '1736257', 'DIAGONAL 2,57 M BLITZ', 0.00),
(14, 6, '1736307', 'DIAGONAL 3,07 M BLITZ', 0.00),
(15, 6, '1742722', 'HORIZONTAL \"U\" CON GRAPA 0,73 M', 0.00),
(16, 6, '1744722', 'MENSULA 0,73 M BLITZ', 0.00),
(17, 6, '1745322', 'MENSULA 0,36 M BLITZ', 0.00),
(18, 6, '1755069', 'ANCLAJE BLITZ', 0.00),
(19, 6, '1757073', 'RODAPIE LATERAL 0,73 M', 0.00),
(20, 6, '1757157', 'RODAPIE 1,57 M', 0.00),
(21, 6, '1757207', 'RODAPIE 2,07 M', 0.00),
(22, 6, '1757257', 'RODAPIE 2,57 M', 0.00),
(23, 6, '1757307', 'RODAPIE 3,07 M', 0.00),
(24, 6, '3812157', 'PLATAFORMA ACERO 0,32 X 1,57 M - PERF', 0.00),
(25, 6, '3812207', 'PLATAFORMA ACERO 0,32 X 2,07 M - PERF', 0.00),
(26, 6, '3812257', 'PLATAFORMA ACERO 0,32 X 2,57 M - PERF', 0.00),
(27, 6, '3812307', 'PLATAFORMA ACERO 0,32 X 3,07 M - PERF', 0.00),
(28, 6, '3837157', 'PLATAFORMA ROBUST CON TRAMPILLA 1,57 M', 0.00),
(29, 6, '3838257', 'PLATAFORMA ROBUST CON ESCALERA 2,57 M', 0.00),
(30, 6, '4001060', 'BASE REGULABLE 0,60 M', 0.00),
(31, 6, '4005007', 'ESCALERILLA', 0.00),
(32, 6, '4600150', 'TUBO ACERO CORTADO A 1,50 M', 0.00),
(33, 6, '4600200', 'TUBO ACERO CORTADO A 2,00 M', 0.00),
(34, 6, '4600250', 'TUBO ACERO CORTADO A 2,50 M', 0.00),
(35, 6, '4600300', 'TUBO ACERO CORTADO A 3,00 M', 0.00),
(36, 6, '4700022', 'GRAPA ORTOGONAL 22 MM', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id_provider` int(11) NOT NULL,
  `fk_id_establishment` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `rut` varchar(10) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id_provider`, `fk_id_establishment`, `name`, `rut`, `mail`, `address`, `phone`) VALUES
(3, 2, 'ACEROS TERRA SOCIEDAD ANONIMA', '76185809-2', '', 'YUNGAY 2334 VALAPARAISO', '73982009'),
(4, 2, 'ACRILICO NORGLAS', '80008300-1', '', 'SANTA ELENA 1781 SANTIAGO', '942298264\r'),
(5, 2, 'ADS - CHILE LTDA', '76063753-k', '', 'PANAMERICANA NORTE 20500', '224130000'),
(6, 2, 'AGUA PURIFICADA SILVA LIMITADA', '76133486-7', '', 'OROMPELLO 456, BELLOTO NORTE, QUILPUE', '2114600\r'),
(7, 2, 'AGUATOP LTDA.', '78820070-6', '', 'VILLANELO 180 OF 1106, VI', '032-2398652\r'),
(8, 2, 'AISLANTES NACIONALES', '76350871-4', '', 'SENADOR JAIME GUSMAN 220, QUILICURA, SANTIAGO', '6033007\r'),
(9, 2, 'ALEX SOTO Y COMP. LTDA', '76195249-8', '', 'SENDERO DEL NORTE 55 DTO 162 TORRE B', '76201811\r'),
(10, 2, 'AMERICAN SCREW CHILE', '91410000-3', '', 'CAMINO A MELIPILLA 10338', '224407000\r'),
(11, 2, 'AMINFO LTDA.', '78191700-1', '', 'HUELEN 224, OF 201, PROVIDENCIA, SANTIAGO', '223749980\r'),
(12, 2, 'ARIDOS BOCO LTDA.', '76663070-7', '', 'AVDA. VALPARAISO # 1688, QUILLOTA', '76621953\r'),
(13, 2, 'ARIDOS Y MOVIMIENTOS MADARIAGA LIMITADA', '76535302-5', '', 'WILLIAMSON 291 VILLA ALEMANA', '99698740\r'),
(14, 2, 'ARIEL PINOCHET SOTO', '7287447-1', '', 'LOS TEHUELCHES # 5709', '993343937\r'),
(15, 2, 'ARMOR SEGURIDAD INDUSTRIAL', '76372763-7', '', 'DE LA LOMA 2585 OJOS DE AGUA VILLA ALEMANA', '52175279\r'),
(17, 2, 'ASCENSORES SCHINDLER S.A.', '93565000-3', '', 'NUEVA PROVIDENCIA #1901 PISO 14', '227537772\r'),
(18, 2, 'ASFALTOS CHILENOS SA', '92242000-9', '', 'CAMINO A QUINTERO 2001', '32-2812388\r'),
(19, 2, 'ATIKA S.A.', '85218700-k', '', 'AV. VITACURA 5770', '224883157\r'),
(20, 2, 'AUSIN', '81293200-4', '', 'AV MATUCANA 205', '26810560\r'),
(21, 2, 'AUSIN HNOS. S.A.', '81293200-4', '', 'JOSE JOAQUIN PEREZ 6009, QUINTA NORMAL', '27722115\r'),
(22, 2, 'BAEBSA S.A.', '76336177-2', '', 'EL GUANACO NORTE # 6464', '232179053\r'),
(23, 2, 'BALLO SPA', '76196541-7', '', 'APOQUINDO 4009, LAS CONDES', '998178444\r'),
(24, 2, 'BARAHONA Y CIA LTDA.', '78212000-K', '', 'MALAGA 115 OF 1203-1205, LAS CONDES', '22 228 0908\r'),
(25, 2, 'BASF', '80043600-1', '', 'AV CARRASCAL 3851, QUINTA NORMAL', '22 799 4316\r'),
(26, 2, 'BERRYNALLY', '91905000-4', '', 'AVDA. EINTEIN #568', '226216231\r'),
(27, 2, 'BIOSAN', '77825490-5', '', 'LLANO SUBERCASEUX 4005 OF 501 SAN MIGUEL', '225553000\r'),
(28, 2, 'BMP INSTRUMENTOS TOPOGRAFICOS', '78914330-7', '', 'ARLEGUI # 160, VI', '2696678\r'),
(29, 2, 'BOTTAI S.A.', '80125100-5', '', 'PANAMERICANA SUR KM 16', '24131212\r'),
(30, 2, 'BUSTAMANTE MU', '78914330-7', '', 'TENIENTE COMPTON #200 ', '222055596\r'),
(31, 2, 'CARLOS HERRERA ARREDONDO LIMITADA', '77201840-1', '', 'ALONSO DE CORDOVA 5900 OF 1501, LAS CONDES, SANTIAGO', '225500139\r'),
(32, 2, 'CAROLINA MAGDALENA ULLOA ULLOA', '15400281-2', '', 'PASAJE MONTE MACALU 860', '9981433277\r'),
(33, 2, 'CEMENTOS LA UNION S.A.', '99587520-9', '', 'ROGER DE FLOR 2950 5 PISO', '24303300\r'),
(34, 2, 'CENTRO ARRIENDO LIMITADA', '78973280-9', '', '13 NORTE # 1389, VI', '2681488\r'),
(35, 2, 'CENTRO MAQUINAS CHILE', '76010123-0', '', 'TOMAS ALBA EDISON 515 QUILPUE', '982886317\r'),
(36, 2, 'CENTRO MAQUNA CHILE S.A.', '76010123-0', '', 'CALLE THOMAS ALBA EDISON , 0515', '82886317\r'),
(37, 2, 'CERAMICAS CORDILLERAS SA', '76121797-6', '', 'CAMINO LO BOZA 120 A PUDAHUEL', '3874365\r'),
(38, 2, 'CERAMICAS SANTIAGO S.A.', '84976200-1', '', 'AVENIDA ITALIA 100 BATUCO', '227505900\r'),
(39, 2, 'CHCR CONSTRUCCIONES S.A.', '76007979-0', '', 'AV. PRESIDENTE RIESCO 5711 OF.302', '229543990\r'),
(40, 2, 'CINTAC S.A.I.C.', '96705210-8', '', 'CAMINO A MELIPILLA 8920 MAIPU', '24849200\r'),
(41, 2, 'COMERCIAL A Y B LIMITADA', '78634910-9', '', 'LA ESTERA 525, PARQUE INDUSTRIAL VALLE GRANDE, SANTIAGO', '27385230\r'),
(42, 2, 'COMERCIAL CINCO EFE LIMITADA', '76328794-7', '', 'BOMBERO RAMON CORNEJO # 0854 RECOLETA', '226291788\r'),
(43, 2, 'COMERCIAL CYC EIRL', '76151399-0', '', 'PASAJE CORAL 895 CRUZ DEL SUR LA CALERA', '332263702\r'),
(44, 2, 'COMERCIAL DEN BRAVEN CHILE LTDA', '77587160-1', '', 'CHILOE 1375', '25441250\r'),
(45, 2, 'COMERCIAL DIVAL LIMITADA', '78945990-8', '', 'AVDA. BERNARDO LEIGHTON # 1651, VILLA ALEMANA', '90156141\r'),
(46, 2, 'COMERCIAL E INVERSIONES GLP CHILE LIMITADA', '76058980-2', '', 'SAN ANTONIO # 1153, VI', '2693960\r'),
(47, 2, 'COMERCIAL E INVERSIONES GLP CHILE LTDA', '76058980-2', '', '4-ORIENTE N', '32-2691349\r'),
(48, 2, 'COMERCIAL GOMILANDIA', '83336400-6', '', 'PORTUGAL 652', '222225174\r'),
(49, 2, 'COMERCIAL HISPANO CHILENA LTDA', '79903920-6', '', 'ISABEL LA CATOLICA 1537 LAS CONDES', '262200594\r'),
(50, 2, 'COMERCIAL PROLOCK SPA', '76524630-K', '', 'PINTOR CICARELLI N', '225440612\r'),
(51, 2, 'COMERCIAL SANDOVAL Y CIA LTDA', '76161840-7', '', 'CAMINO LOS PINOS PARCELA 39B', '225613609\r'),
(52, 2, 'COMERCIAL SELLOTEC', '76072694-K', '', 'PATRICIA VI', '26569500\r'),
(53, 2, 'COMERCIAL TODO FIERRO LTDA', '78639360-4', '', 'AV GABRIELA #03750 PTE ALTO', '225424451-994495152\r'),
(54, 2, 'COMERCIAL Y PROVEEDORA DE PRODUCTOS ESPECIALES LTDA', '77358940-2', '', 'AVDA EDUARDO FREI MONTALVA 3525 CONCHALI', '2421599\r'),
(55, 2, 'COMERCIALIZADORA BASKAKOW S.A.', '76129295-1', '', 'PETROHUE 2310, PEDRO AGIRRE CERDA', '(02) 2 763 66 00\r'),
(56, 2, 'COMERCIALIZADORA BASKAKOW S.A.', '76129295-1', '', 'PETROHUE 2310, PEDRO AGIRRE CERDA', '227636600\r'),
(57, 2, 'COMERCIALIZADORA COVASA LIMITADA', '76593000-6', '', 'JOSE JOAQUIN PEREZ 4357', '7868361\r'),
(58, 2, 'COMERCIALIZADORA DE MADERAS IMPREGNADAS CONCON LIMITADA', '76034901-1', '', 'CAMINO CONCON QUINTERO KM2', '322811985\r'),
(59, 2, 'COMERCIALIZADORA FREEMAN SPA', '76683328-4', '', 'EL QUILO 5428 QUINTA NORMAL', '227756287\r'),
(60, 2, 'COMPA', '91531000-1', '', 'FREIRE 725', '223285000\r'),
(61, 2, 'CONSTRUCCIONES Y MONTAJE ARAYA LTDA', '76014025-2', '', 'AVDA LAS REJAS 774', '27746877\r'),
(62, 2, 'CONSTRUCTORA SZABA LIMITADA', '76091528-9', '', 'MAMI', '92194984\r'),
(63, 2, 'CONSTRUMART S.A.', '96511460-2', '', 'PANAMERICANA NORTE # 9275, QUILICURA, SANTIAGO', '99197942\r'),
(64, 2, 'CONTAINER EXPRESS', '76054045-5', '', 'AV NVA PROVIDENCIA 1881', '999458579\r'),
(65, 2, 'CONTAINER SUDAMERICA S.A', '76410173-1', '', 'AV. CERRO EL ALTAR 3320 PARQUE IND. VALPARAISO', '984292186\r'),
(66, 2, 'COPEC S.A.', '99520000-7', '', 'AGUSTINAS 1382, SANTIAGO', '97397340\r'),
(67, 2, 'COVASA', '7659300-6', '', 'JOSE JOAQUIN PERZ 4357 QUINTA NORMAL', '77951441\r'),
(69, 2, 'CRISTIAN GAETE NU', '12823557-4', '', 'PARCELA 25, LOTE B, LOS LEONES, LIMACHE', '82195861\r'),
(70, 2, 'CRISTIAN RODRIGO TORRES HERRERA', '14134866-3', '', 'VILCABAMBA 6260 LO PRADO, SANTIAGO', '982391755\r'),
(71, 2, 'DARCON LTDA', '7761418-1', '', 'RAFAEL SOTOMAYOR 830', '24849200\r'),
(72, 2, 'DARCON LTDA', '7761418-1', '', 'RAFAEL SOTOMAYOR 830', '24849200\r'),
(73, 2, 'DAZA LTDA', '76124173-7', '', 'GENERAL GANA #755', '225546722\r'),
(74, 2, 'DIAZ Y QUIROGA Y COMPA', '76024831-2', '', 'CABO PILAR 21 SONAP RECREO ALTO VI', '32-2615794\r'),
(75, 2, 'DICONSMETAL LTDA', '76444222-9', '', 'LO ESPINOZA 2665 A QUINTA NORMAL', '229324886\r'),
(76, 2, 'DIMACOFI NEGOCIOS AVANZADOS S.A.', '76570350-6', '', 'VITACURA 2939, PISO 15, LAS CONDES', '25497777\r'),
(77, 2, 'DIMERC S.A.', '96670840-9', '', 'ALBERTO PEPPER 1784, RENCA, SANTIAGO', '3858000\r'),
(78, 2, 'DIPERK SAC', '93641000-6', '', 'AV COLORADO 641 QUILICURA', '26203969\r'),
(79, 2, 'DIPROMAT', '99541390-6', '', 'MARGA MARGA 2592', '322829100\r'),
(80, 2, 'DISAL CHILE LTDA.', '96824110-9', '', 'DECIMA AVENIDA #2480, NUEVA PLACILLA, PE', '77664634\r'),
(81, 2, 'DISMELEC', '77192360-7', '', 'RODRIGO DE ARAYA 2384', '22381649\r'),
(82, 2, 'DISPROYEC SPA', '76499962-2', '', 'PEDRO AGUIRRE CERDA 0394 DPTO120 SANTIAGO', '298187650\r'),
(83, 2, 'DISTRIBUIDORA MARATHON LTDA', '76752630-K', '', 'SAN JUAN # 4845, SAN JOAQUIN', '28846117\r'),
(84, 2, 'DISTRIBUIDORA Y COMERCIALIZADORA MG LTDA', '77862630-7', '', 'LA FORJA # 8570 LA REINA', '228626000\r'),
(85, 2, 'DVP', '89689900-7', '', 'LOS NOGALES S/N LOTE 38 LAMPA', '3930000\r'),
(86, 2, 'DYNAL INDUSTRIAL S.A.', '92264000-9', '', 'AVDA. 5 DE ABRIL # 4534, ESTACION CENTRAL, SANTIAGO', '24782071\r'),
(87, 2, 'DYNAL INDUSTRIAL S.A.', '92264000-9', '', 'AVDA 5 DE ABRIL 4534', '93001815\r'),
(88, 2, 'EASY S.A.', '96671750-5', '', 'ARIZTIA 350, QUILLOTA', '16541654\r'),
(89, 2, 'EBEMA S.A.', '83584400-0', '', 'ALDUNATE 480', '33-2333721-952186329\r'),
(90, 2, 'EDUARDO PEREZ BERROCAL Y CIA LTDA', '76584130-5', '', 'ARLEGUI 1109 LOCAL 19', '322696450\r'),
(91, 2, 'EL ARRAYAN FERRETERIA LTDA', '76483280-9', '', 'SAN FRANCISCO 2550 SAN MIGUEL', '2279001000\r'),
(92, 2, 'ELDER S.A.', '88806700-0', '', 'EL ROMERAL 12-A, SAN BERNARDO', '28571175\r'),
(93, 2, 'EMARESA S.A.', '83162400-0', '', 'SANTA ADELA N', '24602026\r'),
(94, 2, 'EMIN', '96725910-1', '', 'FELIX DE AMESTI # 90 PISO 1', '222998001\r'),
(95, 2, 'ENELEC LTDA', '78385210-1', '', 'AV BRASIL 2959 VALPARAISO', '32-2227994\r'),
(96, 2, 'ESPAC CONSTRUCCIONES', '99552050-8', '', 'VOLCAN LANIN # 451', '225199900\r'),
(97, 2, 'EXTINTORES WELSH LTDA', '77352280-4', '', 'SEMINARIO 187 - 185 PROVIDENCIA', '222224537\r'),
(98, 2, 'FABIO MUZIO Y COMPA', '77443440-2', '', '6 1/2 NORTE 938', '32-2907027\r'),
(99, 2, 'FABRICA DE CLAVOS ALAMBRES Y TORNILLOS BERR Y NALLY S.A.', '91905000-4', '', 'AVDA EINSTEIN 568, RECOLETA, SANTIAGO', '226216231\r'),
(100, 2, 'FABRICA DE CLAVOS BERR Y NALLY S.A.', '91905000-4', '', 'AVDA. EINSTEIN 568, RECOLETA, SANTIAGO', '6216231\r'),
(101, 2, 'FENASA', '76762370-4', '', 'CERRO EL ALTAR #4080, PARQUE INDUSTRIAL CURAUMA, VALPARAISO', '56883690\r'),
(102, 2, 'FERNANDO AMADOR A. JELDES', '12820371-0', '', 'PEDRO FELIX N', '82321628\r'),
(103, 2, 'FERRETEK', '76173845-3', '', 'AMERICO VESPUCIO 1076, MAIPU, SANTIAGO', '56944006896\r'),
(104, 2, 'FERRETERIA LORIE', '7078068-2', '', 'MADRID OSORIO 418 SAN BERNARDO', '8575523 '),
(105, 2, 'FIJACIONES PROCRET', '77553050-2', '', 'TIL TIL 1980 SECTOR 17 NU', '22378560\r'),
(106, 2, 'FIXEN', '76397473-1', '', 'LIMACHE 3405 LOCAL 114, VI', '322606085\r'),
(107, 2, 'FONOGAS', '13479996-K', '', 'POSO AL MONTE 1113', '09-95252881\r'),
(108, 2, 'FORMAC SA', '95672000-1', '', 'AVDA AMERICO VESPUCIO 651 QUILICURA', '28994113\r'),
(109, 2, 'FREEMAN SPA', '76683328-4', '', 'EL QUILO 5428 QUINTA NORMAL', '227756287\r'),
(110, 2, 'FRNCISCO ARAYA', '76014025-2', '', 'AVDA LAS REJAS 774', '27746877\r'),
(111, 2, 'GASTRONOMICA BUGA LIMITADA', '76136851-6', '', 'AV. CENTRAL # 85, RE', '3177941\r'),
(112, 2, 'GASVALPO S.A', '96960800-6', '', 'CAMINO INTERNACIONAL 1420,VI', '032-2277000\r'),
(113, 2, 'GBS EXCAVACIONES SPA', '76537352-2', '', 'CARLOS SILVA VILDOSOLA 1086, SAN MIGUEL', '965964879\r'),
(114, 2, 'GEO ARRIENDOS LTDA', '76086141-3', '', 'SENDA B N', '09-94339960\r'),
(116, 2, 'GRUAS CARMEN ROMO ESCOBAR', '76615720-3', '', 'FRANCISCO ASTABURUAGA #9143 LO ESPEJO', '228540000\r'),
(117, 2, 'H Y M HOLDING MINING LTDA', '76282994-0', '', 'AEROPUERTO 9631 CERRILLOS', '957385054\r'),
(118, 2, 'HASBUN Y CIA LTDA.', '77955870-3', '', 'PARCELA PARQUE INDUSTRIAL 19, CON CON', '2812340\r'),
(119, 2, 'HECTOR DANILO BERMUDEZ BRICE', '6149868-0', '', 'SANTA MARGARITA 1180', '2120667\r'),
(120, 2, 'HECTOR GONZALO URBINA PAREDES', '12458493-0', '', 'AMERICO VESPUCIO 2663', '229684943\r'),
(121, 2, 'HIDROPACK S.A.', '99531900-4', '', 'PADRE VICENTE IRARRAZABAL 899, ESTACION CENTRAL', '25602699\r'),
(122, 2, 'HILTI', '84976200-1', '', 'APOQUINDO 4775', '6006563000\r'),
(123, 2, 'HORMIGONES BICENTENARIO', '99507430-3', '', 'AVDA EL BOSQUE NORTE 0177 OF 1002', '76488599\r'),
(124, 2, 'HORMIGONES TRANSEX LTDA.', '88147600-2', '', 'AVDA DEL VALLE 850', '22481000\r'),
(125, 2, 'ILOP S.A.', '80478200-1', '', 'AV. A. VESPUCIO NORTE 727, HUECHURABA, SANTIAGO', '29289000\r'),
(126, 2, 'INAMAR LIMITADA', '92975000-4', '', 'MIRAFLORES N', '(56) 22 495 9000\r'),
(127, 2, 'INCOMER LTDA', '77420780-5', '', 'LEOPOLDO URRUTIA N', '224469151\r'),
(128, 2, 'INDECO CONSTRUCCIONES SANITARIAS S.A', '77140840-0', '', 'AVDA ZA', '222384069\r'),
(129, 2, 'INGENIERIA ESCALIMETRO LTDA.', '72097489-7', '', 'ALDUNATE 1136, SANTIAGO', '978501160\r'),
(130, 2, 'INGENIERIA SANITARIA LTDA PORT-O-LET', '79557240-6', '', 'DIAGONAL LOS CASTA', '562-2852431\r'),
(131, 2, 'INGENIERIA Y COMERCIAL INCOMER LTDA.', '77420780-5', '', 'LEOPOLDO URRUTIA 1870, NU', '223750138\r'),
(132, 2, 'INGENIERIA Y SERVICIO MCL LTDA.', '76041093-4', '', 'PAPA SAN PEDRO # 9471, PUDAHUEL', '27497641\r'),
(133, 2, 'INSTAPANEL S.A.', '96859640-3', '', 'CAMINO A LONQUEN 11011', '4847600\r'),
(134, 2, 'INSYTEC S.A.', '96882670-0', '', 'CHILLAN # 2761, INDEPENDENCIA, SANTIAGO', '27328410 / 81298509\r'),
(135, 2, 'INTELCOM LTDA', '78384170-3', '', '1 ORIENTE 25 VI', '2696055\r'),
(136, 2, 'ISA-LOCK LTDA', '78777500-4', '', 'LIRA #899', '226343044\r'),
(137, 2, 'ISAMIT MAQUINARIAS', '76391670-4', '', 'JULIET # 2318.INDEPENDENCIA', '973020672\r'),
(138, 2, 'ISTRIA Y CIA LTDA', '78951060-1', '', 'GASPAR DE LA BARRERA 2880', '26837760\r'),
(139, 2, 'ITALIMPORT SA', '76008673-8', '', 'PADRE ERRAZURIS # 7667', '222126362\r'),
(140, 2, 'ITALINNEA', '84505500-9', '', 'GERONIMO DE ALDERETE 1457', '995328919\r'),
(141, 2, 'JARDIN SAN JOSE', '4841541-5', '', 'PANEMERICANA SUR KM 28 PARCELA 1C1', '28573281\r'),
(142, 2, 'JELDWENN', '79746830-4', '', 'LA MONTA', '4967000\r'),
(143, 2, 'JENNIFFER ABARCA ACU', '15720726-1', '', 'AVDA. PEDRO AGUIRRE CERDA # 9979, SAN RAMON, SANTIAGO', '66029260\r'),
(144, 2, 'JORGE GUTIERREZ', '7938375-9', '', 'LEONOR DE LA CORTE # 5608 QTA NORMAL', '978565213\r'),
(145, 2, 'JORQUE FRANCISCO DE LA RIVERA SANDOVAL', '5524126-0', '', 'GRAN AVENIDA JOSE MIGUEL CARRERA 12714', '2225293116\r'),
(146, 2, 'JOSE ALEJANDRO SEPULVEDA AGUILERA (NEVER PLAGAS)', '14473218-9', '', 'AVDA LA PRADERA N', '223138154\r'),
(147, 2, 'JUAN BAUTISTA VARGAS', '4014822-1', '', 'GUILLERMO GREVER 4352, RECOLETA', '24556239\r'),
(148, 2, 'JUAN OLIVARES ESPINOZA', '12617935-9', '', 'ROSEDAL 25, VI', '94813488\r'),
(149, 2, 'JUAN SANTIBA', '7396254-4', '', 'LAS MAGNOLIAS 223, ACHUPALLAS, VI', '2862556\r'),
(150, 2, 'JULIAN', '78422420-1', '', 'SAN JUAN # 4470 SAN JOAQUIN', '225520088\r'),
(151, 2, 'KITCHEN CENTER', '96999930-7', '', 'AV. PDTE. EDUARDO FREI MONTALVA, 9709 LOCAL 508', '224117798\r'),
(152, 2, 'KLEVER', '76953510-1', '', 'LOS TURISTAS N', '9 51581578\r'),
(153, 2, 'KVA CHILE', '76253177-1', '', 'RENGO 4449 LA FLORIDA', '229072212\r'),
(154, 2, 'LABORATORIO SOILTEST LTDA.', '78700850-K', '', 'PAULINA 7880, LA CISTERNA', '225484123\r'),
(155, 2, 'LIBRERIA Y DISTRIBUIDORA BUEN PUERTO', '5049760-7', '', 'ARLEGUI # 545, VI', '2398719\r'),
(156, 2, 'LUIS AHUMADA PE', '4187219-5', '', 'BALMACEDA 3472, LO ESPEJO', '28545607\r'),
(157, 2, 'LUIS CISTERNAS', '5007065-4', '', 'JULIO MARTINEZ 1320, INDEPENDENCIA, SANTIAGO', '995758859\r'),
(158, 2, 'LUISA ESCOBAR', '3872192-5', '', 'STO DOMINGO 1443, DPTO 17 SANTIAGO', '9487207 26881564\r'),
(159, 2, 'COMERCIAL K LIMITADA', '77137860-9', '', 'AVDA. LAS CONDES 11400', '226789010'),
(160, 2, 'MALMO SA', '76195558-6', '', 'AVDA TABANCURA 1376', '92078651\r'),
(161, 2, 'MARCELO ANDRES SOTO ARRATIA PROVEEDOR IND. E.I.R.L', '76689941-2', '', 'RUTA 68 1080 PLACILLA VALPARAISO', '997405000\r'),
(162, 2, 'MARITZA DE LAS MERCEDES HERNANDEZ GONZALEZ', '12106706-4', '', '14 DE OCTUBRE 5921', '33-2443261\r'),
(163, 2, 'MATELEC LIMITADA', '79659100-5', '', 'DIEZ DE JULIO HUAMACHUCO # 103, SANTIAGO CENTRO', '26350109\r'),
(164, 2, 'MAX TOOLS LTDA', '76218829-5', '', 'AV. ZA', '225035628\r'),
(165, 2, 'MC VARGAS EIRL', '78395903-1', '', 'LA QUENA 1564, PUENTE ALTO', '979092603\r'),
(166, 2, 'MCL', '76041093-4', '', 'PAPA SAN PEDRO 9471 PUDAHUEL', '27477374\r'),
(167, 2, 'METALRED INGENIERIA Y SERVICIOS LIMITADA', '76150839-3', '', 'MARIA JOSEFINA 1290 LAMPA', '2 27386584\r'),
(168, 2, 'MODULOS PATAGONIA LTDA', '76603240-0', '', 'AVENIDA GENERAL VELASQUEZ 10985 PARQUE INDUSTRIAL PUERTA SUR', '225294469\r'),
(169, 2, 'MOLDUDEC LTDA', '76210872-0', '', 'FERMIN VIVACETA 2598', '93300357\r'),
(170, 2, 'MORTEROS TRANSEX', '76529300-6', '', 'AVENIDA DEL VALLE 850 HUECHURABA', '224831000\r'),
(171, 2, 'MOVISAN', '9333291-1', '', 'AVDA ALBERLI 406 QUILLOTA', '033-2313103\r'),
(172, 2, 'MQ ARRIENDOS LIMITADA', '76101754-3', '', 'CAMINO DEL CERRO 5090 HUECHURABA', '226224148\r'),
(173, 2, 'MZ ARRIENDOS', '76344178-4', '', 'CALLE ONCE # 319 RECREO, VI', '87774323\r'),
(174, 2, 'NG MADERAS SA', '78421870-8', '', 'SAN IGNACIO 180, QUILICURA', '22 211 2522\r'),
(175, 2, 'OSSA SISTEMAS CONTRA INCENDIO', '76065559-7', '', 'VICTOR MANUEL 2024 - SANTIAGO CENTRO', '225513318\r'),
(176, 2, 'P&S INDUSTRIAL', '76195249-8', '', 'DUODECIMA # 1264 PLACILLA, VALPARAISO', '81426180\r'),
(177, 2, 'PAUL CHRISTIAN BONNASSIOLLE QUINTANA', '15098606-0', '', 'LOS CARRERA 1552 DPTO 24', '2487893\r'),
(178, 2, 'PC FACTORY S.A.', '78885550-8', '', 'AV. VALPARAISO # 459. VI', '2141654\r'),
(179, 2, 'PINTURAS VIALES Y PARQUEOS LTDA', '76414250-0', '', '1/2 ORIENTE 1050 OF 406 VI', '32-2695302\r'),
(180, 2, 'PJ URRUTIA HERMANOS', '77896660-3', '', 'SAN JUAN DE LA CRUZ #5572 MAIPU', '227438549\r'),
(181, 2, 'PLOTCENTER LTDA.', '76240049-9', '', 'AVDA. PROVIDENCIA # 2594, PROVIDENCIA SANTIAGO', '23347643\r'),
(182, 2, 'POLIFUSION', '96560030-2', '', 'CACIQUE COLIN # 2525, LAMPA, SANTIAGO', '21545648\r'),
(183, 2, 'POSTES METALICOS SPA', '76678823-8', '', '8 PONIENTE 211, PAINE', '950705467\r'),
(184, 2, 'PREFABRICADOS DE HORMIGON GRAU S.A.', '96927190-7', '', 'AVDA LAS ACACIAS, 02359, SAN BERNARDO, SANTIAGO', '984099055\r'),
(185, 2, 'PREFABRICADOS GRAU.', '96927190-7', '', 'AVDA LAS ACACIAS # 02359.SN BDO', '6003727272 - 9840990\r'),
(186, 2, 'PROCRET', '77553050-2', '', 'TIL TIL N', '22378560\r'),
(187, 2, 'PRONTO EQUIPOS', '76418759-8', '', 'EDUARDO MATTE 2071', '25512524\r'),
(188, 2, 'PUNTO MAESTRO', '9*4707000-', '', 'AV MATTA #067 ', '22726767\r'),
(189, 2, 'QUIMICA Y ADHESIVO PATEL LTDA', '76013880-0', '', 'PUERTO VESPUCIO 9692', '28565500\r'),
(190, 2, 'QUIMICA Y COMERCIAL KLEVER S.A.', '76953510-1', '', 'LOS TURISTAS 0451, RECOLETA', '951581578\r'),
(191, 2, 'R.T.S CHILE', '76103525-8', '', 'AV DOMINGO SANTA MARIA 1749 INDEPENDENCIA', '966552807\r'),
(192, 2, 'RAMEK S.A.', '96971470-1', '', 'CALLE LIMACHE 3847 EL SALTO VI', '32-2630141\r'),
(194, 2, 'READY MIX', '91755000-K', '', 'ACENTAMIENTO INDEPENDENCIA CAMINO INTERNACIONAL CON-CON', '94386498\r'),
(195, 2, 'RENT CENTER LTDA', '76140929-8', '', 'MADRID # 1869 SANTIAGO', '225518279\r'),
(196, 2, 'RIMAK PERFORACIONES LTDA', '76212407-6', '', 'LEON DE LA BARRA', '228540833\r'),
(197, 2, 'RIPAL ARRIENDOS', '76212407-6', '', 'LEON DE LA BARRA # 9072 LO ESPEJO', '228540833- 228716546\r'),
(198, 2, 'RMD KWIKFORM CHILE', '96825530-4', '', 'LA ESTERA N 811', '27149800\r'),
(199, 2, 'SAFE SEGURIDAD S.A.', '77892890-6', '', 'CAMINO INTERNACIONAL 5415', '322157650\r'),
(200, 2, 'SALMAQ', '76203188-4', '', '22 NORTE 1506 STA INES VI', '032-2780396\r'),
(201, 2, 'SALMAQ', '76203188-4', '', '22 NORTE 1506,SANTA INES,VI', '032-2780396\r'),
(202, 2, 'SAN FRANCISCO MONTAJE Y CONSTRUCCION LIMITADA', '76049487-9', '', 'SANTA CORINA 0184, LA CISTERNA, SANTIAGO', '976836426\r'),
(203, 2, 'SANDOVAL MENA', '78416500-0', '', 'BOTICELLI # 5396', '225230034\r'),
(204, 2, 'SERVICIOS MAQUINARIAS BUSVAL LTDA', '76254640-k', '', 'MONSE', '225615536\r'),
(205, 2, 'SHERWIN WILLIAMS CHILE S.A.', '96803460-k', '', 'AV. LA DIVISA 089', '76497188\r'),
(206, 2, 'SIGMA CONSTRUCCIONES LTDA', '78505870-4', '', 'AVDA SANTA MARIA 2294, PROVIDENCIA, SANTIAGO', '229460400\r'),
(207, 2, 'SOC.COMERCIAL DEL REY', '76121410-1', '', 'ALBERGI N 87 QUILLOTA', '311050\r'),
(208, 2, 'SOCIEDAD COMERCIAL LAGOS LIMITADA', '76323810-5', '', 'CAMINO LA POLVORA S/N PARCELA 101 VALPARAISO', '032-2291112\r'),
(209, 2, 'SOCIEDAD COMERCIAL RETAMALES E HIJOS LTDA', '76255328-7', '', 'LOS DURAZNOS 476 VILLA LA PINTANA', '28522814\r'),
(210, 2, 'SOCIEDAD COMERCIAL Y DE SERVICIOS IMPROMEX SPA', '76258668-1', '', 'CUEVAS #1638, SANTIAGO', '22 556 0742\r'),
(211, 2, 'SOCIEDAD ENERSET LIMITADA', '76156939-2', '', '3 ORIENTE 720 VI', '32 3192229\r'),
(212, 2, 'SOCIEDAD GRAFICA Y DE INVERSIONES ARACENA LTDA', '76031871-k', '', 'AV EL PARRON 0507', '22525734\r'),
(213, 2, 'SOCIEDAD IMPORTADORA LA FABRICA LTDA', '76360235-4', '', 'STA BLANCA 1734 LO BBARNECHEA', '279695256\r'),
(214, 2, 'SOCIEDAD PUELLES ,LEIVA LTDA', '77655730-7', '', 'VAN BUREN 2636 VALPARAISO', '32-2545850 -2546250\r'),
(215, 2, 'SOCIEDAD PUELLES,LEIVA LIMITADA', '77655730-7', '', 'VAN BUREN N', '322545850\r'),
(216, 2, 'SODIMAC S.A.', '96792430-K', '', 'AVDA. EDUARDO FREI MONTALVA #3092, RENCA, SANTIAGO', '21354\r'),
(217, 2, 'SOTO MONTERO LIMITADA', '76195249-8', '', 'DUODECIMA 1264 PLACILLA', '032-2122246\r'),
(218, 2, 'SUMMINCO', '78505870-4', '', 'MIGUEL DE ATARO 2840', '62377924\r'),
(219, 2, 'SURPLAST SA', '99516040-4', '', 'LOS TEJEDORES 160', '22733266\r'),
(220, 2, 'TECNO FAST', '76320186-4', '', 'PANAMERICANA NORTE KM. 17 - CALETERA ORIENTE , COLINA , SANTIAGO', '227905001\r'),
(221, 2, 'TECNOMAK', '77611330-1', '', 'CANCHA # 175, VI', '72135547\r'),
(222, 2, 'TECNORED S.A.', '77302440-5', '', 'AVDA. PRESIDENTE EDUARDO FREI MONTALVA 5280, RENCA', '944426203\r'),
(223, 2, 'TEFIX LTDA', '78431640-8', '', 'AVENIDA VOLCANLASCAR 740 LO BOZA, PUDAHUEL', '27191800\r'),
(224, 2, 'TEHMCO', '84912700-4', '', 'RENCA 2210', '981580701\r'),
(225, 2, 'TERRAPINO', '9951581-3', '', 'PARCELA N', '2611801\r'),
(226, 2, 'TEXAS LABORATORIES INC. S.I.C', '79577040-2', '', 'SANTA VICTORIA \'372', '26352640\r'),
(227, 2, 'THC CHILE S.A.', '96502050-0', '', 'MAR DEL SUR 7481 PARQUE INDUSTRIAL PUDAHUEL', '227491002\r'),
(228, 2, 'THYSENKRUPP ELEVADORES S.A.', '96726480-6', '', 'CORONEL PEREIRA 72 OF. 401, LAS CONDES', '111111111\r'),
(229, 2, 'TODO FIERRO LTDA', '76639360-4', '', 'AV GRABIELA PONIENTE 3750', '225424451\r'),
(230, 2, 'TOSCANINI TELECOMUNICACIONES LTDA', '78201660-1', '', 'DIAGONAL ORIENTE 1555', '23361100\r'),
(231, 2, 'TRANSACO S.A.', '94952000-5', '', 'AV. VIZCAYA N', '2 27977717\r'),
(232, 2, 'TRANSPORTES CARICEO', '9990867-k', '', 'SAN PABLO 5486 LO PARADO', '227744174\r'),
(233, 2, 'TRANSPORTES CM LTDA.', '76217830-3', '', 'AVDA. GENERAL VELASQUEZ N', '228002294\r'),
(234, 2, 'TRANSPORTES COPAYAPU LTDA', '78579710-8', '', 'EL TROVADOR 4280, LAS CONDES', '22425288\r'),
(235, 2, 'TRANSPORTES VALLADARES SPA', '76528279-9', '', 'AVDA NUEVA PROVIDENCIA 1102', '977048379\r'),
(236, 2, 'TRAVERSO HERMANO', '78441890-1', '', 'CAMINO INTERNACIONAL 12555 CONCON', '32-2814001\r'),
(237, 2, 'TRULY NOLEN', '96591760-8', '', 'KENNEDY # 8028 VITACURA', '227844400\r'),
(238, 2, 'UPDATE GROUP LIMITADA', '76173845-3', '', 'AMERICO VESPUCIO 1076', '56944006896\r'),
(239, 2, 'VALERIA GONZALEZ S', '13025024-6', '', 'AVENIDA VILLA MONTES N', '63633982\r'),
(240, 2, 'VENTANAS DE PONCELL VICH Y CIA LTDA', '77761200-K', '', 'LOS FRESNOS 3M, COLINA', '022-7387495\r'),
(241, 2, 'VENTANAS DE PONCELL VICH Y COMPA', '77761200-K', '', 'CALLE LOS FRESNOS SITIO 3M PANAMERICANA NORTE KM 18', '27387495\r'),
(242, 2, 'VENTAS ARRIENDO Y SERVICIOS VAS LTDA', '76294258-5', '', 'LOS ALAMOS 849 DTO 142 QUILPUE', '98212860\r'),
(243, 2, 'VERDEJO Y LAGOS LTDA', '76143888-3', '', 'PUERTO MADERO 9710 BOD.Y -127', '22380837\r'),
(244, 2, 'VICTOR HUGO QUILODRAN NU', '11845702-1', '', 'BORINQUEN 2 D/23 COND BRISAS DEL SUR VI', '81335998\r'),
(245, 2, 'WINTEC', '96952990-4', '', 'AVDA AEROPUERTO 620 QUILICURA', '79894806\r'),
(246, 2, 'WURTH CHILE LTDA', '78701740-1', '', 'CALLE HERNANDO DE AGUIRRE 162, OF 802', '+562 2-4709180\r'),
(247, 2, 'YAEL VIVEROS', '15822745-2', '', 'MARQUES DE SANTILLANA 5405', '228082283\r'),
(248, 2, 'YARELA ALEJANDRA GONZALEZ PONCE', '13993841-0', '', 'PASAJE E N', '032-2872723\r'),
(249, 2, 'ZACH S.A.', '78058870-5', '', 'LA ESTERA 687, LAMPA', '27471820\r'),
(250, 2, 'COMERCIAL DUOMO', '78770830-7', '', 'AVDA. KENNEDY 6980, VITACURA', '(56-2) 25193500'),
(251, 3, 'imperial', '54354354-4', 'asdf@asd.com', 'camino internacional', '22222344');

-- --------------------------------------------------------

--
-- Table structure for table `providers_contacts`
--

CREATE TABLE `providers_contacts` (
  `id_provider_contact` int(11) NOT NULL,
  `fk_id_provider` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `phone` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `providers_contacts`
--

INSERT INTO `providers_contacts` (`id_provider_contact`, `fk_id_provider`, `name`, `mail`, `phone`) VALUES
(1, 63, 'Cristian Palma', 'cristian.palma@construmart.cl', '99197942'),
(2, 137, 'Jorge Ismait', 'jisamit@isamitmaquinarias.cl', '(02)7779280 - (02)7323250'),
(3, 137, 'Sandra Reyes', 'recepcion@isamitmaquinarias.cl', ''),
(4, 195, 'Nelson Perez', 'nelson@rentcenter.cl', '22551 82 79 - 22401 01 65'),
(5, 250, 'MARIA INES GRANDON', '', '225193500 973084207');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id_purchase_order` int(11) NOT NULL,
  `fk_id_establishment` int(11) NOT NULL,
  `fk_id_provider` int(11) NOT NULL,
  `number` varchar(16) NOT NULL,
  `issue_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(12) NOT NULL,
  `vendor_name` varchar(32) NOT NULL,
  `vendor_contact` varchar(256) NOT NULL,
  `dispatch_name` varchar(32) NOT NULL,
  `dispatch_contact` varchar(256) NOT NULL,
  `dispatch_address` varchar(128) NOT NULL,
  `number_material_request` varchar(16) NOT NULL,
  `number_quotation` varchar(16) NOT NULL,
  `way_to_pay` varchar(512) NOT NULL,
  `observation` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id_purchase_order`, `fk_id_establishment`, `fk_id_provider`, `number`, `issue_date`, `created_at`, `status`, `vendor_name`, `vendor_contact`, `dispatch_name`, `dispatch_contact`, `dispatch_address`, `number_material_request`, `number_quotation`, `way_to_pay`, `observation`) VALUES
(1, 2, 49, '9831', '2016-12-09', '2017-04-03 02:38:24', 'pending', 'Evelyn Morales', 'Fono: 262200594', 'RICHARD COLLAO', 'correo: adminpiloto@domain.com , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(3, 2, 159, '9828', '2016-10-27', '2017-04-12 21:45:17', 'pending', 'ALEXANDRA BALLEVONA', 'Fono: 226789010 / 226789000', 'RICHARD COLLAO', 'correo: adminpiloto@domain.com , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(4, 2, 250, '9832', '2016-12-13', '2017-04-12 22:52:11', 'pending', 'MARLENE MUÃ‘OZ', '(56-2) 25193500', 'RICHARD COLLAO', 'telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(5, 3, 251, '2000', '2017-07-25', '2017-07-25 22:00:37', 'pending', 'jose campos', 'jcampos@asf.com', 'juan perez', 'correo: jperez@gmail.com , telefono: 2324235', 'independencia', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(6, 3, 251, '2001', '2017-07-25', '2017-07-25 22:05:12', 'pending', 'jcampos', 'jcampos 23456', 'juan perez', 'correo: jperez@gmail.com , telefono: 2324235', 'independencia', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(7, 2, 63, '9836', '2017-09-06', '2017-09-06 10:52:12', 'pending', 'Cristian Palma', 'correo: cristian.palma@construmart.cl, Fono: 99197942', 'Richard Collao', 'correo: rcollao@sigmaltda.cl , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(8, 2, 40, '9839', '2017-09-06', '2017-09-06 12:38:18', 'pending', 'Cristian Orellana', 'Fono: 2 24849200', 'Richard Collao', 'correo: rcollao@sigmaltda.cl , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(9, 2, 63, '9800-310', '2017-09-06', '2017-09-06 15:06:06', 'pending', 'Cristian Palma', 'correo: cristian.palma@construmart.cl, Fono: 99197942', 'Richard Collao', 'correo: rcollao@sigmaltda.cl , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(10, 2, 3, '9808-1', '2017-09-06', '2017-09-06 15:15:59', 'pending', 'Berrios', '993001815', 'Richard Collao', 'correo: rcollao@sigmaltda.cl , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(11, 2, 137, '9800-273', '2017-09-06', '2017-09-06 15:37:12', 'pending', 'Jorge Ismait', 'correo: jisamit@isamitmaquinarias.cl, Fono: (02)7779280 - (02)7323250', 'Richard Collao', 'correo: rcollao@sigmaltda.cl , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(12, 2, 137, '9800-274', '2017-09-06', '2017-09-06 15:44:54', 'pending', 'Jorge Ismait', 'correo: jisamit@isamitmaquinarias.cl, Fono: (02)7779280 - (02)7323250', 'Richard Collao', 'correo: rcollao@sigmaltda.cl , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(13, 2, 195, '9800-232', '2017-09-06', '2017-09-06 15:51:03', 'pending', 'Nelson Perez', 'correo: nelson@rentcenter.cl, Fono: 22551 82 79 - 22401 01 65', 'Richard Collao', 'correo: rcollao@sigmaltda.cl , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(14, 2, 195, '9800-237', '2017-09-06', '2017-09-06 15:53:51', 'pending', 'Nelson Perez', 'correo: nelson@rentcenter.cl, Fono: 22551 82 79 - 22401 01 65', 'Richard Collao', 'correo: rcollao@sigmaltda.cl , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', ''),
(15, 2, 250, '9826', '2017-09-06', '2017-09-06 16:14:56', 'pending', 'MARIA INES GRANDON', 'correo: , Fono: 225193500 973084207', 'Richard Collao', 'correo: rcollao@sigmaltda.cl , telefono: 971620060', 'ROMAN DIAZ #277', '', '', 'Pago 30 dias desde la recepcion de la factura', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders_details`
--

CREATE TABLE `purchase_orders_details` (
  `id_purchase_order_detail` int(11) NOT NULL,
  `fk_id_purchase_order` int(11) NOT NULL,
  `fk_id_material` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `value` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_orders_details`
--

INSERT INTO `purchase_orders_details` (`id_purchase_order_detail`, `fk_id_purchase_order`, `fk_id_material`, `code`, `quantity`, `value`) VALUES
(1, 1, 4503, '', '57.0000', '93523.0000'),
(2, 1, 4504, '', '3.0000', '49699.0000'),
(3, 1, 4505, '', '57.0000', '131905.0000'),
(4, 1, 4506, '', '57.0000', '144723.0000'),
(5, 1, 4507, '', '57.0000', '70408.0000'),
(6, 1, 4508, '', '57.0000', '3928.0000'),
(7, 1, 4509, '', '57.0000', '2140.0000'),
(8, 1, 4510, '', '20.0000', '39897.0000'),
(9, 1, 4511, '', '29.0000', '37247.0000'),
(10, 1, 4512, '', '8.0000', '33211.0000'),
(11, 1, 4527, '', '57.0000', '1824.0000'),
(13, 1, 4513, '', '57.0000', '3634.0000'),
(14, 1, 4517, '', '3.0000', '35581.0000'),
(15, 1, 4518, '', '3.0000', '2449.0000'),
(16, 1, 4519, '', '40.0000', '56233.0000'),
(17, 1, 4520, '', '40.0000', '70286.0000'),
(18, 1, 4521, '', '40.0000', '5630.0000'),
(19, 1, 4522, '', '40.0000', '725.0000'),
(20, 1, 4523, '', '57.0000', '9134.0000'),
(21, 1, 4528, '', '57.0000', '10778.0000'),
(22, 1, 4529, '', '114.0000', '5666.0000'),
(23, 1, 4530, '', '57.0000', '12768.0000'),
(24, 1, 4531, '', '65.0000', '5264.0000'),
(25, 1, 4524, '', '130.0000', '1903.0000'),
(26, 1, 4525, '', '63.0000', '3928.0000'),
(27, 1, 4526, '', '60.0000', '14850.0000'),
(28, 1, 4514, '', '41.0000', '51781.0000'),
(29, 1, 4515, '', '99.0000', '5443.0000'),
(30, 1, 4532, '', '41.0000', '3239.0000'),
(31, 1, 4533, '', '17.0000', '34784.0000'),
(33, 1, 4603, '', '17.0000', '2449.0000'),
(41, 3, 4488, '', '3312.0000', '8.4400'),
(42, 3, 4489, '', '1117.6000', '8.3800'),
(43, 3, 4490, '', '208.8000', '9.4000'),
(44, 3, 4491, '', '528.0000', '8.3800'),
(45, 3, 4492, '', '49.4000', '6.3900'),
(46, 3, 4493, '', '1284.4800', '9.7000'),
(47, 4, 4470, '', '6.0000', '114.3800'),
(48, 4, 4471, '', '6.0000', '2.0700'),
(49, 4, 4472, '', '120.0000', '4.5900'),
(50, 4, 4473, '', '114.0000', '114.3800'),
(51, 4, 4474, '', '122.0000', '35.8000'),
(52, 4, 4475, '', '3.0000', '55.1000'),
(53, 4, 4476, '', '57.0000', '53.1300'),
(54, 4, 4477, '', '57.0000', '35.3000'),
(55, 4, 4478, '', '57.0000', '62.5500'),
(56, 4, 4479, '', '101.0000', '46.7700'),
(57, 4, 4480, '', '1.0000', '50.0000'),
(58, 4, 4481, '', '29.0000', '186.3700'),
(59, 4, 4482, '', '10.0000', '202.8500'),
(61, 4, 4483, '', '20.0000', '239.0200'),
(62, 4, 4484, '', '6.0000', '49.7300'),
(63, 6, 4604, '', '1000.0000', '5.0000'),
(64, 7, 4420, '', '240.0000', '5528.5300'),
(65, 7, 4421, '', '420.0000', '2260.0000'),
(66, 7, 4423, '', '2560.0000', '3084.0000'),
(67, 7, 4423, '', '880.0000', '5045.0000'),
(68, 7, 4424, '', '300.0000', '3308.0000'),
(69, 7, 4425, '', '40.0000', '3570.0000'),
(70, 7, 4426, '', '4176.0000', '761.0000'),
(71, 7, 4427, '', '240.0000', '1092.0000'),
(72, 7, 4428, '', '192.0000', '1347.0000'),
(73, 7, 4429, '', '300.0000', '2907.0000'),
(74, 7, 4430, '', '300.0000', '6088.0000'),
(75, 7, 4432, '', '1000.0000', '2215.0000'),
(76, 7, 4431, '', '250.0000', '624.0000'),
(77, 8, 4409, '', '3300.0000', '691.2000'),
(78, 8, 4410, '', '600.0000', '864.0000'),
(79, 8, 4411, '', '1400.0000', '558.0000'),
(80, 8, 4412, '', '65.0000', '806.4000'),
(81, 8, 4413, '', '30.0000', '1008.0000'),
(82, 8, 4414, '', '30.0000', '702.0000'),
(83, 8, 4415, '', '15.0000', '3600.0000'),
(84, 8, 4416, '', '100.0000', '348.0000'),
(85, 9, 3982, '', '10.0000', '10637.0000'),
(86, 10, 3976, '', '2.0000', '70000.0000'),
(87, 11, 4605, '', '1.0000', '7000.0000'),
(88, 11, 4606, '', '1.0000', '2000.0000'),
(89, 12, 4394, '', '1.0000', '5000.0000'),
(90, 13, 4607, '', '2.0000', '5000.0000'),
(91, 14, 4350, '', '1.0000', '4000.0000'),
(92, 15, 4496, '', '480.0000', '12.5000'),
(93, 15, 4497, '', '540.0000', '11.3000'),
(94, 15, 4498, '', '10400.0000', '11.3000');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `fk_id_user` int(11) NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `user_agent` varchar(256) NOT NULL,
  `ip_current` int(11) UNSIGNED NOT NULL,
  `last_activity` datetime NOT NULL,
  `connection_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`fk_id_user`, `session_id`, `user_agent`, `ip_current`, `last_activity`, `connection_status`) VALUES
(1, '787a54d84c5be72d0f0f2786eb54a78f', 'Mozilla%2F5.0%20%28Windows%20NT%206.1%3B%20WOW64%3B%20rv%3A54.0%29%20Gecko%2F20100101%20Firefox%2F54.0', 2130706433, '2017-07-26 08:28:47', 1),
(2, 'd0eb214a4d00e68be51e174cd144f328', 'Mozilla%2F5.0%20%28X11%3B%20Linux%20x86_64%3B%20rv%3A45.0%29%20Gecko%2F20100101%20Firefox%2F45.0', 2130706433, '2017-10-03 18:52:13', 1),
(3, '95d0e7a8031300af055e7d50d3ae7447', 'Mozilla%2F5.0%20%28Windows%20NT%206.1%3B%20WOW64%3B%20rv%3A54.0%29%20Gecko%2F20100101%20Firefox%2F54.0', 2130706433, '2017-07-25 22:17:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `fk_id_establishment` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `state_acount` varchar(16) NOT NULL,
  `type_user` varchar(16) NOT NULL,
  `date_reg` datetime NOT NULL,
  `last_logon` datetime NOT NULL,
  `date_current` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `fk_id_establishment`, `name`, `mail`, `password`, `phone`, `state_acount`, `type_user`, `date_reg`, `last_logon`, `date_current`) VALUES
(1, 1, 'richard', 'richard.collao@outlook.cl', 'e1y.tuEXKZRRE', '', 'active', 'super_admin', '2017-03-19 16:42:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'Richard Collao', 'rcollao@sigmaltda.cl', 'e1y.tuEXKZRRE', '971620060', 'active', 'user', '2017-03-19 17:18:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 'juan perez', 'jperez@gmail.com', '25xN9KMCwh/SU', '2324235', 'active', 'admin', '2017-07-25 21:53:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 3, 'jorge santos', 'jsantos@asdf.com', '25xN9KMCwh/SU', '333333', 'active', 'user', '2017-07-25 22:17:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2, 'Llerardo Quiroz', 'lquiroz@sigmaltda.cl', 'd0dsL.Q4WbOUs', '972502324', 'active', 'user', '2017-09-04 22:52:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 2, 'Vyrna Salamanca', 'vsalamanca@sigmaltda.cl', 'e1y.tuEXKZRRE', '964876723', 'active', 'user', '2017-09-04 22:56:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 2, 'Kamil Chalhub', 'kchalhub@sigmaltda.cl', 'e1y.tuEXKZRRE', '940117769', 'active', 'user', '2017-09-04 22:59:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 2, 'Orlin Tapia', 'otapia@sigmaltda.cl', 'e1y.tuEXKZRRE', '940117769', 'active', 'user', '2017-09-06 15:56:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 2, 'Merardo Torres', 'rtorres@sigmaltda.cl', 'e1y.tuEXKZRRE', '22222222', 'active', 'user', '2017-09-06 16:26:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 2, 'Ricardo Vallejos', 'rvallejos@sigmaltda.cl', 'e1y.tuEXKZRRE', '992112336', 'active', 'user', '2017-09-06 16:29:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 2, 'Mauricio Tapia', 'mtapia@sigmaltda.cl', 'e1y.tuEXKZRRE', '222222222', 'active', 'user', '2017-09-06 17:37:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 2, 'Alfredo Leon', 'aleon@sigmaltda.cl', 'e1y.tuEXKZRRE', '945369245', 'active', 'user', '2017-09-06 18:06:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 2, 'Ariel Dominguez', 'adominguez@sigmaltda.cl', 'e1y.tuEXKZRRE', '966051742', 'active', 'user', '2017-09-06 18:12:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `fk_id_user` int(11) NOT NULL,
  `permissions` text NOT NULL,
  `locked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`fk_id_user`, `permissions`, `locked`) VALUES
(2, 'members/establishments/index;members/establishments/edit;members/users/index;members/users/create;members/users/edit;members/users/delete;members/users/permissions;members/expenseaccounts/index;members/expenseaccounts/create;members/expenseaccounts/edit;members/expenseaccounts/delete;members/providers/index;members/providers/create;members/providers/edit;members/providers/delete;members/providers/contacts/index;members/providers/contacts/create;members/providers/contacts/edit;members/providers/contacts/delete;members/measures/index;members/measures/create;members/measures/edit;members/measures/delete;members/materials/index;members/materials/create;members/materials/edit;members/materials/delete;members/purchaseorders/index;members/purchaseorders/create;members/purchaseorders/edit;members/purchaseorders/delete;members/purchaseorders/attachments/index;members/purchaseorders/attachments/delete;members/purchaseorders/display;members/purchaseorders/document;members/guides/index;members/guides/create;members/guides/edit;members/guides/delete;members/guides/attachments/index;members/guides/attachments/delete;members/guides/attachments/display;members/bills/index;members/bills/create;members/bills/edit;members/bills/delete;members/bills/attachments/index;members/bills/attachments/delete;members/bills/attachments/display;members/vouchers/index;members/vouchers/create;members/vouchers/edit;members/vouchers/delete;members/vouchers/attachments/index;members/vouchers/attachments/delete;members/vouchers/attachments/display', 0),
(3, 'members/establishments/index;members/establishments/edit;members/users/index;members/users/create;members/users/edit;members/users/delete;members/users/permissions;members/expenseaccounts/index;members/expenseaccounts/create;members/expenseaccounts/edit;members/expenseaccounts/delete;members/providers/index;members/providers/create;members/providers/edit;members/providers/delete;members/providers/contacts/index;members/providers/contacts/create;members/providers/contacts/edit;members/providers/contacts/delete;members/measures/index;members/measures/create;members/measures/edit;members/measures/delete;members/materials/index;members/materials/create;members/materials/edit;members/materials/delete;members/purchaseorders/index;members/purchaseorders/create;members/purchaseorders/edit;members/purchaseorders/delete;members/purchaseorders/attachments/index;members/purchaseorders/attachments/delete;members/purchaseorders/display;members/purchaseorders/document;members/guides/index;members/guides/create;members/guides/edit;members/guides/delete;members/guides/attachments/index;members/guides/attachments/delete;members/guides/attachments/display;members/bills/index;members/bills/create;members/bills/edit;members/bills/delete;members/bills/attachments/index;members/bills/attachments/delete;members/bills/attachments/display;members/vouchers/index;members/vouchers/create;members/vouchers/edit;members/vouchers/delete;members/vouchers/attachments/index;members/vouchers/attachments/delete;members/vouchers/attachments/display;members/authorize_vouchers', 0),
(5, 'members/establishments/index;members/users/index;members/users/permissions;members/expenseaccounts/index;members/expenseaccounts/create;members/expenseaccounts/edit;members/expenseaccounts/delete;members/providers/index;members/providers/create;members/providers/edit;members/providers/delete;members/providers/contacts/index;members/providers/contacts/create;members/providers/contacts/edit;members/providers/contacts/delete;members/measures/index;members/measures/create;members/measures/edit;members/measures/delete;members/materials/index;members/materials/create;members/materials/edit;members/materials/delete;members/purchaseorders/index;members/purchaseorders/create;members/purchaseorders/edit;members/purchaseorders/delete;members/purchaseorders/attachments/index;members/purchaseorders/attachments/delete;members/purchaseorders/display;members/purchaseorders/document;members/guides/index;members/guides/create;members/guides/edit;members/guides/delete;members/guides/attachments/index;members/guides/attachments/delete;members/guides/attachments/display;members/bills/index;members/bills/create;members/bills/edit;members/bills/delete;members/bills/attachments/index;members/bills/attachments/delete;members/bills/attachments/display;members/vouchers/index;members/vouchers/create;members/vouchers/edit;members/vouchers/delete;members/vouchers/attachments/index;members/vouchers/attachments/delete;members/vouchers/attachments/display;members/authorize_vouchers', 0),
(6, 'members/vouchers/index;members/authorize_vouchers', 0),
(7, 'members/establishments/index;members/establishments/edit;members/users/index;members/users/create;members/users/edit;members/users/delete;members/users/permissions;members/expenseaccounts/index;members/expenseaccounts/create;members/expenseaccounts/edit;members/expenseaccounts/delete;members/providers/index;members/providers/create;members/providers/edit;members/providers/delete;members/providers/contacts/index;members/providers/contacts/create;members/providers/contacts/edit;members/providers/contacts/delete;members/measures/index;members/measures/create;members/measures/edit;members/measures/delete;members/materials/index;members/materials/create;members/materials/edit;members/materials/delete;members/purchaseorders/index;members/purchaseorders/create;members/purchaseorders/edit;members/purchaseorders/delete;members/purchaseorders/attachments/index;members/purchaseorders/attachments/delete;members/purchaseorders/display;members/purchaseorders/document;members/guides/index;members/guides/create;members/guides/edit;members/guides/delete;members/guides/attachments/index;members/guides/attachments/delete;members/guides/attachments/display;members/bills/index;members/bills/create;members/bills/edit;members/bills/delete;members/bills/attachments/index;members/bills/attachments/delete;members/bills/attachments/display;members/vouchers/index;members/vouchers/create;members/vouchers/edit;members/vouchers/delete;members/vouchers/attachments/index;members/vouchers/attachments/delete;members/vouchers/attachments/display;members/authorize_vouchers', 0),
(8, 'members/vouchers/index;members/authorize_vouchers', 0),
(9, 'members/vouchers/index;members/authorize_vouchers', 0),
(10, 'members/vouchers/index;members/authorize_vouchers', 0),
(11, 'members/vouchers/index;members/authorize_vouchers', 0),
(12, 'members/establishments/index;members/users/index;members/expenseaccounts/index;members/providers/index;members/providers/contacts/index;members/measures/index;members/materials/index;members/purchaseorders/index;members/purchaseorders/document;members/guides/index;members/bills/index;members/vouchers/index;members/authorize_vouchers', 0),
(13, 'members/vouchers/index;members/authorize_vouchers', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id_voucher` int(11) NOT NULL,
  `fk_id_establishment` int(11) NOT NULL,
  `fk_id_user_typist` int(11) NOT NULL,
  `fk_id_user_autorized` int(11) NOT NULL,
  `user_name_requesting` varchar(32) NOT NULL,
  `number` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `destination` varchar(64) NOT NULL,
  `observation` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id_voucher`, `fk_id_establishment`, `fk_id_user_typist`, `fk_id_user_autorized`, `user_name_requesting`, `number`, `issue_date`, `created_at`, `destination`, `observation`) VALUES
(2, 3, 3, 3, 'fulanito', 1, '2017-07-25', '2017-07-25 22:11:11', 'techumbre', ''),
(3, 2, 2, 8, 'Orlin Tapia', 8333, '2017-09-06', '2017-09-06 15:59:50', 'piso 7 depto 701,702,703,704,705,706', ''),
(4, 2, 2, 8, 'Orlin Tapia', 8671, '2017-09-06', '2017-09-06 16:08:04', 'depto 801 cocina', 'codigo 64616'),
(5, 2, 2, 8, 'Orlin Tapia', 6996, '2017-09-06', '2017-09-06 16:23:02', 'depto 804', 'codigo 64616'),
(6, 2, 2, 8, 'Orlin Tapia', 6997, '2017-09-06', '2017-09-06 16:24:32', 'depto 805', 'codigo 44616, 64616'),
(7, 2, 2, 9, 'jorge', 6016, '2017-09-06', '2017-09-06 16:27:31', 'piso 5', 'codigo 44616, 188'),
(8, 2, 2, 10, 'cristian mondaca', 6556, '2017-09-06', '2017-09-06 16:30:02', 'piso 7', 'codigo 64616'),
(9, 2, 2, 8, 'Orlin Tapia', 6263, '2017-09-06', '2017-09-06 16:31:33', 'depto 702', 'codigo 44616, 64616, 14-5,15-44'),
(10, 2, 2, 10, 'cristian mondaca', 6566, '2017-09-06', '2017-09-06 16:34:47', 'piso 8', 'codigo 44616,64616'),
(11, 2, 2, 8, 'orlin tapia', 5627, '2017-09-06', '2017-09-06 16:36:35', 'depto 601,602,604,605', 'codigo 64616'),
(12, 2, 2, 10, 'cristian mondaca', 6567, '2017-09-06', '2017-09-06 16:38:13', 'piso 7', 'codigo 64616'),
(13, 2, 2, 9, 'jorge', 9890, '2017-09-06', '2017-09-06 16:38:58', 'piso 4', 'codigo 64616,188'),
(14, 2, 2, 8, 'Orlin Tapia', 2744, '2017-09-06', '2017-09-06 16:40:15', 'depto 902', 'codigo 64616'),
(15, 2, 2, 8, 'Orlin Tapia', 2746, '2017-09-06', '2017-09-06 16:44:00', 'depto 906', 'codigo 15-44'),
(16, 2, 2, 10, 'cristian mondaca', 9610, '2017-09-06', '2017-09-06 16:45:15', 'piso 5', 'codigo 14-28'),
(17, 2, 2, 10, 'cristian mondaca', 6517, '2017-09-06', '2017-09-06 16:47:46', 'depto 606', 'codigo 15-44'),
(18, 2, 2, 10, 'cristian mondaca', 6548, '2017-09-06', '2017-09-06 17:25:18', 'piso 7', 'codigo 9-51'),
(19, 2, 2, 8, 'Orlin Tapia', 5628, '2017-09-06', '2017-09-06 17:26:37', 'depto 603-606', 'codigo 15-44'),
(20, 2, 2, 10, 'juan diaz', 6512, '2017-09-06', '2017-09-06 17:28:05', 'piso 4', 'codigo 14-28'),
(21, 2, 2, 10, 'esner', 8026, '2017-09-06', '2017-09-06 17:29:19', 'depto 602', 'reposicion'),
(22, 2, 2, 8, 'esner', 4255, '2017-09-06', '2017-09-06 17:34:20', 'depto 303', 'reposicion'),
(23, 2, 2, 10, 'juan diaz', 8028, '2017-09-06', '2017-09-06 17:36:14', 'depto 305', 'reposicion');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers_details`
--

CREATE TABLE `vouchers_details` (
  `id_voucher_detail` int(11) NOT NULL,
  `fk_id_voucher` int(11) NOT NULL,
  `fk_id_material` int(11) NOT NULL,
  `quantity` decimal(15,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vouchers_details`
--

INSERT INTO `vouchers_details` (`id_voucher_detail`, `fk_id_voucher`, `fk_id_material`, `quantity`) VALUES
(3, 2, 4604, '100.0000'),
(4, 3, 4488, '283.2000'),
(5, 4, 4498, '7.2000'),
(6, 5, 4498, '23.0400'),
(7, 6, 4497, '2.8800'),
(8, 6, 4498, '23.0400'),
(9, 7, 4497, '12.9600'),
(10, 7, 4498, '23.0400'),
(11, 8, 4498, '10.0800'),
(12, 9, 4497, '12.9600'),
(13, 9, 4498, '23.0400'),
(14, 9, 4490, '4.3200'),
(15, 9, 4493, '17.2800'),
(16, 10, 4497, '25.9200'),
(17, 10, 4498, '46.0800'),
(18, 11, 4498, '2.8800'),
(19, 12, 4498, '14.4000'),
(20, 13, 4497, '10.0800'),
(21, 13, 4498, '23.0400'),
(22, 14, 4498, '23.0400'),
(23, 15, 4493, '7.2000'),
(24, 16, 4493, '14.4000'),
(25, 17, 4493, '17.2800'),
(26, 18, 4491, '35.2000'),
(27, 19, 4493, '1.4400'),
(28, 20, 4493, '4.3200'),
(29, 21, 4489, '0.9600'),
(30, 22, 4496, '0.2700'),
(31, 22, 4491, '0.1600'),
(32, 23, 4489, '0.6400');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id_bill`),
  ADD KEY `fk_id_purchase_order` (`fk_id_purchase_order`);

--
-- Indexes for table `bills_details`
--
ALTER TABLE `bills_details`
  ADD PRIMARY KEY (`id_bill_detail`),
  ADD KEY `fk_id_bill` (`fk_id_bill`),
  ADD KEY `fk_id_purchase_order_detail` (`fk_id_purchase_order_detail`);

--
-- Indexes for table `establishments`
--
ALTER TABLE `establishments`
  ADD PRIMARY KEY (`id_establishment`);

--
-- Indexes for table `expense_accounts`
--
ALTER TABLE `expense_accounts`
  ADD PRIMARY KEY (`id_expense_account`),
  ADD KEY `fk_id_establishment` (`fk_id_establishment`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`id_guide`),
  ADD KEY `fk_id_purchase_order` (`fk_id_purchase_order`),
  ADD KEY `fk_id_bill` (`fk_id_bill`);

--
-- Indexes for table `guides_details`
--
ALTER TABLE `guides_details`
  ADD PRIMARY KEY (`id_guide_detail`),
  ADD KEY `fk_id_guide` (`fk_id_guide`),
  ADD KEY `fk_id_purchase_order_detail` (`fk_id_purchase_order_detail`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `fk_id_establishment` (`fk_id_establishment`),
  ADD KEY `fk_id_measure` (`fk_id_measure`),
  ADD KEY `fk_id_expense_account` (`fk_id_expense_account`);

--
-- Indexes for table `measures`
--
ALTER TABLE `measures`
  ADD PRIMARY KEY (`id_measure`),
  ADD KEY `fk_id_establishment` (`fk_id_establishment`);

--
-- Indexes for table `moldings`
--
ALTER TABLE `moldings`
  ADD PRIMARY KEY (`id_molding`),
  ADD KEY `fk_id_establishment` (`fk_id_establishment`),
  ADD KEY `fk_id_provider` (`fk_id_provider`),
  ADD KEY `moldings.fk_id_expense_account` (`fk_id_expense_account`);

--
-- Indexes for table `moldings_guides`
--
ALTER TABLE `moldings_guides`
  ADD PRIMARY KEY (`id_molding_guide`),
  ADD KEY `fk_id_molding` (`fk_id_molding`);

--
-- Indexes for table `moldings_guides_details`
--
ALTER TABLE `moldings_guides_details`
  ADD PRIMARY KEY (`id_molding_guide_detail`),
  ADD KEY `fk_id_molding_guide` (`fk_id_molding_guide`),
  ADD KEY `fk_id_molding_piece` (`fk_id_molding_piece`);

--
-- Indexes for table `moldings_pieces`
--
ALTER TABLE `moldings_pieces`
  ADD PRIMARY KEY (`id_molding_piece`),
  ADD KEY `fk_id_moldings_pieces` (`fk_id_molding`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id_provider`),
  ADD KEY `fk_id_establishment` (`fk_id_establishment`);

--
-- Indexes for table `providers_contacts`
--
ALTER TABLE `providers_contacts`
  ADD PRIMARY KEY (`id_provider_contact`),
  ADD KEY `fk_id_provider` (`fk_id_provider`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id_purchase_order`),
  ADD KEY `fk_id_establishment` (`fk_id_establishment`),
  ADD KEY `fk_id_provider` (`fk_id_provider`);

--
-- Indexes for table `purchase_orders_details`
--
ALTER TABLE `purchase_orders_details`
  ADD PRIMARY KEY (`id_purchase_order_detail`),
  ADD KEY `fk_id_purchase_order` (`fk_id_purchase_order`),
  ADD KEY `fk_id_material` (`fk_id_material`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`fk_id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `fk_id_establishment` (`fk_id_establishment`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`fk_id_user`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id_voucher`),
  ADD KEY `fk_id_establishment` (`fk_id_establishment`),
  ADD KEY `fk_id_user_typist` (`fk_id_user_typist`),
  ADD KEY `fk_id_user_autorized` (`fk_id_user_autorized`);

--
-- Indexes for table `vouchers_details`
--
ALTER TABLE `vouchers_details`
  ADD PRIMARY KEY (`id_voucher_detail`),
  ADD KEY `fk_id_voucher` (`fk_id_voucher`),
  ADD KEY `fk_id_material` (`fk_id_material`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id_bill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bills_details`
--
ALTER TABLE `bills_details`
  MODIFY `id_bill_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `establishments`
--
ALTER TABLE `establishments`
  MODIFY `id_establishment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `expense_accounts`
--
ALTER TABLE `expense_accounts`
  MODIFY `id_expense_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;
--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `id_guide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `guides_details`
--
ALTER TABLE `guides_details`
  MODIFY `id_guide_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4608;
--
-- AUTO_INCREMENT for table `measures`
--
ALTER TABLE `measures`
  MODIFY `id_measure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `moldings`
--
ALTER TABLE `moldings`
  MODIFY `id_molding` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `moldings_guides`
--
ALTER TABLE `moldings_guides`
  MODIFY `id_molding_guide` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `moldings_guides_details`
--
ALTER TABLE `moldings_guides_details`
  MODIFY `id_molding_guide_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `moldings_pieces`
--
ALTER TABLE `moldings_pieces`
  MODIFY `id_molding_piece` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id_provider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;
--
-- AUTO_INCREMENT for table `providers_contacts`
--
ALTER TABLE `providers_contacts`
  MODIFY `id_provider_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id_purchase_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `purchase_orders_details`
--
ALTER TABLE `purchase_orders_details`
  MODIFY `id_purchase_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `vouchers_details`
--
ALTER TABLE `vouchers_details`
  MODIFY `id_voucher_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`fk_id_purchase_order`) REFERENCES `purchase_orders` (`id_purchase_order`) ON UPDATE CASCADE;

--
-- Constraints for table `bills_details`
--
ALTER TABLE `bills_details`
  ADD CONSTRAINT `bills_details_ibfk_1` FOREIGN KEY (`fk_id_bill`) REFERENCES `bills` (`id_bill`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bills_details_ibfk_2` FOREIGN KEY (`fk_id_purchase_order_detail`) REFERENCES `purchase_orders_details` (`id_purchase_order_detail`) ON UPDATE CASCADE;

--
-- Constraints for table `expense_accounts`
--
ALTER TABLE `expense_accounts`
  ADD CONSTRAINT `expense_accounts_ibfk_1` FOREIGN KEY (`fk_id_establishment`) REFERENCES `establishments` (`id_establishment`) ON UPDATE CASCADE;

--
-- Constraints for table `guides`
--
ALTER TABLE `guides`
  ADD CONSTRAINT `guides_ibfk_1` FOREIGN KEY (`fk_id_purchase_order`) REFERENCES `purchase_orders` (`id_purchase_order`) ON UPDATE CASCADE;

--
-- Constraints for table `guides_details`
--
ALTER TABLE `guides_details`
  ADD CONSTRAINT `guides_details_ibfk_1` FOREIGN KEY (`fk_id_guide`) REFERENCES `guides` (`id_guide`) ON UPDATE CASCADE,
  ADD CONSTRAINT `guides_details_ibfk_2` FOREIGN KEY (`fk_id_purchase_order_detail`) REFERENCES `purchase_orders_details` (`id_purchase_order_detail`) ON UPDATE CASCADE,
  ADD CONSTRAINT `guides_details_ibfk_3` FOREIGN KEY (`fk_id_guide`) REFERENCES `guides` (`id_guide`) ON UPDATE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`fk_id_measure`) REFERENCES `measures` (`id_measure`) ON UPDATE CASCADE,
  ADD CONSTRAINT `materials_ibfk_2` FOREIGN KEY (`fk_id_expense_account`) REFERENCES `expense_accounts` (`id_expense_account`) ON UPDATE CASCADE,
  ADD CONSTRAINT `materials_ibfk_3` FOREIGN KEY (`fk_id_establishment`) REFERENCES `establishments` (`id_establishment`) ON UPDATE CASCADE;

--
-- Constraints for table `measures`
--
ALTER TABLE `measures`
  ADD CONSTRAINT `measures_ibfk_1` FOREIGN KEY (`fk_id_establishment`) REFERENCES `establishments` (`id_establishment`) ON UPDATE CASCADE;

--
-- Constraints for table `moldings`
--
ALTER TABLE `moldings`
  ADD CONSTRAINT `moldings_ibfk_1` FOREIGN KEY (`fk_id_establishment`) REFERENCES `establishments` (`id_establishment`),
  ADD CONSTRAINT `moldings_ibfk_2` FOREIGN KEY (`fk_id_provider`) REFERENCES `providers` (`id_provider`),
  ADD CONSTRAINT `moldings_ibfk_3` FOREIGN KEY (`fk_id_expense_account`) REFERENCES `expense_accounts` (`id_expense_account`);

--
-- Constraints for table `moldings_guides`
--
ALTER TABLE `moldings_guides`
  ADD CONSTRAINT `moldings_guides_ibfk_1` FOREIGN KEY (`fk_id_molding`) REFERENCES `moldings` (`id_molding`);

--
-- Constraints for table `moldings_guides_details`
--
ALTER TABLE `moldings_guides_details`
  ADD CONSTRAINT `moldings_guides_details_ibfk_1` FOREIGN KEY (`fk_id_molding_guide`) REFERENCES `moldings_guides` (`id_molding_guide`),
  ADD CONSTRAINT `moldings_guides_details_ibfk_2` FOREIGN KEY (`fk_id_molding_piece`) REFERENCES `moldings_pieces` (`id_molding_piece`);

--
-- Constraints for table `moldings_pieces`
--
ALTER TABLE `moldings_pieces`
  ADD CONSTRAINT `moldings_pieces_ibfk_1` FOREIGN KEY (`fk_id_molding`) REFERENCES `moldings` (`id_molding`);

--
-- Constraints for table `providers`
--
ALTER TABLE `providers`
  ADD CONSTRAINT `providers_ibfk_1` FOREIGN KEY (`fk_id_establishment`) REFERENCES `establishments` (`id_establishment`) ON UPDATE CASCADE;

--
-- Constraints for table `providers_contacts`
--
ALTER TABLE `providers_contacts`
  ADD CONSTRAINT `providers_contacts_ibfk_1` FOREIGN KEY (`fk_id_provider`) REFERENCES `providers` (`id_provider`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_ibfk_1` FOREIGN KEY (`fk_id_provider`) REFERENCES `providers` (`id_provider`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_orders_ibfk_2` FOREIGN KEY (`fk_id_establishment`) REFERENCES `establishments` (`id_establishment`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase_orders_details`
--
ALTER TABLE `purchase_orders_details`
  ADD CONSTRAINT `purchase_orders_details_ibfk_1` FOREIGN KEY (`fk_id_purchase_order`) REFERENCES `purchase_orders` (`id_purchase_order`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_orders_details_ibfk_2` FOREIGN KEY (`fk_id_material`) REFERENCES `materials` (`id_material`) ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`fk_id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_id_establishment`) REFERENCES `establishments` (`id_establishment`) ON UPDATE CASCADE;

--
-- Constraints for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD CONSTRAINT `users_permissions_ibfk_1` FOREIGN KEY (`fk_id_user`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD CONSTRAINT `vouchers_ibfk_1` FOREIGN KEY (`fk_id_user_autorized`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vouchers_ibfk_3` FOREIGN KEY (`fk_id_establishment`) REFERENCES `establishments` (`id_establishment`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vouchers_ibfk_4` FOREIGN KEY (`fk_id_user_typist`) REFERENCES `users` (`id_user`) ON UPDATE CASCADE;

--
-- Constraints for table `vouchers_details`
--
ALTER TABLE `vouchers_details`
  ADD CONSTRAINT `vouchers_details_ibfk_1` FOREIGN KEY (`fk_id_voucher`) REFERENCES `vouchers` (`id_voucher`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vouchers_details_ibfk_2` FOREIGN KEY (`fk_id_material`) REFERENCES `materials` (`id_material`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
