-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2020 a las 01:30:56
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `productos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacenamiento`
--

CREATE TABLE `almacenamiento` (
  `modelo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `almacenamiento` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `almacenamiento`
--

INSERT INTO `almacenamiento` (`modelo`, `almacenamiento`) VALUES
('g7 power', 32),
('g7 power', 64),
('g8 plus', 64),
('Galaxy Note10 plus', 256),
('Galaxy Note10 plus', 512),
('iphone 7', 32),
('iphone 8', 64),
('iphone 8', 256),
('iphone X', 64),
('iphone X', 256),
('Mate 20 pro', 128),
('P30 pro', 128),
('P30 pro', 256),
('S10 plus', 128),
('S10 plus', 512);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `modelo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`modelo`, `color`) VALUES
('g7 power', 'azul'),
('g8 plus', 'azul'),
('g8 plus', 'rosa'),
('Galaxy Note10 plus', 'azul'),
('Galaxy Note10 plus', 'negro'),
('iphone 7', 'negro'),
('iphone 7', 'oro'),
('iphone 8', 'gris'),
('iphone 8', 'oro'),
('iphone 8', 'plata'),
('iphone X', 'gris'),
('iphone X', 'plata'),
('Mate 20 pro', 'negro'),
('P30 pro', 'blanco'),
('S10 plus', 'blanco'),
('S10 plus', 'rojo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imgproducto`
--

CREATE TABLE `imgproducto` (
  `modelo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(80) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `imgproducto`
--

INSERT INTO `imgproducto` (`modelo`, `url`) VALUES
('g7 power', 'img\\g7 power.jpg'),
('g8 plus', 'img\\g8 plus.jpg'),
('Galaxy Note10 plus', 'img\\galaxy note10 plus.jpg'),
('iphone 7', 'img\\iphone 7.jpg'),
('iphone 8', 'img\\iphone 8.jpg'),
('iphone X', 'img\\iphone X.jpg'),
('Mate 20 pro', 'img\\mate 20 pro.jpg'),
('P30 pro', 'img\\p30 pro.jpg'),
('S10 plus', 'img\\s10 plus.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `modelo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `marca` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `pulgadas` float NOT NULL,
  `bateria` int(10) NOT NULL,
  `ram` int(4) NOT NULL,
  `stock` int(10) NOT NULL,
  `cpu` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `so` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`modelo`, `marca`, `pulgadas`, `bateria`, `ram`, `stock`, `cpu`, `so`, `precio`) VALUES
('g7 power', 'Motorola', 6.2, 5000, 3, 10, 'Snapdragon 632 Octa-Core de 1.8 GHz', 'Android', 16000),
('g8 plus', 'Motorola', 6.3, 4000, 4, 25, 'Snapdragon 665 Octa-Core de 2G', 'Android', 23000),
('Galaxy Note10 plus', 'Samsung', 6.8, 4300, 3, 10, 'Exynos 9825', 'Android', 106000),
('Iphone 7', 'Apple', 4.7, 1960, 2, 23, 'A10 Fusion Quad-Core de 2.34GH', 'iOS', 47699),
('iphone 8', 'Apple', 4.7, 1821, 2, 15, 'Apple A11 Bionic', 'iOS', 60000),
('iphone X', 'Apple', 5.8, 2716, 3, 8, 'Apple A11 Bionic', 'iOS', 85400),
('Mate 20 pro', 'Huawei', 6.39, 4200, 6, 45, 'HiSilicon Kirin 980 Octa-Core ', 'Android', 80000),
('P30 pro', 'Huawei', 6.47, 4200, 8, 28, 'HiSilicon Kirin 980 Octa-Core ', 'Android', 85000),
('S10 plus', 'Samsung', 6.4, 4100, 8, 10, 'Exynos 9820 2.7GHz', 'Android', 130000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacenamiento`
--
ALTER TABLE `almacenamiento`
  ADD PRIMARY KEY (`modelo`,`almacenamiento`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`modelo`,`color`);

--
-- Indices de la tabla `imgproducto`
--
ALTER TABLE `imgproducto`
  ADD PRIMARY KEY (`modelo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`modelo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
