-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2024 a las 15:41:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empire`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cod_customer` int(11) NOT NULL,
  `nombres_empire` varchar(200) NOT NULL,
  `apellidos_empire` varchar(200) NOT NULL,
  `opening_hours_empire` time NOT NULL,
  `closing_time_empire` time NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `cod_material_empire` int(11) NOT NULL,
  `material_empire` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`cod_material_empire`, `material_empire`, `status`) VALUES
(1, 'F1218', 1),
(2, 'F1233', 1),
(3, 'F1238', 1),
(4, 'F1250', 1),
(5, 'F1515', 1),
(6, 'F1533', 1),
(7, 'F1544', 1),
(8, 'F1555', 1),
(9, 'F26', 1),
(10, 'F1818', 1),
(11, 'F1824', 1),
(12, 'F1828', 1),
(13, 'F1833', 1),
(14, 'F1836', 1),
(15, 'F1844', 1),
(16, 'F1855', 1),
(17, 'F1880', 1),
(18, 'F1880CH', 1),
(19, 'F1933', 1),
(20, 'F2019', 1),
(21, 'F2028', 1),
(22, 'F2035', 1),
(23, 'F2045', 1),
(24, 'F2565', 1),
(25, 'HR10', 1),
(26, 'HR20', 1),
(27, 'HR28', 1),
(28, 'HR34', 1),
(29, 'HR40', 1),
(30, 'HR50', 1),
(31, 'HR70', 1),
(32, 'Visco1.5', 1),
(33, 'Visco2.5', 1),
(34, 'Swirl Gel', 1),
(35, 'Visco3.5', 1),
(36, 'DF#15', 1),
(37, 'DF#25', 1),
(38, 'DF#33', 1),
(39, 'HD500', 1),
(40, 'Rebond', 1),
(41, 'Q35', 1),
(42, 'Q41', 1),
(43, 'Q51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_order`
--

CREATE TABLE `purchase_order` (
  `cod_purchase_empire` int(11) NOT NULL,
  `cod_customer_empire` int(11) NOT NULL,
  `cod_material_empire` int(11) NOT NULL,
  `qty_empire` varchar(20) NOT NULL,
  `size_empire` varchar(40) NOT NULL,
  `purchase_order_empire` varchar(20) NOT NULL,
  `ship_date_empire` date NOT NULL,
  `Notes_empire` text NOT NULL,
  `system_date_empire` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cod_customer`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`cod_material_empire`);

--
-- Indices de la tabla `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`cod_purchase_empire`),
  ADD KEY `cod_customer_empire` (`cod_customer_empire`),
  ADD KEY `cod_material_empire` (`cod_material_empire`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cod_customer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `cod_material_empire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `cod_purchase_empire` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `cod_customer_empire` FOREIGN KEY (`cod_customer_empire`) REFERENCES `clientes` (`cod_customer`),
  ADD CONSTRAINT `cod_material_empire` FOREIGN KEY (`cod_material_empire`) REFERENCES `material` (`cod_material_empire`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
